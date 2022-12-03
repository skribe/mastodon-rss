<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       		https://github.com/skribe/mastodon-rss
 * @since      		0.1.0
 *
 * @package    		Mastodon_RSS
 * @subpackage 		Mastodon_RSS/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      		0.1.0
 *
 * @package         Mastodon_RSS
 * @subpackage 		Mastodon_RSS/includes
 * @author     		skribe
 */
class Mastodon_RSS_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.1.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mastodon-rss',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
