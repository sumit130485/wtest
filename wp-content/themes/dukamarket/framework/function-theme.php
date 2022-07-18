<?php if ( !defined( 'ABSPATH' ) ) {
    die;
} // Cannot access pages directly.

if ( dukamarket_is_mobile() ) {
    require_once get_theme_file_path( '/framework/function-mobile.php' );
}

add_filter( 'ovic_get_api_libary_elementor', function ( $url, $api, $info ) {
    return str_replace(
        '{THEME_URI}/libary-elementor/',
        'https://dukamarket.kutethemes.net/dukamarket/',
        $api
    );
}, 10, 3 );

add_filter( 'ovic_menu_toggle_mobile', '__return_false' );
add_filter( 'ovic_menu_locations_mobile', 'dukamarket_extend_mobile_menu', 10, 2 );
add_filter( 'ovic_override_footer_template', 'dukamarket_footer_template' );
add_filter( 'elementor/icons_manager/native', 'dukamarket_elementor_icons' );
add_action( 'import_sample_data_after_install_sample_data', 'dukamarket_after_install_sample_data' );
add_action( 'dukamarket_before_mobile_header', 'dukamarket_mobile_menu_top', 10 );
add_action( 'dukamarket_after_mobile_header', 'dukamarket_mobile_menu_bottom', 10 );
add_action( 'dynamic_sidebar_before', 'dukamarket_dynamic_sidebar_before', 10, 2 );
add_action( 'dynamic_sidebar_after', 'dukamarket_dynamic_sidebar_after', 10, 2 );
add_action( 'dgwt/wcas/search_query/args', 'dukamarket_search_query_args' );

/**
 *
 * ajax search query
 */
if ( !function_exists( 'dukamarket_search_query_args' ) ) {
    function dukamarket_search_query_args( $args )
    {
        if ( !empty( $_REQUEST['product_cat'] ) ) {

            $product_cat = sanitize_text_field( $_REQUEST['product_cat'] );

            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => array( $product_cat ),
            );
        }

        return $args;
    }
}
/**
 *
 * dynamic sidebar
 */
if ( !function_exists( 'dukamarket_dynamic_sidebar_before' ) ) {
    function dukamarket_dynamic_sidebar_before()
    {
        if ( !is_admin() ) {
            if ( dukamarket_is_mobile() ) :?>
                <div class="sidebar-head">
                    <span class="title"><?php echo esc_html__( 'Sidebar', 'dukamarket' ); ?></span>
                    <a href="#" class="close-sidebar"></a>
                </div>
            <?php endif;
            echo '<div class="sidebar-inner">';
        }
    }
}
if ( !function_exists( 'dukamarket_dynamic_sidebar_after' ) ) {
    function dukamarket_dynamic_sidebar_after()
    {
        if ( !is_admin() ) {
            echo '</div>';
        }
    }
}
/**
 *
 * TEMPLATE HEADER
 */
if ( !function_exists( 'dukamarket_header_template' ) ) {
    function dukamarket_header_template()
    {
        if ( dukamarket_is_mobile() ) {
            dukamarket_mobile_template();
        } else {
            $sticky_menu = dukamarket_get_option( 'sticky_menu', 'none' );
            get_template_part( 'templates-parts/header', 'banner' );
            get_template_part( 'templates/header/header', dukamarket_get_header() );
            if ( $sticky_menu == 'template' ) {
                get_template_part( 'templates-parts/header', 'sticky' );
            }
            if ( !class_exists( 'Ovic_Megamenu_Settings' ) ) {
                dukamarket_mobile_menu( 'primary' );
            }
        }
    }
}
if ( !function_exists( 'dukamarket_footer_template' ) ) {
    function dukamarket_footer_template()
    {
        return dukamarket_get_footer();
    }
}
if ( !function_exists( 'dukamarket_extend_mobile_menu' ) ) {
    function dukamarket_extend_mobile_menu( $menus, $locations )
    {

        $vertical_menu = apply_filters( 'dukamarket_extend_mobile_menu_vertical', dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'vertical_menu',
            'metabox_vertical_menu'
        ) );
        $primary_menu  = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            null,
            'metabox_primary_menu'
        );
        if ( !empty( $primary_menu ) ) {
            $term = get_term_by( 'slug', $primary_menu, 'nav_menu' );
            if ( !is_wp_error( $term ) && !empty( $term ) ) {
                $menus = array( $primary_menu );
            }
        }
        if ( empty( $menus ) && !empty( $locations['primary'] ) ) {
            $mobile_menu = wp_get_nav_menu_object( $locations['primary'] );
            $menus[]     = $mobile_menu->slug;
        }
        if ( !empty( $vertical_menu ) ) {
            $menus[] = $vertical_menu;
        }

        return $menus;
    }
}
/**
 *
 * PRIMARY MENU
 */
if ( !function_exists( 'dukamarket_primary_menu' ) ) {
    function dukamarket_primary_menu( $layout = 'horizontal' )
    {
        $enable_primary_menu = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'enable_primary_menu',
            'metabox_enable_primary_menu',
            1
        );
        if ( $enable_primary_menu != 1 )
            return false;
        $enable_metabox = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            null,
            "enable_metabox_options"
        );
        $primary_menu   = '';
        if ( $enable_metabox == 1 ) {
            $primary_menu = dukamarket_theme_option_meta(
                '_custom_metabox_theme_options',
                null,
                "metabox_primary_menu"
            );
        }
        if ( !empty( $primary_menu ) ) {
            $term = get_term_by( 'slug', $primary_menu, 'nav_menu' );
            if ( !is_wp_error( $term ) && !empty( $term ) ) {
                wp_nav_menu( array(
                        'menu'            => $primary_menu,
                        'theme_location'  => $primary_menu,
                        'depth'           => 3,
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'menu_class'      => 'dukamarket-nav main-menu ' . $layout . '-menu',
                        'megamenu_layout' => $layout,
                    )
                );
            }
        } else {
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                        'menu'            => 'primary',
                        'theme_location'  => 'primary',
                        'depth'           => 3,
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'menu_class'      => 'dukamarket-nav main-menu ' . $layout . '-menu',
                        'megamenu_layout' => $layout,
                    )
                );
            }
        }
    }
}
if ( !function_exists( 'dukamarket_header_menu_bar' ) ) {
    function dukamarket_header_menu_bar()
    {
        ?>
        <div class="mobile-block block-menu-bar">
            <a href="javascript:void(0)" class="menu-bar menu-toggle">
                <span class="icon ovic-icon-menu"><span class="inner"><span></span><span></span><span></span></span></span>
                <span class="text"><?php echo esc_html__( 'Menu', 'dukamarket' ); ?></span>
            </a>
        </div>
        <?php
    }
}
/**
 *
 * VERTICAL MENU
 */
if ( !function_exists( 'dukamarket_vertical_menu' ) ) {
    function dukamarket_vertical_menu( $layout = 'default' )
    {
        dukamarket_get_template(
            "templates-parts/header-vertical.php",
            array(
                'layout' => $layout,
            )
        );
    }
}
if ( !function_exists( 'dukamarket_vertical_menu_button' ) ) {
    function dukamarket_vertical_menu_button()
    {
        $vertical_menu = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'vertical_menu',
            'metabox_vertical_menu'
        );
        if ( !dukamarket_is_mobile() && !empty( $vertical_menu ) ): ?>
            <div class="button-vertical">
                <a href="#" class="vertical-open">
                    <span class="icon ovic-icon-menu"><span class="inner"><span></span><span></span><span></span></span></span>
                </a>
            </div>
        <?php endif;
    }
}
/**
 *
 * HEADER SUBMENU
 */
if ( !function_exists( 'dukamarket_header_submenu' ) ) {
    function dukamarket_header_submenu( $menu_location, $depth = 2 )
    {
        $header_menu = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            $menu_location,
            "metabox_{$menu_location}"
        );
        if ( !empty( $header_menu ) ) {
            do_action( "dukamarket_before_header_menu_{$header_menu}", $header_menu );
            wp_nav_menu( array(
                    'menu'           => $header_menu,
                    'theme_location' => $header_menu,
                    'link_before'    => '<span class="text">',
                    'link_after'     => '</span>',
                    'depth'          => $depth,
                    'menu_class'     => 'ovic-menu header-submenu ' . $menu_location,
                )
            );
            do_action( "dukamarket_after_header_menu_{$header_menu}", $header_menu );
        }
    }
}
/**
 *
 * HEADER BANNER
 */
if ( !function_exists( 'dukamarket_header_banner' ) ) {
    function dukamarket_header_banner()
    {
        get_template_part( 'templates-parts/header', 'banner' );
    }
}
/**
 *
 * HEADER SOCIAL
 */
if ( !function_exists( 'dukamarket_header_social' ) ) {
    function dukamarket_header_social()
    {
        $social_menu = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'social_menu',
            'metabox_social_menu'
        );
        if ( $social_menu == 1 ) {
            get_template_part( 'templates-parts/header', 'social' );
        }
    }
}
/**
 *
 * HEADER MESSAGE
 */
if ( !function_exists( 'dukamarket_header_message' ) ) {
    function dukamarket_header_message()
    {
        get_template_part( 'templates-parts/header', 'mess' );
    }
}
/**
 *
 * HEADER SEARCH
 */
if ( !function_exists( 'dukamarket_header_search' ) ) {
    function dukamarket_header_search( $category = false, $text = '' )
    {
        echo '<div class="block-search">';
        dukamarket_get_template(
            "templates-parts/header-search.php",
            array(
                'category' => $category,
                'text'     => $text,
            )
        );
        echo '</div>';
    }
}
/**
 *
 * HEADER SEARCH POPUP
 */
if ( !function_exists( 'dukamarket_header_search_popup' ) ) {
    function dukamarket_header_search_popup( $category = false, $text = '' )
    {
        ?>
        <div class="block-search dukamarket-dropdown">
            <a data-dukamarket="dukamarket-dropdown" class="woo-search-link" href="javascript:void(0)">
                <span class="icon main-icon-search-2"></span>
                <span class="text">
                    <span class="sub"><?php echo esc_html__( 'Looking for', 'dukamarket' );?></span>
                    <?php echo esc_html__( 'My Search', 'dukamarket' ); ?>
                </span>
            </a>
            <div class="sub-menu">
                <?php
                dukamarket_get_template(
                    "templates-parts/header-search.php",
                    array(
                        'category' => $category,
                        'text'     => $text,
                    )
                );
                ?>
            </div>
        </div>
        <?php
    }
}
/**
 *
 * HEADER ACCOUNT MENU
 */
if ( !function_exists( 'dukamarket_header_user' ) ) {
    function dukamarket_header_user( $text = '' )
    {
        dukamarket_get_template( "templates-parts/header-user.php",
            array(
                'text' => $text,
            )
        );
    }
}
/**
 *
 * CUSTOM MOBILE MENU
 */
if ( !function_exists( 'dukamarket_before_mobile_menu' ) ) {
    function dukamarket_before_mobile_menu( $menu_locations, $data_menus )
    {
        dukamarket_get_template(
            "templates-parts/mobile-header.php",
            array(
                'menu_locations' => $menu_locations,
                'data_menus'     => $data_menus,
            )
        );
    }

    add_action( 'ovic_before_html_mobile_menu', 'dukamarket_before_mobile_menu', 10, 2 );
}
if ( !function_exists( 'dukamarket_after_mobile_menu' ) ) {
    function dukamarket_after_mobile_menu( $menu_locations, $data_menus )
    {
        dukamarket_get_template(
            "templates-parts/mobile-footer.php",
            array(
                'menu_locations' => $menu_locations,
                'data_menus'     => $data_menus,
            )
        );
    }

    add_action( 'ovic_after_html_mobile_menu', 'dukamarket_after_mobile_menu', 10, 2 );
}
/**
 *
 * MEGAMENU ICON
 */
if ( !function_exists( 'dukamarket_theme_options_icons' ) ) {
    function dukamarket_theme_options_icons( $icon )
    {
        dukamarket_get_template( "templates-parts/icon-options.php" );

        return dukamarket_get_icon_options( $icon );
    }

    add_filter( 'ovic_field_icon_add_icons', 'dukamarket_theme_options_icons' );
}
/**
 *
 * MEGAMENU ICON
 */
if ( !function_exists( 'dukamarket_megamenu_options_icons' ) ) {
    function dukamarket_megamenu_options_icons()
    {
        dukamarket_get_template( "templates-parts/icon-megamenu.php" );

        return dukamarket_get_icon_megamenu();
    }

    add_filter( 'ovic_menu_icons_setting', 'dukamarket_megamenu_options_icons' );
}
if ( !function_exists( 'dukamarket_elementor_icons' ) ) {
    function dukamarket_elementor_icons( $tabs )
    {
        $tabs['main-icon'] = [
            'name'          => 'main-icon',
            'label'         => esc_html__( 'Theme Icons', 'dukamarket' ),
            'url'           => '',
            'enqueue'       => [],
            'prefix'        => '',
            'displayPrefix' => '',
            'labelIcon'     => 'fab fa-font-awesome-alt',
            'ver'           => '1.0.0',
            'fetchJson'     => get_theme_file_uri( '/assets/json/main-icons.json' ),
            'native'        => true,
        ];

        return $tabs;
    }
}
if ( !function_exists( 'dukamarket_after_install_sample_data' ) ) {
    function dukamarket_after_install_sample_data()
    {
        $cpt_support   = get_option( 'elementor_cpt_support', [ 'page', 'post' ] );
        $cpt_support[] = 'ovic_menu';
        $cpt_support[] = 'ovic_footer';

        update_option( 'elementor_cpt_support', $cpt_support );
        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
        update_option( 'elementor_load_fa4_shim', 'yes' );

        if ( class_exists( 'Elementor\Plugin' ) ) {
            $manager = new Elementor\Core\Files\Manager();
            $manager->clear_cache();
        }
    }
}
/**
 *
 * POPUP NEWSLETTER
 */
if ( !function_exists( 'dukamarket_popup_newsletter' ) ) {
    function dukamarket_popup_newsletter()
    {
        global $post;
        $enable = dukamarket_get_option( 'enable_popup' );
        if ( $enable != 1 ) {
            return;
        }
        if ( isset( $_COOKIE['dukamarket_disabled_popup_by_user'] ) && $_COOKIE['dukamarket_disabled_popup_by_user'] == 'true' ) {
            return;
        }
        $page = (array)dukamarket_get_option( 'popup_page' );
        if ( isset( $post->ID ) && is_array( $page ) && in_array( $post->ID, $page ) && $post->post_type == 'page' ) {
            wp_enqueue_style( 'magnific-popup' );
            wp_enqueue_script( 'magnific-popup' );
            get_template_part( 'templates-parts/popup', 'newsletter' );
        }
    }
}