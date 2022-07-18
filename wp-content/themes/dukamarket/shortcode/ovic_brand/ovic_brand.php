<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Brand"
 * @version 1.0.0
 */
class Shortcode_Ovic_Brand extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode      = 'ovic_brand';
    public $is_woocommerce = true;
    public $default        = array(
        'slides_rows_space' => '',
        'slide_nav'         => '',
    );

    public function content( $atts, $content = null )
    {
        $css_class = $this->main_class( $atts, array(
            'ovic-brand',
            $atts['slides_rows_space'],
            $atts['slide_nav']
        ) );
        ob_start(); ?>
        <div class="<?php echo esc_attr( $css_class ); ?>">
            <?php if ( !empty( $atts['category'] ) ):
                $owl_settings = $this->generate_carousel( $atts ); ?>
                <div class="owl-slick" <?php echo esc_attr( $owl_settings ); ?>>
                    <?php foreach ( $atts['category'] as $category ) : ?>
                        <?php
                        $term = get_term_by( 'slug', $category, 'product_brand' );
                        if ( !is_wp_error( $term ) && !empty( $term ) ): ?>
                            <?php
                            $term_link    = get_term_link( $term->term_id, 'product_brand' );
                            $thumbnail_id = get_term_meta( $term->term_id, 'logo_id', true );
                            ?>
                            <div class="item">
                                <a href="<?php echo esc_url( $term_link ); ?>" class="link <?php echo esc_attr( $atts['image_effect'] ); ?>">
                                    <?php if ( !empty( $thumbnail_id ) ) : ?>
                                        <span class="thumb"><span class="image"><?php echo wp_get_attachment_image( $thumbnail_id, 'full' ); ?></span></span>
                                    <?php else: ?>
<!--                                        <span class="title image-effect">--><?php //echo esc_html( $term->name ); ?><!--</span>-->
                                        <span class="title image-effect"><?php echo '<span>' . esc_html__( 'Brand', 'dukamarket' ) . '</span>' . esc_html__( 'Logo', 'dukamarket' ); ?></span>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}