<?php
/**
* Include the plugin installer script.
*/
require_once get_template_directory() . '/inc/plugin-installer.php';

add_filter('dsc-plugins-installer/recommended-plugins', 'thrive_recommended_plugins');

function thrive_recommended_plugins() {
return array(
			// BuddyPress
			array(
				'url' => 'https://downloads.wordpress.org/plugin/buddypress.zip', // The plugin url of the zip file
				'name' => 'BuddyPress', //  the name of the plugin
				'short_description' => 'BuddyPress is a suite of components that are common to a typical social network.', //  the short description of the plugin
				'description' => 'BuddyPress is focused on ease of integration, ease of use, and extensibility. It is deliberately powerful yet unbelievably simple social network software, built by contributors to WordPress.', //  the short description of the plugin
				'thumbnail' => 'https://ps.w.org/buddypress/assets/icon-256x256.png', // the thumbnail
				'author_name' => 'The BuddyPress Community',
				'author_url' => 'https://buddypress.org/',
				'slug' => 'buddypress',
				'link_type' => 'wordpress.org', //wordpress.org 
			),
			// One Click Demo Import
			array(
				'url' => 'https://downloads.wordpress.org/plugin/one-click-demo-import.zip', // The plugin url of the zip file
				'name' => 'One Click Demo Import', //  the name of the plugin
				'short_description' => 'This plug-in powers Thrive One Click Demo Import Tool.', //  the short description of the plugin
				'description' => 'The best feature of this plugin is, that theme authors can define import files in their themes and so all you (the user of the theme) have to do is click on the “Import Demo Data” button.', //  the short description of the plugin
				'thumbnail' => 'https://ps.w.org/one-click-demo-import/assets/icon-256x256.png', // the thumbnail
				'author_name' => 'ProteusThemes',
				'author_url' => 'http://www.proteusthemes.com//',
				'slug' => 'one-click-demo-import',
				'link_type' => 'wordpress.org', //wordpress.org 
			),
			// Kirki
			array(
				'url' => 'https://downloads.wordpress.org/plugin/kirki.zip', // The plugin url of the zip file
				'name' => 'Kirki', //  the name of the plugin
				'short_description' => 'Thrive is using this plugin to power-up the WordPress Theme Customizer.', //  the short description of the plugin
				'description' => 'Kirki is a Toolkit allowing WordPress developers to use the Customizer and take advantage of its advanced features and flexibility by abstracting the code and making it easier for everyone to create beautiful and meaningful user experiences.', //  the short description of the plugin
				'thumbnail' => 'https://ps.w.org/kirki/assets/icon-256x256.png', // the thumbnail
				'author_name' => 'Aristeides Stathopoulos',
				'author_url' => 'http://aristeides.com/',
				'slug' => 'kirki',
				'link_type' => 'wordpress.org', //wordpress.org 
			),
			//The Events Calendar
			array(
				'url' => 'https://downloads.wordpress.org/plugin/the-events-calendar.4.5.2.1.zip', // The plugin url
				'name' => 'The Events Calendar', //  the name of the plugin
				'short_description' => 'Easy to use Events Manager for WordPress. It is extensible and completely customizable.', //  the short description of the plugin
				'description' => 'Create an events calendar and manage it with ease. The Events Calendar plugin provides professional-level quality and features backed by a team you can trust!', //  the short description of the plugin
				'thumbnail' => 'https://ps.w.org/the-events-calendar/assets/icon-256x256.png', // the thumbnail
				'author_name' => 'Modern Tribe, Inc.',
				'author_url' => 'http://m.tri.be/1x/',
				'link_type' => 'wordpress.org', //wordpress.org 
				'slug' => 'the-events-calendar'
			),
			// Revolution Slider
			array(
				'url' => 'https://s3.amazonaws.com/dsc-plugins/revslider.zip', // The plugin url of the zip file
				'name' => 'Slider Revolution', //  the name of the plugin
				'short_description' => 'The best way to build awesome slider inside WordPress.', //  the short description of the plugin
				'description' => 'Slider Revolution is an innovative, responsive WordPress Slider Plugin that displays your content the beautiful way. Whether it\'s a Slider, Carousel, Hero Scene or even a whole Front Page, the visual, drag & drop editor will let you tell your own stories in no time.', //  the short description of the plugin
				'thumbnail' => 'https://0.s3.envato.com/files/146765454/TP_LOGO.png', // the thumbnail
				'author_name' => 'themepunch',
				'author_url' => 'https://goo.gl/U2oUBR',
				'slug' => 'revslider',
				'link_type' => 'external', //wordpress.org 
				'link_external' => 'https://goo.gl/U2oUBR' // if 'link_type' = 'external'
			),
			// Visual Composer
			array(
				'url' => 'http://demo.dunhakdis.me/plugins/js_composer.zip', // The plugin url of the zip file
				'name' => 'Visual Composer', //  the name of the plugin
				'short_description' => 'Build any layout you can imagine with intuitive drag and drop builder.', //  the short description of the plugin
				'description' => 'Build a responsive website and manage your content easily with intuitive WordPress Front end editor. No programming knowledge required – create stunning and beautiful pages with award winning drag and drop builder.', //  the short description of the plugin
				'thumbnail' => 'https://thumb-cc.s3.envato.com/files/222502746/th-5.1.png', // the thumbnail
				'author_name' => 'wpbakery',
				'author_url' => 'https://goo.gl/8O6K4z',
				'slug' => 'js_composer',
				'link_type' => 'external', //wordpress.org 
				'link_external' => 'https://goo.gl/8O6K4z' // if 'link_type' = 'external'
			),
			// Gears
			array(
				'url' => 'http://107.170.94.164/plugins/gears.zip', // The plugin url of the zip file
				'name' => 'Gears', //  the name of the plugin
				'short_description' => 'Gears powers basic BuddyPress Shortcodes.', //  the short description of the plugin
				'description' => 'Using gears you will be able to use features such as BuddyPress Cover Photo Cropping, BuddyPress Activity Shortcode, BuddyPress Members Shortcode, and more! You will be able to connect your registration for to social media like Facebook and Google Plus.', //  the short description of the plugin
				'thumbnail' => 'https://s3.amazonaws.com/image-turbo/public/gears-thumbnail.png', // the thumbnail
				'author_name' => 'Dunhakdis',
				'author_url' => 'https://goo.gl/Vef2pP',
				'slug' => 'gears',
				'link_type' => 'external', // or wordpress.org 
				'link_external' => 'https://goo.gl/Vef2pP' // if 'link_type' = 'external'
			),
			
			// TaskBreaker
			array(
				'url' => 'https://downloads.wordpress.org/plugin/taskbreaker-project-management.zip', // The plugin url
				'name' => 'TaskBreaker', //  the name of the plugin
				'short_description' => 'Manage your Projects and Tasks easily with TaskBreaker.', //  the short description of the plugin
				'description' => 'A plugin for BuddyPress that allows you to manage your projects and assign a task to each of the members of a particular group. You can set the priority for each task (Normal, High, and Critical).', //  the short description of the plugin
				'thumbnail' => 'https://s3.amazonaws.com/image-turbo/public/taskbreaker-thumbnail.png', // the thumbnail
				'author_name' => 'Dunhakdis',
				'author_url' => 'https://goo.gl/Vef2pP',
				'link_type' => 'wordpress.org', //wordpress.org 
				'slug' => 'taskbreaker-project-management'
			),
			// bbPress
			array(
				'url' => 'https://downloads.wordpress.org/plugin/bbpress.zip', // The plugin url
				'name' => 'bbPress', //  the name of the plugin
				'short_description' => 'Easily Create Forums to your WordPress Site.', //  the short description of the plugin
				'description' => 'Have you ever been frustrated with forum or bulletin board software that was slow, bloated and always got your server hacked? bbPress is focused on ease of integration, ease of use, web standards, and speed.', //  the short description of the plugin
				'thumbnail' => 'https://ps.w.org/bbpress/assets/icon-256x256.png', // the thumbnail
				'author_name' => 'The bbPress Community',
				'author_url' => 'https://bbpress.org/',
				'link_type' => 'wordpress.org', //wordpress.org 
				'slug' => 'bbpress'
			),
			// Subway
			array(
				'url' => 'https://downloads.wordpress.org/plugin/subway.zip', // The plugin url
				'name' => 'Subway', //  the name of the plugin
				'short_description' => 'This plugin hides the content of your website to non-logged in visitors.', //  the short description of the plugin
				'description' => 'Subway is a small plugin for WordPress that allows you hide the content of your website to non-logged in visitors and only displays them to logged in users.', //  the short description of the plugin
				'thumbnail' => 'https://ps.w.org/subway/assets/icon-256x256.png', // the thumbnail
				'author_name' => 'Dunhakdis',
				'author_url' => 'http://dunhakdis.com',
				'link_type' => 'wordpress.org', //wordpress.org 
				'slug' => 'subway'
			),
			//BuddyDocs
			array(
				'url' => 'https://downloads.wordpress.org/plugin/buddypress-docs.zip', // The plugin url of the zip file
				'name' => 'BuddyPress Docs', //  the name of the plugin
				'short_description' => 'Use this plug-in to allow document sharing and revisions.', //  the short description of the plugin
				'description' => 'BuddyPress Docs adds collaborative work spaces to your BuddyPress community. Part wiki, part document editing, part shared dropbox, think of these Docs as a BuddyPress version of the Docs service offered by the Big G ifyouknowwhatimean.', //  the short description of the plugin
				'thumbnail' => 'https://s3.amazonaws.com/image-turbo/public/buddydocs.png', // the thumbnail
				'author_name' => 'Boone B Gorges',
				'author_url' => 'http://boone.gorg.es/',
				'slug' => 'buddypress-docs',
				'link_type' => 'wordpress.org', //wordpress.org 
			),
			// BuddyDrive
			array(
				'url' => 'https://downloads.wordpress.org/plugin/buddydrive.zip', // The plugin url of the zip file
				'name' => 'BuddyDrive', //  the name of the plugin
				'short_description' => 'A Simple File Sharing plugin for WordPress & BuddyPress', //  the short description of the plugin
				'description' => 'As a plugin for BuddyPress, BuddyDrive allows community members to share files or folders with ease. Via the BP attachment API, BuddyPress makes sharing content possible in a variety of ways', //  the short description of the plugin
				'thumbnail' => 'https://ps.w.org/buddydrive/assets/icon-256x256.png', // the thumbnail
				'author_name' => 'mrpritchett',
				'author_url' => 'http://pritchett.media/',
				'slug' => 'buddydrive',
				'link_type' => 'wordpress.org', //wordpress.org 
			),
			// Reference
			array(
				'url' => 'https://downloads.wordpress.org/plugin/reference-knowledgebase-and-docs.zip', // The plugin url
				'name' => 'Reference', //  the name of the plugin
				'short_description' => 'Add knowledgebase and docs to your website.', //  the short description of the plugin
				'description' => 'Reference is a WordPress Knowledgebase plugin that helps you manage your Knowledgebase articles quickly. Create and organize each of your articles base on their topics.', //  the short description of the plugin
				'thumbnail' => 'https://s3.amazonaws.com/image-turbo/public/menu-icons-thumbnail.png', // the thumbnail
				'author_name' => 'Dunhakdis',
				'author_url' => 'https://dunhakdis.com/',
				'link_type' => 'wordpress.org', //wordpress.org 
				'slug' => 'reference-knowledgebase-and-docs'
			),
			// Menu Icons
			array(
				'url' => 'https://downloads.wordpress.org/plugin/menu-icons.zip', // The plugin url
				'name' => 'Menu icons', //  the name of the plugin
				'short_description' => 'Add beautiful icons in your WordPress Menu. Very easy and simple to use.', //  the short description of the plugin
				'description' => 'This plugin gives you the ability to add icons to your menu items, similar to the look of the latest dashboard menu. You can choose between FontAwesome, Dashicons, Fontello and, More!.', //  the short description of the plugin
				'thumbnail' => 'https://s3.amazonaws.com/image-turbo/public/menu-icons-thumbnail.png', // the thumbnail
				'author_name' => 'Dzikri Aziz',
				'author_url' => 'http://kucrut.org/',
				'link_type' => 'wordpress.org', //wordpress.org 
				'slug' => 'menu-icons'
			),
			// BP Global Search
			array(
				'url' => 'https://downloads.wordpress.org/plugin/buddypress-global-search.zip', // The plugin url
				'name' => 'BuddyPress Global Search', //  the name of the plugin
				'short_description' => 'Add Interactive Search in your WordPress Site. This plugin uses ajax technology to enable auto-suggest in search fields.', //  the short description of the plugin
				'description' => 'Let your members search through every BuddyPress component, along with pages and posts and custom post types of your choice, all in one unified search bar with a live dropdown of results.', //  the short description of the plugin
				'thumbnail' => 'https://ps.w.org/buddypress-global-search/assets/icon-256x256.png', // the thumbnail
				'author_name' => 'BuddyBoss',
				'author_url' => 'http://buddyboss.com/',
				'link_type' => 'wordpress.org', //wordpress.org 
				'slug' => 'buddypress-global-search'
			),
			// Visual Form Builder
			array(
				'url' => 'https://downloads.wordpress.org/plugin/visual-form-builder.zip', // The plugin url of the zip file
				'name' => 'Visual Form Builder', //  the name of the plugin
				'short_description' => 'Use this plug-in to allow document sharing and revisions.', //  the short description of the plugin
				'description' => 'Visual Form Builder is a plugin that allows you to build and manage all kinds of forms for your website in a single place. Building a fully functional contact form takes only a few minutes and you don’t have to write one bit of PHP, CSS, or HTML!.', //  the short description of the plugin
				'thumbnail' => 'https://ps.w.org/visual-form-builder/assets/icon-256x256.png', // the thumbnail
				'author_name' => 'Matthew Muro',
				'author_url' => 'http://matthewmuro.com/',
				'slug' => 'visual-form-builder',
				'link_type' => 'wordpress.org', //wordpress.org 
			),
			array(
				'url' => 'https://downloads.wordpress.org/plugin/wp-polls.zip', // The plugin url
				'name' => 'WP-Polls', //  the name of the plugin
				'short_description' => 'Create and Manage Polls inside WordPress for free with WP-Polls.', //  the short description of the plugin
				'description' => 'WP-Polls is extremely customizable via templates and css styles and there are tons of options for you to choose to ensure that WP-Polls runs the way you wanted.', //  the short description of the plugin
				'thumbnail' => 'https://ps.w.org/wp-polls/assets/icon.svg', // the thumbnail
				'author_name' => 'Lester \'Gamerz\' Chan',
				'author_url' => 'https://lesterchan.net/',
				'link_type' => 'wordpress.org', //wordpress.org 
				'slug' => 'wp-polls'
			),
			array(
				'url' => 'https://downloads.wordpress.org/plugin/wise-chat.zip', // The plugin url
				'name' => 'Wise Chat', //  the name of the plugin
				'short_description' => 'Enable chat in your community using Wisechat Plugin.', //  the short description of the plugin
				'description' => 'Wise Chat is a chat plugin that helps to build a social network and to increase user engagement of your website by providing possibility to exchange real time messages in chat rooms.', //  the short description of the plugin
				'thumbnail' => 'https://ps.w.org/wise-chat/assets/icon-128x128.png', // the thumbnail
				'author_name' => 'Marcin Ławrowski',
				'author_url' => 'http://kaine.pl/',
				'link_type' => 'wordpress.org', //wordpress.org 
				'slug' => 'wise-chat'
			),
	);
}