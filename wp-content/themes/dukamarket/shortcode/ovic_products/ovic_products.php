<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Products"
 * @version 1.0.0
 */
class Shortcode_Ovic_Products extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $is_woocommerce = true;
    public $shortcode      = 'ovic_products';
    public $default        = array(
        'product_style'               => 'style-01',
        'pagination'                  => 'none',
        'target'                      => 'recent_products',
        'list_style'                  => 'none',
        'border_style_2'              => '',
        'border_style'                => '',
        'product_image_size'          => '300x300',
        'product_custom_thumb_width'  => '300',
        'product_custom_thumb_height' => '300',
        'slides_rows_space'           => '',
        'attribute'                   => '',
        'filter'                      => '',
        'ids'                         => '',
        'skus'                        => '',
        'limit'                       => '6',
        'order'                       => '',
        'orderby'                     => '',
        'category'                    => '',
        'category_brand'              => '',
        'slide_nav'                   => '',
        'slide_dot'                   => '',
        'overflow_visible'            => '',
        'main_bora'                   => '',
        'main_bora_wrap'              => '',
    );

    public function content( $atts, $content = null )
    {
        $html      = '';
        $css_class = array(
            'ovic-products',
            $atts['slide_dot'],
            $atts['slide_nav'],
            $atts['product_style'],
            $atts['border_style_2'],
            $atts['border_style'],
            $atts['main_bora'],
            $atts['main_bora_wrap'],
        );
        if ( empty( $atts['_id'] ) ) {
            $atts['_id'] = uniqid();
        }
        if ( $atts['pagination'] != 'none' ) {
            $css_class[] = "products_{$atts['_id']}";
            $css_class[] = "{$atts['pagination']}-products";
        }
        if ( $atts['overflow_visible'] == 'yes' ) {
            $css_class[] = "content-overflow";
        }
        if ( $atts['product_style'] == 'style-02' )
            $css_class[] = 'style-01';
        if ( $atts['product_style'] == 'style-04' )
            $css_class[] = 'style-03';
        if ( $atts['product_style'] == 'style-06' )
            $css_class[] = 'style-05';
        if ( $atts['product_style'] == 'style-09' )
            $css_class[] = 'style-08';
        $css_class = $this->main_class( $atts, $css_class );
        /**
         * BEFORE SHORTCODE
         */
        $this->get_template( 'layout/shortcode_before.php',
            array(
                'atts'          => $atts,
                'ovic_products' => $this,
            )
        );
        /**
         * CONTENT PRODUCTS
         */
        $html .= '<div data-id="products_' . esc_attr( $atts['_id'] ) . '" class="' . esc_attr( $css_class ) . '">';
        if ( $atts['target'] == 'products' && $atts['ids'] == '' ) {
            $atts['target'] = '';
        }
        if ( $atts['target'] != '' ) {
            $html .= ovic_do_shortcode( $atts['target'], dukamarket_shortcode_products_query( $atts ) );
        } else {
            $html .= '<span>' . esc_html__( 'No Product', 'dukamarket' ) . '</span>';
        }
        $html .= '</div>';
        /**
         * AFTER SHORTCODE
         */
        $this->get_template( 'layout/shortcode_after.php',
            array(
                'atts'          => $atts,
                'ovic_products' => $this,
            )
        );

        return $html;
    }
}