<?php
/**
 *
 * Name: Product Style 08
 * Shortcode: true
 * Theme Option: true
 **/
?>
<?php
global $product;
?>
<div class="product-inner">
    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    do_action( 'woocommerce_before_shop_loop_item' );
    ?>
    <div class="product-thumb images tooltip-wrap tooltip-top">
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item_title.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>
        <div class="group-button style-1">
            <?php
            if ( !dukamarket_is_mobile() ) {
                do_action( 'dukamarket_function_shop_loop_item_quickview' );
                do_action( 'dukamarket_function_shop_loop_item_wishlist' );
                do_action( 'dukamarket_function_shop_loop_item_compare' );
            }
            ?>
        </div>
    </div>
    <div class="product-info equal-elem">
        <?php
        /**
         * Hook: woocommerce_shop_loop_item_title.
         *
         * @hooked woocommerce_template_loop_product_title - 10
         */
        do_action( 'woocommerce_shop_loop_item_title' );
        /**
         * Hook: woocommerce_after_shop_loop_item_title.
         *
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action( 'woocommerce_after_shop_loop_item_title' );
        ?>
    </div>
    <?php
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_close - 5
     * @hooked woocommerce_template_loop_add_to_cart - 10
     */
    do_action( 'woocommerce_after_shop_loop_item' );
    ?>
</div>
