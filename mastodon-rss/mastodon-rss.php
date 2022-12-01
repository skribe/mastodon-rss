<?php
/**
 * Plugin Name:       Mastodon RSS Plugin
 * Plugin URI:        https://github.com/skribe/mastodon-rss
 * Description:       A plugin to properly format mastodon rss feeds to be displayed in Wordpress.
 * Version:           0.3
 * Requires at least: 6.1
 * Requires PHP:      7.4
 * Author:            skribe
 * Author URI:        https://github.com/skribe
 * License:           GPL v3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Update URI:        mastodon-rss
 * Text Domain:       mastodon-rss
 * Domain Path:       /languages
 */

function mastodon_rss_styles()
{
    wp_enqueue_style( 'mastodon-rss-style', plugins_url('style.css', __FILE__) );
} 

add_action( 'wp_enqueue_scripts', 'mastodon_rss_styles');

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
        $title = apply_filters( 'Mastodon', $instance['title'] );
        echo $args['before widget'];
        
        //if title is present
        If ( ! empty ( $title ) )
        echo '<div class="widget mastodon_rss_widget" id="mastodon_rss_widget">';
        Echo $args['before_title'] . $title . $args['after_title'];
        
        //this is where we do the work
        // number of items to display
        $number_items = 5;

        // rss file to display
        // need to preserve this in db and only collect every 10mins or so
        $file = 'https://aus.social/@skribe.rss';

        if ($rss = simplexml_load_file($file))
        {
            $i = 0;
            foreach ($rss->channel->item as $item) 
            {
                echo __( '<ul class = "mastodon-rss-item">', 'mastodon_rss_widget_domain' );
                echo __( '<p class = "mastodon-rss-title"><a href="'. $item->link .'">' . $rss->channel->title . "</a></p>", 'mastodon_rss_widget_domain' );
                echo __( '<p class = "mastodon-rss-pubdate">' . $item->pubDate . '</p>', 'mastodon_rss_widget_domain' );
                echo __( '<p class = "mastodon-rss-desc">' . $item->description . '</p>', 'mastodon_rss_widget_domain' );
                echo __( '</ul>', 'mastodon_rss_widget_domain' );
        
                // stops after displaying number of items
                // this should be a hardcoded choice.
                if (++$i == $number_items) break;
            } 
        }
        else
        {
            echo __( 'RSS feed failed to load', 'mastodon_rss_widget_domain' );
        }
        echo $args['after_widget'];
        echo '</div>';
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
