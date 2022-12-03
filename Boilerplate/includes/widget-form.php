<?php

/**
 * The file that defines the core plugin class
 *
 * Widget settings layout and information
 *
 * @link            https://github.com/skribe/mastodon-rss
 * @since           0.1.0
 * @package         Mastodon_RSS
 * @subpackage 		Mastodon_RSS/includes
 */
?>

<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>