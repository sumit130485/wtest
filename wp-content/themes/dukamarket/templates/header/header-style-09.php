<?php
/**
 * Name: Header 09
 **/
?>
<?php
$header_submenu   = dukamarket_theme_option_meta(
    '_custom_metabox_theme_options',
    'header_submenu',
    'metabox_header_submenu'
);
$header_submenu_2 = dukamarket_theme_option_meta(
    '_custom_metabox_theme_options',
    'header_submenu_2',
    'metabox_header_submenu_2'
);
$header_message   = dukamarket_theme_option_meta(
    '_custom_metabox_theme_options',
    'header_message',
    'metabox_header_message'
);
?>
<header id="header" class="header style-09">
    <?php if ( !empty( $header_submenu ) || !empty( $header_submenu_2 ) || !empty( $header_message ) ) : ?>
        <div class="header-top light">
            <div class="header-inner">
                <div class="header-start">
                    <?php dukamarket_header_submenu( 'header_submenu' ); ?>
                    <?php dukamarket_header_message(); ?>
                </div>
                <div class="header-end">
                    <?php dukamarket_header_submenu( 'header_submenu_2' ); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="header-mid megamenu-wrap header-sticky">
        <div class="header-inner">
            <?php echo dukamarket_get_logo(); ?>
            <div class="header-center">
                <?php dukamarket_vertical_menu_button(); ?>
                <div class="box-header-nav">
                    <?php dukamarket_primary_menu(); ?>
                </div>
            </div>
            <div class="header-control">
                <div class="inner-control">
                    <?php
                    dukamarket_header_menu_bar();
                    dukamarket_header_search_popup( true );
                    dukamarket_header_user();
                    if ( function_exists( 'dukamarket_header_wishlist' ) ) dukamarket_header_wishlist();
                    if ( function_exists( 'dukamarket_header_mini_cart' ) ) dukamarket_header_mini_cart();
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>
