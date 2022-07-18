<?php
/**
 * Template Vertical menu
 *
 * @return string
 * @var $layout
 *
 */
?>
<?php
global $post;

$id = 0;

if ( !empty( $post->ID ) ) {
    $id = $post->ID;
}
if ( $layout == 'popup' ) {
    $classes = 'popup-vertical';
} else {
    $classes = 'box-nav-vertical dukamarket-dropdown';
}
$vertical_menu  = dukamarket_theme_option_meta(
    '_custom_metabox_theme_options',
    'vertical_menu',
    'metabox_vertical_menu'
);
$vertical_title = dukamarket_theme_option_meta(
    '_custom_metabox_theme_options',
    'vertical_title',
    'metabox_vertical_title'
);
$vertical_items = dukamarket_theme_option_meta(
    '_custom_metabox_theme_options',
    'vertical_items',
    'metabox_vertical_items'
);
$show_more      = dukamarket_theme_option_meta(
    '_custom_metabox_theme_options',
    'vertical_show_more',
    'metabox_vertical_show_more'
);
$show_less      = dukamarket_theme_option_meta(
    '_custom_metabox_theme_options',
    'vertical_show_less',
    'metabox_vertical_show_less'
);
$always_open    = dukamarket_get_option( 'vertical_always_open' );
if ( !empty( $always_open ) && is_page() && is_array( $always_open ) && in_array( $id, $always_open ) && $layout != 'popup' ) {
    $classes .= ' always-open';
}
$menu  = wp_get_nav_menu_object( $vertical_menu );
$count = ( $menu instanceof \WP_Term ) ? $menu->count : 0;
if ( !empty( $vertical_menu ) ) : ?>
    <div class="header-vertical">
        <div class="<?php echo esc_attr( $classes ); ?>">
            <?php if ( $layout == 'popup' ) : ?>
                <div class="block-title">
                    <span class="text"><?php echo esc_html( $vertical_title ); ?></span>
                    <a href="#" class="vertical-close">
                        <span class="icon main-icon-close-2"></span>
                    </a>
                </div>
            <?php else: ?>
                <?php if ( !empty( $vertical_title ) ) : ?>
                    <a href="#" data-dukamarket="dukamarket-dropdown" class="block-title">
                        <span class="icon ovic-icon-menu"><span class="inner"><span></span><span></span><span></span></span></span>
                        <span class="text"><?php echo esc_html( $vertical_title ); ?></span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <div class="block-content sub-menu">
                <?php
                wp_nav_menu(
                    array(
                        'menu'            => $vertical_menu,
                        'theme_location'  => $vertical_menu,
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'megamenu'        => true,
                        'mobile_enable'   => true,
                        'menu_class'      => 'dukamarket-nav vertical-menu',
                        'megamenu_layout' => 'vertical',
                    )
                );
                if ( !empty( $vertical_items ) && $count > $vertical_items ) : ?>
                    <div class="view-all-menu">
                        <a href="javascript:void(0);"
                           data-items="<?php echo esc_attr( $vertical_items ); ?>"
                           data-less="<?php echo esc_attr( $show_less ); ?>"
                           data-more="<?php echo esc_attr( $show_more ) ?>"
                           class="btn-view-all open-menu"><?php echo esc_html( $show_more ) ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif;