<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link            https://github.com/skribe/mastodon-rss
 * @since           0.1.0
 * @package         Mastodon_RSS
 * @subpackage 		Mastodon_RSS/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @since           0.1.0
 * @package         Mastodon_RSS
 * @subpackage 		Mastodon_RSS/admin
 * @author     		skribe
 */
class Mastodon_RSS_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $mastodon_rss    The ID of this plugin.
	 */
	private $mastodon_rss;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    	0.1.0
	 * @param      string    $mastodon_rss       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $mastodon_rss, $version ) {

		$this->mastodon_rss = $mastodon_rss;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->mastodon_rss, plugin_dir_url( __FILE__ ) . 'css/mastodon-rss-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->mastodon_rss, plugin_dir_url( __FILE__ ) . 'js/mastodon-rss-admin.js', array( 'jquery' ), $this->version, false );

	}

}
