<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Category"
 * @version 1.0.0
 */
class Shortcode_Ovic_Category extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode      = 'ovic_category';
    public $is_woocommerce = true;
    public $default        = array(
        'style' => 'style-01',
    );

    public function content( $atts, $content = null )
    {
        $css_class = $this->main_class( $atts, array(
            'ovic-category',
            $atts['style']
        ) );
        if ( $atts['style'] == 'style-06' )
            $css_class .= ' style-05';
        ob_start(); ?>
        <div class="<?php echo esc_attr( $css_class ); ?>">
            <?php if ( !empty( $atts['category'] ) ):
                $term = get_term_by( 'slug', $atts['category'], 'product_cat' );
                if ( !is_wp_error( $term ) && !empty( $term ) ): ?>
                    <?php
                    $term_link = get_term_link( $term->term_id, 'product_cat' );
                    if ( !empty( $atts['image']['id'] ) ) {
                        $image = $atts['image']['id'];
                    } else {
                        $image = get_term_meta( $term->term_id, 'thumbnail_id', true );
                    }
                    if ( !empty( $atts['title'] ) ) {
                        $title = $atts['title'];
                    } else {
                        $title = $term->name;
                    }
                    ?>
                    <a href="<?php echo esc_url( $term_link ); ?>" class="link <?php echo esc_attr( $atts['image_effect'] ); ?>">
                        <?php if ( !empty( $atts['image_icon']['value'] ) ) : ?>
                            <span class="icon"><?php \Elementor\Icons_Manager::render_icon( $atts['image_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                        <?php elseif ( !empty( $image ) ): ?>
                            <span class="thumb">
                                <span class="image-effect"
                                      style="background-image: url(<?php echo esc_url( wp_get_attachment_image_url( $image, 'full' ) ); ?>);">
                                </span>
                            </span>
                        <?php endif; ?>
                        <span class="content">
                            <span class="content-inner">
                                <span class="title"><?php echo esc_html( $title ); ?></span>
                                <?php if ( $atts['count'] == 'yes' ): ?>
                                    <span class="count"><?php echo '(' . $term->count . esc_html__( ' Products', 'dukamarket' ) . ')'; ?></span>
                                <?php endif; ?>
                            </span>
                        </span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}