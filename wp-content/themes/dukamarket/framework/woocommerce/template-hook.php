<?php
/***
 * Core Name: WooCommerce
 * Version: 1.0.0
 * Author: Khanh
 */
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
/**
 *
 * VENDOR WOOCOMMERCE
 */
include_once dirname( __FILE__ ) . '/template-functions.php';
/**
 *
 * GLOBAL PRODUCTS QUERY
 */
add_action( 'woocommerce_product_query', 'dukamarket_product_query' );
/**
 *
 * REMOVE CSS
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
/**
 *
 * REMOVE PAGE TITLE
 */
add_filter( 'woocommerce_show_page_title', '__return_false' );
/**
 *
 * REMOVE BREADCRUMB
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
/**
 *
 * REMOVE SUB CATEGORIES
 */
add_filter( 'woocommerce_before_output_product_categories',
    function () {
        return '<ul class="shop-page columns-' . esc_attr( wc_get_loop_prop( 'columns' ) ) . '">';
    }
);
add_filter( 'woocommerce_after_output_product_categories',
    function () {
        return '</ul>';
    }
);
call_user_func( 'remove' . '_' . 'filter', 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );
/**
 *
 * PAGINATION COMMENT PRODUCT
 */
add_filter( 'woocommerce_comment_pagination_args',
    function ( $args ) {
        $args['prev_text'] = esc_html__( 'Prev', 'dukamarket' );
        $args['next_text'] = esc_html__( 'Next', 'dukamarket' );

        return $args;
    }
);
/**
 *
 * REMOVE "woocommerce_template_loop_product_link_open"
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
/**
 *
 * REMOVE DESCRIPTION HEADING, INFOMATION HEADING
 */
add_filter( 'woocommerce_product_description_heading', function () {
    return '';
} );
add_filter( 'woocommerce_product_additional_information_heading', function () {
    return '';
} );
/**
 *
 * CUSTOM CATALOG ORDERING
 */
add_filter( 'woocommerce_catalog_orderby',
    function ( $options ) {
        $options['menu_order'] = esc_html__( 'Default Sorting', 'dukamarket' );
        $options['popularity'] = esc_html__( 'Popularity', 'dukamarket' );
        $options['rating']     = esc_html__( 'Average Rating', 'dukamarket' );
        $options['date']       = esc_html__( 'Latest', 'dukamarket' );
        $options['price']      = esc_html__( 'Price: Low To High', 'dukamarket' );
        $options['price-desc'] = esc_html__( 'Price: High To Low', 'dukamarket' );
        $options['sale']       = esc_html__( 'Sale', 'dukamarket' );
        $options['on-sale']    = esc_html__( 'On-Sale', 'dukamarket' );
        $options['feature']    = esc_html__( 'Feature', 'dukamarket' );

        return $options;
    }
);
/**
 *
 * CUSTOM PRODUCT POST PER PAGE
 */
add_filter( 'loop_shop_per_page', 'dukamarket_loop_shop_per_page', 20 );
add_filter( 'woof_products_query', 'dukamarket_woof_products_query', 20 );
/**
 *
 * CUSTOM SHOP CONTROL
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
/**
 *
 * PRODUCT THUMBNAIL
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'dukamarket_template_loop_product_thumbnail', 10 );
/**
 *
 * CUSTOM PRODUCT NAME
 */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'dukamarket_template_loop_product_title', 10 );
/**
 *
 * WOOCOMMERCE PAGE TITLE
 */
add_filter( 'woocommerce_show_page_title', '__return_false' );
/**
 *
 * HOOK RELATED ITEMS
 */
add_filter( 'woocommerce_output_related_products_args',
    function ( $args ) {
        $args['posts_per_page'] = dukamarket_get_option( 'woo_related_perpage', '6' );

        return $args;
    }
);
/**
 *
 * HOOK CROSS SELL
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );
/**
 *
 * HOOK MINI CART
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'dukamarket_cart_link_fragment' );
/**
 *
 * HOOK MY ACCOUNT
 */
remove_action( 'woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10 );
add_action( 'woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 4 );
/**
 *
 * FILTER MINI CART THUMBNAIL
 */
add_filter( 'woocommerce_cart_item_thumbnail', function ( $thumbnail, $cart_item, $cart_item_key ) {
    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

    return $_product->get_image( 120 );
}, 10, 3 );
/**
 *
 * FILTER PRODUCT THUMBNAIL
 */
add_filter( 'woocommerce_get_image_size_gallery_thumbnail',
    function () {
        $size = apply_filters( 'dukamarket_get_image_size_gallery_thumbnail', $size = array(
            'width'  => 58,
            'height' => 0,
            'crop'   => 0,
        ) );

        return $size;
    }
);
/**
 *
 * VENDOR HOOK
 */
// Dokan
if ( class_exists( 'WeDevs_Dokan' ) ) {
//    add_filter( 'dokan_product_variations_per_page', function (){ return 12; } );
//    add_action( 'dokan_dashboard_wrap_before', 'woocommerce_output_content_wrapper' );
//    add_action( 'dokan_dashboard_wrap_after', 'woocommerce_output_content_wrapper_end' );
    add_filter( 'dokan_store_listing_per_page', function ( $defaults ) {
        $defaults['per_page'] = 9;
        return $defaults;
    } );
    add_action( 'woocommerce_shop_loop_item_title', 'dukamarket_dokan_sold_by_text', 10 );
    add_action( 'woocommerce_shop_loop_item_title', function () {
        echo '<div></div>';
    }, 10 );
    add_action( 'woocommerce_single_product_summary', 'dukamarket_dokan_sold_by_text', 6 );
    if ( !function_exists( 'dukamarket_dokan_sold_by_text' ) ) {
        function dukamarket_dokan_sold_by_text()
        {
            global $product;
            if ( $product ) {
                $author_id  = get_post_field( 'post_author', $product->get_id() );
                $author     = get_user_by( 'id', $author_id );
                $store_info = dokan_get_store_info( $author->ID );
                echo apply_filters( 'ovic_dokan_sold_by_text',
                    sprintf( '<a class="by-vendor-name-link" href="%s"><span class="text">%s</span> %s</a>',
                        esc_url( dokan_get_store_url( $author->ID ) ),
                        esc_html__( 'Sold by', 'dukamarket' ),
                        esc_html( $store_info['store_name'] )
                    ), $author );
            }
        }
    }
}
// WCFM
// ...
if ( class_exists( 'WC_Vendors' ) ) {
    remove_action( 'woocommerce_after_shop_loop_item', array( 'WCV_Vendor_Shop', 'template_loop_sold_by' ), 9 );
    add_action( 'woocommerce_shop_loop_item_title', array( 'WCV_Vendor_Shop', 'template_loop_sold_by' ), 9 );
}
// WC Marketplace
if ( class_exists( 'WCMp' ) ) {
    if ( !function_exists( 'dukamarket_wcmp_sold_by_text' ) ) {
        function dukamarket_wcmp_sold_by_text()
        {
            global $WCMp;
            remove_action( 'woocommerce_after_shop_loop_item', array(
                $WCMp->vendor_caps,
                'wcmp_after_add_to_cart_form'
            ), 6 );
            remove_action( 'woocommerce_product_meta_start', array(
                $WCMp->vendor_caps,
                'wcmp_after_add_to_cart_form'
            ), 25 );
            add_action( 'woocommerce_shop_loop_item_title', array( $WCMp->vendor_caps, 'wcmp_after_add_to_cart_form' ), 6 );
            add_action( 'woocommerce_single_product_summary', array(
                $WCMp->vendor_caps,
                'wcmp_after_add_to_cart_form'
            ), 6 );
        }
    }
    add_action( 'init', 'dukamarket_wcmp_sold_by_text' );
}
/**
 *
 * QUANTITY ARROWS
 */
add_action( 'woocommerce_before_quantity_input_field', function () {
    echo '<a href="#" class="arrow minus quantity-minus"></a>';
}, 10 );
add_action( 'woocommerce_after_quantity_input_field', function () {
    echo '<a href="#" class="arrow plus quantity-plus"></a>';
}, 10 );