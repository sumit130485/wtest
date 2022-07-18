<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
 * @version     3.3.0
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *
 * SETUP SHOP LOOP
 */
dukamarket_woocommerce_setup_loop();

$short_text       = dukamarket_get_option( 'short_text' );
$disable_labels   = dukamarket_get_option( 'disable_labels' );
$disable_rating   = dukamarket_get_option( 'disable_rating' );
$disable_add_cart = dukamarket_get_option( 'disable_add_cart' );
$columns          = wc_get_loop_prop( 'columns' );
$product_style    = wc_get_loop_prop( 'style' );
$class            = array(
    "products",
    "shop-page",
    "response-content",
    "columns-{$columns}",
    "ovic-products {$product_style}",
);
if ( $product_style == 'style-02' )
    $class[] = 'style-01';
if ( $product_style == 'style-04' )
    $class[] = 'style-03';
if ( $product_style == 'style-06' )
    $class[] = 'style-05';
if ( $product_style == 'style-09' )
    $class[] = 'style-08';
if ( $short_text == 1 )
    $class[] = 'short-text-yes';
if ( $disable_labels == 1 )
    $class[] = 'labels-not-yes';
if ( $disable_rating == 1 )
    $class[] = 'rating-not-yes';
if ( $disable_add_cart == 1 )
    $class[] = 'add-cart-not-yes';

/**
 *
 * SHOP CONTROL
 */
dukamarket_control_before_shop_loop();
?>
<ul class="<?php echo esc_attr( implode( ' ', $class ) ); ?>">
