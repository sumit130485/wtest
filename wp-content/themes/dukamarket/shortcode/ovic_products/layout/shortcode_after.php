<?php
/**
 * Template After
 *
 * @return string
 *
 * @var $atts
 * @var $ovic_products
 */
?>
<?php
remove_all_filters( 'woocommerce_product_loop_start', 30 );
remove_all_filters( 'woocommerce_product_loop_end', 30 );
remove_all_filters( 'woocommerce_shortcode_products_query' );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
/**
 * ACTION AFTER SHORTCODE
 */
do_action( 'ovic_after_shortcode_products', $atts, $ovic_products );
