<?php
/*
Plugin Name: Mastodon RSS Widget
Plugin URI: https://github.com/skribe/mastodon-rss
Description: A plugin to properly format mastodon rss feeds to be displayed in Wordpress.
Version: 0.1
Author: skribe
Author URI: https://github.com/skribe/
License: GPL2
*/

function mastodon_rss_register_widget() 
{
    register_widget( 'mastodon_rss_widget' );
    
}

add_action( 'widgets_init', 'mastodon_rss_register_widget' );

// The widget class
class mastodon_rss_widget extends WP_Widget {

    // Main constructor
    public function __construct() 
    {

        parent::__construct(
            // widget ID
            'mastodon_rss_widget',
            // widget name
            __( 'Mastodon RSS Widget', 'mastodon_rss_widget_domain' ),
            // Widget Description
            array ('description' => __( 'This plugin provides widget to format Mastodon account feeds to be displayed on Wordpress.', 'mastodon_rss_widget_domain' ),
     	    )
        );
    }

    public function widget( $args, $instance ) 
    {
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before widget'];
        
        //if title is present
        If ( ! empty ( $title ) )
        Echo $args['before_title'] . $title . $args['after_title'];
        
        //this is where we do the work
        echo __( 'Greetings from skribe', 'mastodon_rss_widget_domain' );
        echo $args['after_widget'];
    }
  
    public function form( $instance ) 
    {
        if ( isset( $instance[ 'title' ] ) )
        $title = $instance[ 'title' ];
        else
        $title = __( 'Default Title', 'mastodon_rss_widget_domain' );
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) 
    {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
}

