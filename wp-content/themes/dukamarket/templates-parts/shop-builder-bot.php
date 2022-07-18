<?php
/**
 * Template Shop Builder Bottom
 *
 * @return string
 */
?>
<?php
$banner = dukamarket_get_option( 'shop_builder_bot' );
if ( !empty( $banner ) ):
    ?>
    <div class="shop-builder shop-builder-bot">
        <?php
        $image_id = 0;
        if ( is_product_taxonomy() && 0 === absint( get_query_var( 'paged' ) ) ) {
            $term = get_queried_object();
            if ( $term && $term->taxonomy == 'product_brand' ) {
                $image_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
            }
            if ( $term && $term->taxonomy == 'product_cat' ) {
                $image_id = get_term_meta( $term->term_id, 'banner_id', true );
            }
        }
        if ( $image_id > 0 ) {
            echo wp_get_attachment_image( $image_id, 'full' );
        } else {
            if ( class_exists( 'Elementor\Plugin' ) && Elementor\Plugin::$instance->db->is_built_with_elementor( $banner ) ) {
                echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $banner );
            } else {
                $post_id = get_post( $banner );
                $content = $post_id->post_content;
                $content = apply_filters( 'the_content', $content );
                $content = str_replace( ']]>', ']]>', $content );
                echo wp_specialchars_decode( $content );
            }
        }
        ?>
    </div>
<?php endif; ?>
