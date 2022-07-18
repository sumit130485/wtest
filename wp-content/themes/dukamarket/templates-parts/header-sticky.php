<div id="header-sticky" class="header-sticky megamenu-wrap">
    <div class="container">
        <div class="header-inner">
            <?php dukamarket_vertical_menu(); ?>
            <div class="box-header-nav">
                <?php dukamarket_primary_menu(); ?>
            </div>
            <div class="header-control">
                <div class="inner-control">
                    <?php
                    dukamarket_header_search_popup( true );
                    dukamarket_header_user();
                    if ( function_exists( 'dukamarket_header_wishlist' ) ) dukamarket_header_wishlist();
                    if ( function_exists( 'dukamarket_header_mini_cart' ) ) dukamarket_header_mini_cart();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>