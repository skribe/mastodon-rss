<?php
/**
 * Plugin Name:       Mastodon RSS Plugin
 * Plugin URI:        https://github.com/skribe/mastodon-rss
 * Description:       A plugin to properly format mastodon rss feeds to be displayed in Wordpress.
 * Version:           1.0.0
 * Requires at least: 6.1
 * Requires PHP:      8.1
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
        $title = apply_filters( 'Mastodon Feed', $instance['title'] );
        $rss_url = $instance['rss_url'];
        
        echo $args['before widget'];
        
        //if title is present
        If ( ! empty ( $title ) )
        echo '<div class="widget mastodon_rss_widget" id="mastodon_rss_widget">';
        echo $args['before_title'] . $title . $args['after_title'];
        
        //this is where we do the work
        // number of items to display
        $number_items = 5;

        $lifetime = 600;

        // rss file to display
        // need to preserve this in db and only collect every 10mins or so
        // $rss_url = 'https://aus.social/@skribe.rss';
        
        function cachetime( $seconds ) 
        {
			return 600;
		}

        add_filter('wp_feed_cache_transient_lifetime', 'cachetime', $rss_url);
        
        if(function_exists('fetch_feed')) 
        {
            $feed = fetch_feed($rss_url);
            if(! is_wp_error( $feed ))
            {
                $origin = $feed->get_channel_tags('', 'generator');
                $gen = substr($origin[0]['data'], 0, 8);
                if (strcmp($gen, 'Mastodon') == 0)
                {
                    $limit = $feed->get_item_quantity($number_items); // specify number of items
                    $items = $feed->get_items(0, $limit); // create an array of items
                    $feed_title = esc_html(strip_tags($feed->get_title()));
            
                    if ($limit == 0) 
                    {
                        echo __( '<div>The feed is either empty or unavailable.</div>', 'mastodon_rss_widget_domain' );
                    }
                    else 
                    {
                        foreach ($items as $item)
                        {
                            echo __( '<ul class = "mastodon-rss-item">', 'mastodon_rss_widget_domain' );
                            echo __( '<p class = "mastodon-rss-title"><a href="'. $item->get_permalink() .'">' . $feed_title . "</a></p>", 'mastodon_rss_widget_domain' );
                            echo __( '<p class = "mastodon-rss-pubdate">' . $item->get_date('j F Y @ g:i a') . '</p>', 'mastodon_rss_widget_domain' );
                            echo __( '<p class = "mastodon-rss-desc">' . substr($item->get_description(), 0, 500) . '</p>', 'mastodon_rss_widget_domain' );
                            echo __( '</ul>', 'mastodon_rss_widget_domain' );                
                        }
                    }
                }
                else
                {
                    echo __( '<div>That is not a Mastodon Feed.</div>', 'mastodon_rss_widget_domain' );
                }
            }
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
        <label for="<?php print $this->get_field_id( 'rss_url' ); ?>">
		<?php _e( 'Mastodon Feed (format: https://mastodon.instance/@username.rss)', 'mastodon_rss_widget_domain' ); ?>
		</label>
		<input style="width:330px;" id="<?php print $this->get_field_id( 'rss_url' ); ?>" name="<?php print $this->get_field_name( 'rss_url' ); ?>" type="text" value="<?php print $instance['rss_url']; ?>" />
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) 
    {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['rss_url'] = ( ! empty( $new_instance['rss_url'] ) ) ? strip_tags( $new_instance['rss_url'] ) : '';
        return $instance;
    }
}
