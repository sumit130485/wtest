<?php
/**
 * Name: Header 01
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
?>
<header id="header" class="header style-01 light">
    <?php if ( !empty( $header_submenu ) || !empty( $header_submenu_2 ) ) : ?>
        <div class="header-top">
            <div class="container">
                <div class="header-inner">
                    <div class="header-start">
                        <?php dukamarket_header_submenu( 'header_submenu' ); ?>
                    </div>
                    <div class="header-end">
                        <?php dukamarket_header_submenu( 'header_submenu_2' ); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="header-mid">
        <div class="container">
            <div class="header-inner">
                <?php echo dukamarket_get_logo(); ?>
                <div class="header-center">
                    <?php dukamarket_header_search( true ); ?>
                </div>
                <div class="header-control">
                    <div class="inner-control">
                        <?php
                        dukamarket_header_user();
                        if ( function_exists( 'dukamarket_header_wishlist' ) ) dukamarket_header_wishlist();
                        if ( function_exists( 'dukamarket_header_mini_cart' ) ) dukamarket_header_mini_cart();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bot megamenu-wrap header-sticky">
        <div class="container">
            <div class="header-inner">
                <?php dukamarket_vertical_menu(); ?>
                <div class="box-header-nav">
                    <?php dukamarket_primary_menu(); ?>
                    <?php dukamarket_header_menu_bar(); ?>
                </div>
                <?php dukamarket_header_message(); ?>
            </div>
        </div>
    </div>
</header>
