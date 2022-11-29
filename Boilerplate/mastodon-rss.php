<?php

 /**
 * @link             https://github.com/skribe/mastodon-rss
 * @since            0.1.0
 * @package          Mastodon_RSS
 * 
 * @wordpress-plugin
 * Plugin Name:      Mastodon RSS Plugin
 * Plugin URI:       https://github.com/skribe/mastodon-rss
 * Description:      A plugin to properly format mastodon rss feeds to be displayed in Wordpress.
 * Version:          0.4.0
 * Requires at least:6.1
 * Requires PHP:     7.4
 * Author:           skribe
 * Author URI:       https://github.com/skribe
 * License:          GPL v3
 * License URI:      https://www.gnu.org/licenses/gpl-3.0.html
 * Update URI:       mastodon-rss
 * Text Domain:      mastodon-rss
 * Domain Path:      /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MASTODON_RSS_VERSION', '0.4.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_mastodon_rss() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mastodon-rss-activator.php';
	Plugin_Name_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_mastodon_rss() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mastodon-rss-deactivator.php';
	Plugin_Name_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mastodon_rss' );
register_deactivation_hook( __FILE__, 'deactivate_mastodon_rss' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mastodon-rss.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function run_mastodon_rss() {

	$plugin = new Mastodon_RSS();
	$plugin->run();

}
run_mastodon_rss();
