<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( !function_exists( 'dukamarket_enqueue_inline_css' ) ) {
    function dukamarket_enqueue_inline_css()
    {
        $css                       = html_entity_decode( dukamarket_get_option( 'ace_style', '' ) );
        $body_typography           = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'body_typography',
            'body_typography'
        );
        $default_color             = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'default_color',
            'metabox_default_color',
            '#222'
        );
        $main_color                = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_color',
            'metabox_main_color',
            '#fcbe00'
        );
        $main_color_b              = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_color_b',
            'metabox_main_color_b',
            '#e5ac00'
        );
        $main_color_t              = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_color_te',
            'metabox_main_color_t',
            '#222'
        );
        $main_color_2              = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_color_2',
            'metabox_main_color_2',
            '#0068c9'
        );
        $main_color_3              = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_color_3',
            'metabox_main_color_3',
            '#cc1414'
        );
        $main_color_4              = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_color_4',
            'metabox_main_color_4',
            '#5aab19'
        );
        $main_color_5              = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_color_5',
            'metabox_main_color_5',
            '#263c97'
        );
        $body_background           = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'body_background',
            'metabox_body_background'
        );
        $container                 = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_container',
            'metabox_main_container',
            1410
        );
        $main_fw                   = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_fw',
            'metabox_main_fw',
            500
        );
        $main_bora                 = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_bora',
            'metabox_main_bora',
            2
        );
        $main_bora_2               = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_bora_2',
            'metabox_main_bora_2',
            2
        );
        $vertical_items            = dukamarket_theme_option_meta(
            '_custom_metabox_theme_options',
            'vertical_items',
            'metabox_vertical_items'
        );
        $sidebar_width             = dukamarket_get_option( 'sidebar_width', 300 );
        $sidebar_space             = dukamarket_get_option( 'sidebar_space', 70 );
        $shop_sidebar_width        = dukamarket_get_option( 'shop_sidebar_width', 300 );
        $shop_sidebar_space        = dukamarket_get_option( 'shop_sidebar_space', 30 );
        $sidebar_width_tablet      = dukamarket_get_option( 'sidebar_width_tablet', 290 );
        $sidebar_space_tablet      = dukamarket_get_option( 'sidebar_space_tablet', 30 );
        $shop_sidebar_width_tablet = dukamarket_get_option( 'shop_sidebar_width_tablet', 290 );
        $shop_sidebar_space_tablet = dukamarket_get_option( 'shop_sidebar_space_tablet', 30 );

        $css .= 'body{';
        if ( !empty( $body_typography ) ) {
            if ( !empty( $body_typography['font-family'] ) )
                $css .= '--main-ff:' . $body_typography['font-family'] . ';';
            if ( !empty( $body_typography['font-size'] ) )
                $css .= '--main-fz:' . $body_typography['font-size'] . ';';
            if ( !empty( $body_typography['line-height'] ) )
                $css .= '--main-lh:' . $body_typography['line-height'] . ';';
            if ( !empty( $body_typography['color'] ) )
                $css .= '--main-cl:' . $body_typography['color'] . ';';
        }
        if ( $default_color != '#222' )
            $css .= '--default-color:' . $default_color . ';';
        if ( $main_color != '#fcbe00' )
            $css .= '--main-color:' . $main_color . ';';
        if ( $main_color_b != '#e5ac00' )
            $css .= '--main-color-b:' . $main_color_b . ';';
        if ( $main_color_t != '#222' )
            $css .= '--main-color-t:' . $main_color_t . ';';
        if ( $main_color_2 != '#0068c9' )
            $css .= '--main-color-2:' . $main_color_2 . ';';
        if ( $main_color_3 != '#cc1414' )
            $css .= '--main-color-3:' . $main_color_3 . ';';
        if ( $main_color_4 != '#5aab19' )
            $css .= '--main-color-4:' . $main_color_4 . ';';
        if ( $main_color_5 != '#263c97' )
            $css .= '--main-color-5:' . $main_color_5 . ';';
        if ( !empty( $body_background ) )
            $css .= 'background-color:' . $body_background . ';';
        if ( $sidebar_width != 300 )
            $css .= '--sidebar-width:' . $sidebar_width . 'px;';
        if ( $sidebar_space != 70 )
            $css .= '--sidebar-space:' . $sidebar_space . 'px;';
        if ( $shop_sidebar_width != 300 )
            $css .= '--shop-sidebar-width:' . $shop_sidebar_width . 'px;';
        if ( $shop_sidebar_space != 30 )
            $css .= '--shop-sidebar-space:' . $shop_sidebar_space . 'px;';
        if ( $main_fw != 500 )
            $css .= '--main-h-fw:' . $main_fw . ';';
        if ( $main_bora != 2 )
            $css .= '--main-bora:' . $main_bora . 'px;';
        if ( $main_bora_2 != 2 )
            $css .= '--main-bora-2:' . $main_bora_2 . 'px;';
        $css .= '}';
        $css .= '@media (max-width:1199px) and (min-width:992px){body{';
        if ( $sidebar_width_tablet != 290 )
            $css .= '--sidebar-width:' . $sidebar_width_tablet . 'px;';
        if ( $sidebar_space_tablet != 30 )
            $css .= '--sidebar-space:' . $sidebar_space_tablet . 'px;';
        if ( $shop_sidebar_width_tablet != 290 )
            $css .= '--shop-sidebar-width:' . $shop_sidebar_width_tablet . 'px;';
        if ( $shop_sidebar_space_tablet != 30 )
            $css .= '--shop-sidebar-space:' . $shop_sidebar_space_tablet . 'px;';
        $css .= '}}';
        if ( !empty( $container ) && $container != 1140 ) {
            $container_padding = $container + 30;
            $media             = $container_padding < 1200 ? 1200 : ( $container_padding + 30 );
            $css               .= '
            @media (min-width: ' . $media . 'px){
                body{
                    --main-container:' . $container . 'px;
                }
                body.wcfm-store-page .site #main{
                    width:' . $container_padding . 'px !important;
                }
            }
            ';
        }
        if ( !empty( $vertical_items ) ) {
            $css .= '
            .vertical-menu > .menu-item:nth-child(n+' . ( $vertical_items + 1 ) . '){
                display: none;
            }
            ';
        }

        $css = preg_replace( '/\s+/', ' ', $css );

        wp_add_inline_style( 'dukamarket-main',
            apply_filters( 'dukamarket_custom_inline_css', $css, $main_color, $container )
        );
    }

    add_action( 'wp_enqueue_scripts', 'dukamarket_enqueue_inline_css', 30 );
}