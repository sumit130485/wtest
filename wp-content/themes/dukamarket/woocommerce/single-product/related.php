<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.9.0
 * @var $related_products
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

$data    = dukamarket_generate_carousel_products( 'woo_related' );
$section = array(
    'related products ovic-products',
    $data['style'],
    $data['class_added']
);

if ( $related_products && !empty( $data ) ) : ?>

    <section class="<?php echo esc_attr( implode( ' ', $section ) ); ?>">

        <?php
        $heading = !empty( $data['title'] ) ? $data['title'] : esc_html__( 'Related Products', 'dukamarket' );
        $heading = apply_filters( 'woocommerce_product_related_products_heading', $heading );
        ?>
        <div class="ovic-heading style-01">
            <h2 class="heading"><?php echo esc_html( $heading ); ?></h2>
        </div>

        <div class="owl-slick products product-list-owl rows-space-0 equal-container better-height" <?php echo esc_attr( $data['carousel'] ); ?>>

            <?php foreach ( $related_products as $related_product ) : ?>

                <?php
                $post_object = get_post( $related_product->get_id() );
                $classes     = array( 'product-item', $data['style'] );

                setup_postdata( $GLOBALS['post'] =& $post_object );
                ?>
                <div <?php wc_product_class( $classes, $related_product ); ?>>
                    <?php wc_get_template_part( 'product-style/content-product', $data['style'] ); ?>
                </div>

            <?php endforeach; ?>

            <?php
            wp_reset_postdata();
            wc_reset_loop();
            ?>

        </div>

    </section>

<?php endif;
