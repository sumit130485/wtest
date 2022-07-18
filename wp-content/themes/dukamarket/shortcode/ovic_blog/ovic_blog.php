<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Blog"
 * @version 1.0.0
 */
class Shortcode_Ovic_Blog extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode = 'ovic_blog';
    public $default   = array(
        'style'             => 'style-01',
        'list_style'        => 'owl',
        'slides_rows_space' => '',
        'slide_nav'         => '',
        'image_full_size'   => '',
        'limit'             => 6,
        'orderby'           => '',
        'order'             => '',
        'image_width'       => 272,
        'image_height'      => 170,
        'excerpt'           => 9,
    );

    public function content( $atts, $content = null )
    {
        $css_class       = $this->main_class( $atts, array(
            'ovic-blog',
            $atts['style']
        ) );
        $post_list_class = array(
            'content-post'
        );
        if ( $atts['list_style'] == 'owl' ) {
            $css_class         .= ' ' . $atts['slides_rows_space'] . ' ' . $atts['slide_nav'];
            $post_list_class[] = 'equal-container better-height';
            $owl_settings      = '';
            if ( !empty( $atts['slides_to_show'] ) ) {
                $post_list_class[] = 'owl-slick';
                $owl_settings      = $this->generate_carousel( $atts );
            }
            if ( !empty( $atts['carousel'] ) ) {
                $post_list_class[] = 'owl-slick';
                $owl_settings      = htmlspecialchars( ' data-slick=' . json_encode( $atts['carousel'] ) . ' ' );
            }
        }
        $i               = 0;
        $post_item_class = array( 'blog-item', $atts['style'] );
        $query           = new WP_Query( dukamarket_shortcode_posts_query( $atts ) );
        if ( $atts['image_full_size'] == 'yes' ) {
            add_filter( 'dukamarket_post_thumbnail_width', function () {
                return false;
            } );
            add_filter( 'dukamarket_post_thumbnail_height', function () {
                return false;
            } );
        }
        ob_start();
        ?>
        <div class="<?php echo esc_attr( $css_class ); ?>">
            <?php if ( $query->have_posts() ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $post_list_class ) ); ?>" <?php if ( $atts['list_style'] == 'owl' ) echo esc_attr( $owl_settings ); ?>>
                    <?php while ( $query->have_posts() ) :
                        $query->the_post();
                        $format    = 'format-standard';
                        $post_meta = get_post_meta( get_the_ID(), '_custom_metabox_post_options', true );
                        if ( !empty( $post_meta['type'] ) ) {
                            $format = 'format-' . $post_meta['type'];
                        }
                        $post_item_class[] = $format;
                        $i++;
                        ?>
                        <article <?php post_class( $post_item_class ); ?>>
                            <?php
                            $this->get_template( "layout/{$atts['style']}.php",
                                array(
                                    'atts' => $atts,
                                )
                            );
                            ?>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
        <?php
        if ( $atts['image_full_size'] == 'yes' ) {
            remove_all_filters( 'dukamarket_post_thumbnail_width' );
            remove_all_filters( 'dukamarket_post_thumbnail_height' );
        }

        return ob_get_clean();
    }
}