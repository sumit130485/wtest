<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post, $product;

$html = '';

/* LABEL NEW */
$datestamp = strtotime( get_the_time( 'Y-m-d' ) );
$newness   = dukamarket_get_option( 'product_newness', 0 );
if ( $newness > 0 && ( time() - ( 60 * 60 * 24 * (int)$newness ) ) < (int)$datestamp ) {
    $html .= '<span class="onnew product-label"><span class="text">' . esc_html__( 'New', 'dukamarket' ) . '</span></span>';
}
/* LABEL SALE */
if ( $product->is_on_sale() && $product->is_type( 'simple' ) ) {
    $percent = dukamarket_sale_percent();
    $html    .= '<span class="onsale product-label">';
    $html    .= '<span class="text">' . esc_html__( 'Sale', 'dukamarket' ) . '</span>';
    $html    .= '<span class="text text-2">' . esc_html__( 'Save ', 'dukamarket' ) . '</span>';
    $html    .= '<span class="percent"><span class="minus">-</span>' . esc_html( $percent ) . '<span class="symbol">%</span></span>';
    $html    .= '</span>';
}
/* LABEL FEATURED */
if ( $product->is_featured() ) {
    $html .= '<span class="featured product-label"><span class="text">' . esc_html__( 'Hot', 'dukamarket' ) . '</span></span>';
}
/* LABEL STOCK */
if ( !$product->is_in_stock() && $product->is_type( 'simple' ) ) {
    $html .= '<span class="out-of-stock product-label"><span class="text">' . esc_html__( 'Sold out', 'dukamarket' ) . '</span></span>';
}


/* LABEL WRAPPER */
if ( !empty( $html ) ) {
    echo apply_filters( 'woocommerce_sale_flash',
        '<div class="product-labels">' . wp_specialchars_decode( $html ) . '</div>', $post, $product
    );
}

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
