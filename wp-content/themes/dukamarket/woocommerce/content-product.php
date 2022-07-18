<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || !$product->is_visible() ) {
    return;
}

$product_class = wc_get_loop_prop( 'class' );
$page_layout   = wc_get_loop_prop( 'page_layout' );
$product_style = wc_get_loop_prop( 'style' );
$short_title   = wc_get_loop_prop( 'short_title' );
$is_shortcode  = wc_get_loop_prop( 'is_shortcode' );
if ( $page_layout == 'list' )
    $product_style = 'list';
$classes = array( 'product-item', $product_style );
if ( $product_style == 'style-02' )
    $classes[] = 'style-01';
if ( $product_style == 'style-04' )
    $classes[] = 'style-03';
if ( $product_style == 'style-06' )
    $classes[] = 'style-05';
if ( $product_style == 'style-09' )
    $classes[] = 'style-08';
if ( $short_title == 1 )
    $classes[] = 'short-title';
if ( !empty( $product_class ) ) {
    if ( is_array( $product_class ) ) {
        $classes = array_merge( $classes, $product_class );
    } elseif ( is_string( $product_class ) ) {
        $classes[] = $product_class;
    }
}
?>
<li data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" <?php wc_product_class( $classes, $product ); ?>>
    <?php wc_get_template_part( 'product-style/content-product', $product_style ); ?>
</li>
