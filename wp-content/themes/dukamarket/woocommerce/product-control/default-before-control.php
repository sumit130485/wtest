<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php
echo woocommerce_maybe_show_product_subcategories();
?>
<div class="shop-control shop-before-control">
    <?php dukamarket_shop_display_mode() ?>
    <?php woocommerce_result_count(); ?>
    <div class="clear"></div>
    <div class="display-per-page">
        <?php dukamarket_shop_per_page(); ?>
    </div>
    <div class="display-sort-by">
        <?php woocommerce_catalog_ordering(); ?>
    </div>
</div>
