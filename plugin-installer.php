<?php
/**
 * DSC Plugin Installer
 * 
 * Plugin installation and activation for WordPress themes.
 *
 * @package   DSC Plugin Installer
 * @version   1.0
 * @author    Joseph Gabito
 * @copyright Copyright (c) 2011, Joseph Gabito
 * @license   GPL-2.0+
 */
namespace DSC\Plugins;

use Plugin_Upgrader as WPPluginUpgrader;

final class Installer {

	private $uid = "dsc-plugins-installer";

	public function __construct() 
	{
		// Only enable this menu for administrators.
		if ( ! current_user_can('install_plugins') ) {
			return $this;
		}

		// Add the recommended plugins page link under 'Plugins' and prepare the page for loading the installer screen.
		add_action( 'admin_menu', function() {
			add_plugins_page('Recommended Plugins', 'Recommended', 'install_plugins', $this->uid('screen'), function(){
				$this->pluginInstallerScreen();
			});
		});

		// Add the necesserarry inline js. No need to make it separate.
		add_action( 'dsc-plugins-installer/screen-after', function(){
			$this->installerJs();
		});

		add_action( 'wp_ajax_dsc_plugins_install', array($this, 'install'));
		add_action( 'wp_ajax_dsc_plugins_activate', array($this, 'activate'));

		return $this;

	}

	public function install()
	{
		// Check to see if current logged in user has the privilege to install plugins.
		if ( ! current_user_can('install_plugins') ) {
			die;
		}

		// Check if the current user holds a valid noonce;
		check_admin_referer('dsc-plugin-installer-token', 'noonce');
		
		$upgraderClassFile = ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

		// 4.6 > has its own class file define in path $upgraderClassFile
		if ( file_exists( $upgraderClassFile ) ) {
			require_once $upgraderClassFile;
		}

		$plugin = new WPPluginUpgrader();
		$plugin->bulk = true;
		
		$plugin_uri = filter_input(INPUT_POST, 'plugin_uri', FILTER_SANITIZE_SPECIAL_CHARS);
		
		$is_install = $plugin->install( $plugin_uri );

		// Hackish way to guess the status since WPPluginUpgrader::install buffers the output. 
		// Tried ob_start and ob_get_clean() but no avail. Needs some improvement.
		if ( ! $is_install ) {
			echo '{0}';
		} else {
			echo '{1}';
		}

		die();

		return;
	}

	public function activate() 
	{
		if ( ! current_user_can('install_plugins') ) {
			die;
		}

		header('Content-type: application/json');

		$plugin_requested = filter_input(INPUT_GET, 'plugin_dir', FILTER_SANITIZE_SPECIAL_CHARS);

		$listed_plugins = get_plugins();
		$reformatted_listed_plugins = array();
		$plugins_error = array();
		$plugin_activated = false;
		$http_response = array(
				'status' => 200,
				'type' => 'success',
				'message' => esc_attr__('Plugin successfully activated', 'dsc-plugins-installer'),
				'errors' => array()
			);

		if ( !empty( $listed_plugins) ) {
			foreach( $listed_plugins as $plugin_key => $plugin_data ) {
				$plugin_dir = explode( '/', $plugin_key );
				$reformatted_listed_plugins[$plugin_dir[0]] = $plugin_key;
			}
		}

		$redirect = '';
		$is_network_wide = false;
		$silence = false;

		$is_activate = activate_plugin( $reformatted_listed_plugins[$plugin_requested], 
			$redirect, $is_network_wide, $silence );

		if ( $is_activate instanceof \WP_Error ) {
			if ( !empty( $is_activate->errors ) ) {
				foreach( $is_activate->errors as $error_key => $error ) {
					$plugins_error[$error_key] = $error[0];
				}
			}
			$plugin_activated = false;
		} else {
			$plugin_activated = true;
		}

		if ( ! $plugin_activated ) {
			$http_response['type'] = 'error';
			$http_response['errors'] = $plugins_error;
			$http_response['message'] = esc_attr__('Could not activate plugin', 'dsc-plugins-installer');
		}

		echo json_encode( $http_response );

		die();

		return;

	}

	/**
	 * A Helper method to provide a unique id for administration screens and other things.
	 * @param  string $identifier The name you wish to passed.
	 * @return strint             The processed uniqued name. Not really unique though...
	 */
	private function uid( $identifier = "" )
	{
		return sanitize_title( sprintf('%s-%s', $this->uid, $identifier) );
	}

	/**
	 * The admin screen callback of the plugin installer
	 * @return void
	 */
	private function pluginInstallerScreen()
	{
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		wp_enqueue_style('thickbox');
		wp_enqueue_script('thickbox');
		?>
		<style>
			.notice-error .wrap { margin:0; }
			.notice-error h1:empty { display: none; }
		</style>
		<div class="wrap">
			<style> a {text-decoration: none; } </style>
			<h1 class="wp-heading-inline"><?php esc_html_e('Recommended Plugins', 'dsc-plugins-installer'); ?></h1>
			<p style="font-size: 15px; opacity: 0.87;">
				<?php _e( apply_filters('dsc-plugins-installer/screen-message', 'The plugins listed below <em>are not required</em> for your website to run properly under basic usage. Though, if you are using features that are handled externally via a plugin, then you may install and activate one or more plugins below. The author of this Theme recommends the plugins below, and it is tested to work correctly with your current theme. <em>Install and activate the plugins you need</em>, nevermind the rest.'), 'dsc-plugins-installer'); ?>
			</p>
			<?php 
				$listed_plugins = apply_filters('dsc-plugins-installer/recommended-plugins', array());
				echo '<div class="row">';
				if ( !empty( $listed_plugins ) ) {
					foreach( $listed_plugins  as $plugin ) {
						$this->pluginCard( $plugin );
					}
				} else {
					echo '<div style=" color: #616161; font-size: 14px;  padding: 10px 15px; border-radius: 4px;  background: white; line-height: 1.5; font-weight: 500;">';
						_e('There are no recommeded plugins defined. Hook into "dsc-plugins-installer/recommended-plugins" filter to pass your own recommended plugin parameters. More information can be found here: <a href="#">Visit github link</a>', 'dsc-plugins-installer');
					echo '</div>';
				}
				echo '</div>';
			?>
		<?php do_action('dsc-plugins-installer/screen-after'); ?>
		<script>
		var dscPluginInstallerConfig = {
			noonce: "<?php echo wp_create_nonce( 'dsc-plugin-installer-token' ); ?>"
		}
		</script>
		<?php
		return;
	}

	/**
	 * The installer js script that handles our installation and activation actions. Inline is fine.
	 * @return void.
	 */
	private function installerJs() 
	{ ?>
	<script>
	(function(){
		function dscPluginsInstaller_Install() {

			let __this = this;
			let card = this.parentElement.parentElement.parentElement.parentElement.parentElement;
			let plugin_uri = this.getAttribute('data-plugin-uri');
			let http_vars = new FormData();
				http_vars.append('action', 'dsc_plugins_install');
				http_vars.append('plugin_uri', plugin_uri);
				http_vars.append('noonce', dscPluginInstallerConfig.noonce );

			// Open new connection to our ajax handler.
			let xhttp = new XMLHttpRequest();
				xhttp.open( 'POST', 'admin-ajax.php' );
				xhttp.send( http_vars );
			// Notify the user about the progress.
			this.innerHTML = "Installing...";
			this.className += ' updating-message';
			this.setAttribute('disabled', 'disabled');
			// Success callback
			xhttp.onreadystatechange = function ( event ) {
				if (this.readyState == 4 && this.status == 200) {
					var response = this.responseText;
					var result = response.match(/{[0-1]}/);
				
					if ( "{0}" == result ) {
						// fail.
						card.classList.add('plugin-card-update-failed');
						card.querySelector('.notice-error').classList.remove('hidden');
						__this.classList.remove('updating-message');
						__this.innerHTML = "Installation Failed";
						card.querySelector('.notice-error').innerHTML = response.replace(/{[0-1]}/, "");
					} else {
						__this.classList.remove('updating-message');
						__this.classList.remove('dsc-js-install-now');
						__this.classList.add('dsc-js-activate-now');
						__this.classList.add('button-primary');;
						__this.removeAttribute('disabled');
						__this.innerHTML = "Activate";
						__this.removeEventListener('click', dscPluginsInstaller_Install);
						__this.addEventListener('click', dscPluginsInstaller_Activate);
					}
				} 
				
				if ( this.readyState == 4 && this.status != 200 ) {
					// Network Error.
					card.classList.add('plugin-card-update-failed');
					card.querySelector('.notice-error').classList.remove('hidden');
					__this.classList.remove('updating-message');
					__this.innerHTML = "Installation Failed";
					card.querySelector('.notice-error').innerHTML = '<p>'+"Connection to server has not been sucessfully established. Check your network connection for problems."+'</p>';
				}
			};
		}

		function dscPluginsInstaller_Activate() {
				var __this = this;
				let plugin_dir = this.getAttribute('data-plugin-dir');
				let xhttp = new XMLHttpRequest();
					xhttp.open("POST", "admin-ajax.php?action=dsc_plugins_activate&plugin_dir="+plugin_dir);
					xhttp.send();
					// Notify the user about the activation progress.
					this.innerHTML = "Activating...";
					this.className += ' updating-message';
					this.setAttribute('disabled', 'disabled');
					xhttp.onreadystatechange = function() {
						if (this.readyState === 4 && this.status === 200) {
							let response = JSON.parse( this.responseText );
								
								if ( response.type == "success" ) {
									__this.classList.remove('updating-message');
									__this.classList.remove('dsc-js-install-now');
									__this.classList.remove('button-primary');
									__this.innerHTML = '<span class="dashicons dashicons-yes" style="top: 3px;position: relative;margin-left: -5px;color: #4CAF50;"></span> Activated';
								}
						}
					}
			};
		/**
		 * Install Button Action
		 */
		document.querySelectorAll('.dsc-js-install-now').forEach( (item, index) => {
			item.addEventListener('click', dscPluginsInstaller_Install);
		});
		document.querySelectorAll('.dsc-js-activate-now').forEach((item,index) => {
			item.addEventListener('click', dscPluginsInstaller_Activate);
		});
		})();
	</script>
	<?php
		return;
	}

	private function pluginCard( $plugin )
	{
		?>
		<div class="plugin-card">
			<div class="plugin-card-top">
				<div class="name column-name">
					<h3>
						<a href="#" class="thickbox open-plugin-details-modal">
							<?php echo esc_html( $plugin['name'] ); ?>
							<img src="<?php echo esc_url( $plugin['thumbnail'] ); ?>" class="plugin-icon" 
							alt="<?php echo esc_html( $plugin['name'] ); ?>">
						</a>
					</h3>
				</div>
				<div class="action-links">
					<ul class="plugin-action-buttons">
						<li>
							<?php // Plugin is not in wp-content/plugins directory and not activated. ?>
							<?php if ( ! $this->isPluginInstalled( $plugin['slug'] ) && ! $this->isPluginActivated( $plugin['slug'] ) ) { ?>
								<button data-plugin-dir="<?php echo esc_attr( $plugin['slug'] ); ?>" data-plugin-uri="<?php echo esc_url( $plugin['url'] ); ?>" type="button" class="button dsc-js-install-now">
									<?php esc_html_e('Install Now', 'dsc-plugins-installer'); ?>
								</button>
							<?php } ?>
							<?php // Plugin is not in wp-content/plugins directory but is activated (Bug). ?>
							<?php if ( ! $this->isPluginInstalled( $plugin['slug'] ) && $this->isPluginActivated( $plugin['slug'] ) ) { ?>
								<button data-plugin-dir="<?php echo esc_attr( $plugin['slug'] ); ?>" data-plugin-uri="<?php echo esc_url( $plugin['url'] ); ?>" type="button" class="button dsc-js-install-now">
									<?php esc_html_e('Install Now', 'dsc-plugins-installer'); ?>
								</button>
							<?php } ?>
							<?php // Plugin is in wp-content/plugins directory but not activated. ?>
							<?php if ( $this->isPluginInstalled( $plugin['slug'] ) && ! $this->isPluginActivated( $plugin['slug'] ) ) { ?>
								<button data-plugin-dir="<?php echo esc_attr( $plugin['slug'] ); ?>" type="button" class="button button-primary dsc-js-activate-now">
									<?php esc_html_e('Activate', 'dsc-plugins-installer'); ?>
								</button>
							<?php } ?>
							<?php // Plugin is in wp-content/plugins directory and is activated. ?>
							<?php if ( $this->isPluginInstalled( $plugin['slug'] ) && $this->isPluginActivated( $plugin['slug'] ) ) { ?>
								<button data-plugin-dir="<?php echo esc_attr( $plugin['slug'] ); ?>" type="button" class="button-disable button" disabled="disabled">
									<span class="dashicons dashicons-yes" style="top: 3px;position: relative;margin-left: -5px;color: #4CAF50;"></span>
									<?php esc_html_e('Activated', 'dsc-plugins-installer'); ?>
								</button>
							<?php } ?>
						</li>
						<li>
							<?php if ( $plugin['link_type'] === 'external' ) { ?>
								<a target="_blank" href="<?php echo esc_url( $plugin['link_external']); ?>">
									<?php esc_html_e('More Details', 'dsc-plugins-installer'); ?>
								</a>
							<?php } else { ?>
								<?php 
								$tb_link = admin_url('plugin-install.php?tab=plugin-information&plugin='.sanitize_title($plugin['slug']).'&TB_iframe=true&width=772&height=533'); 
								?>
								<a href="<?php echo esc_url( $tb_link ); ?>" class="thickbox open-plugin-details-modal">
									<?php esc_html_e('More Details', 'dsc-plugins-installer'); ?>
								</a>
							<?php } ?>
						</li>
					</ul>
				</div>
				<div class="desc column-description">
					<p><?php echo esc_html( $plugin['short_description'] ); ?></p>
					<p class="authors"> 
						<cite>
							<?php esc_html_e('By', 'dsc-plugins-installer'); ?>
							<a href="<?php echo esc_url( $plugin['author_url'] ); ?>">
							<?php echo esc_html( $plugin['author_name'] ); ?>
							</a>
						</cite>
					</p>
				</div>
				
			</div>
			<div class="plugin-card-bottom">
				<?php echo esc_html( $plugin['description'] ); ?>
			</div>
			<div class="notice-error notice-alt is-dismissible hidden" style="padding: 2.5px 20px 2.5px 17px;border-left: 3px solid #dc3232;margin-left: -1px;">
				<p>
					<?php esc_html_e('There was an error trying to install this plugin. Make sure your \'plugins\' directory is writable by the current web server user. Try using WordPress\'s Plugin Manager to see if the issue still persist. Contact your web hosting company for more details.', 'dsc-plugins-installer'); ?>
				</p>
			</div>
		</div>
		<?php
	}

	private function isPluginInstalled( $pluginDir ) {
		return is_dir( sprintf( ABSPATH . 'wp-content/plugins/%s', sanitize_title( $pluginDir) ) );
	}

	private function isPluginActivated( $pluginDirSlug ) {

		$active_plugins = get_option('active_plugins');

		if ( !empty( $active_plugins ) ) {
			foreach( $active_plugins as $plugin ) {
				$plugin_dir = explode('/', $plugin);
				$formatted_active_plugins[] = $plugin_dir[0];
			}
			return in_array( $pluginDirSlug, $formatted_active_plugins ); 
		}

		return false;
	}

}

new Installer();
