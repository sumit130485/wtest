<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Menu"
 * @version 1.0.0
 */
class Shortcode_Ovic_Menu extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode = 'ovic_menu';
    public $default   = array();

    public function content( $atts, $content = null )
    {
        $title     = '';
        $classes   = array(
            'ovic-custommenu',
            'wpb_content_element',
            'vc_wp_custommenu',
        );
        $css_class = $this->main_class( $atts, $classes );

        if ( !empty( $atts['nav_menu'] ) ) {
            $menu  = wp_get_nav_menu_object( $atts['nav_menu'] );
            $title = !empty( $menu->name ) ? $menu->name : '';
        }

        ob_start();
        ?>
        <div class="<?php echo esc_attr( $css_class ); ?>" data-name="<?php echo esc_attr( $title ); ?>">
            <?php
            if ( !empty( $atts['nav_menu'] ) ) {
                the_widget( 'WP_Nav_Menu_Widget', $atts, array(
                    'before_title' => '<h3 class="widget-title">',
                    'after_title'  => '</h3>',
                ) );
            }
            ?>
        </div>
        <?php
        return ob_get_clean();
    }
}