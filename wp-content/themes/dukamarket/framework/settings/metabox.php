<?php if ( !defined( 'ABSPATH' ) ) {
    die;
} // Cannot access pages directly.
/*==========================================================================
METABOX BOX OPTIONS
===========================================================================*/
if ( !function_exists( 'dukamarket_metabox_options' ) && class_exists( 'OVIC_Metabox' ) ) {
    function dukamarket_metabox_options()
    {
        $sections = array();
        // -----------------------------------------
        // Page Side Meta box Options              -
        // -----------------------------------------
        $sections[] = array(
            'id'             => '_custom_page_side_options',
            'title'          => esc_html__( 'Custom Page Side Options', 'dukamarket' ),
            'post_type'      => 'page',
            'context'        => 'side',
            'priority'       => 'high',
            'page_templates' => 'default',
            'sections'       => array(
                array(
                    'name'   => 'page_option',
                    'fields' => array(
                        array(
                            'id'    => 'page_head_bg',
                            'type'  => 'image',
                            'title' => esc_html__( 'Page Head Background', 'dukamarket' ),
                            'desc'  => esc_html__( 'Default value in Theme Options', 'dukamarket' ),
                        ),
                        array(
                            'id'    => 'page_head_height',
                            'type'  => 'number',
                            'title' => esc_html__( 'Page Head Height', 'dukamarket' ),
                        ),
                        array(
                            'id'    => 'page_head_height_t',
                            'type'  => 'number',
                            'title' => esc_html__( 'Page Head Height on Tablet', 'dukamarket' ),
                            'desc'  => esc_html__( 'resolution < 1200px', 'dukamarket' ),
                        ),
                        array(
                            'id'    => 'page_head_height_m',
                            'type'  => 'number',
                            'title' => esc_html__( 'Page Head Height on Mobile', 'dukamarket' ),
                            'desc'  => esc_html__( 'resolution < 768px', 'dukamarket' ),
                        ),
                        array(
                            'id'         => 'sidebar_page_layout',
                            'type'       => 'image_select',
                            'title'      => esc_html__( 'Single Page Sidebar Position', 'dukamarket' ),
                            'desc'       => esc_html__( 'Select sidebar position on Page.', 'dukamarket' ),
                            'options'    => array(
                                'left'  => get_theme_file_uri( 'assets/images/left-sidebar.png' ),
                                'right' => get_theme_file_uri( 'assets/images/right-sidebar.png' ),
                                'full'  => get_theme_file_uri( 'assets/images/no-sidebar.png' ),
                            ),
                            'default'    => 'left',
                            'attributes' => array(
                                'data-depend-id' => 'sidebar_page_layout',
                            ),
                        ),
                        array(
                            'id'         => 'page_sidebar',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Page Sidebar', 'dukamarket' ),
                            'options'    => 'sidebars',
                            'dependency' => array( 'sidebar_page_layout', '!=', 'full' ),
                        ),
                        array(
                            'id'    => 'page_extra_class',
                            'type'  => 'text',
                            'title' => esc_html__( 'Extra Class', 'dukamarket' ),
                        ),
                    ),
                ),
            ),
        );
        // -----------------------------------------
        // Page Meta box Options                   -
        // -----------------------------------------
        $sections[] = array(
            'id'        => '_custom_metabox_theme_options',
            'title'     => esc_html__( 'Custom Theme Options', 'dukamarket' ),
            'post_type' => 'page',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => array(
                'options' => array(
                    'name'   => 'options',
                    'title'  => esc_html__( 'General', 'dukamarket' ),
                    'icon'   => 'fa fa-wordpress',
                    'fields' => array(
                        array(
                            'id'    => 'enable_metabox_options',
                            'type'  => 'switcher',
                            'title' => esc_html__( 'Enable Metabox Options', 'dukamarket' ),
                            'desc'  => esc_html__( 'If this option enable then this page will get setting in here, else this page will get setting in Theme Options', 'dukamarket' ),
                        ),
                        array(
                            'id'    => 'metabox_logo',
                            'type'  => 'image',
                            'title' => esc_html__( 'Logo', 'dukamarket' ),
                            'desc'  => esc_html__( 'Setting Logo For Site', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_default_color',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#222',
                            'title'   => esc_html__( 'Default Color', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_main_color',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#fcbe00',
                            'title'   => esc_html__( 'Main Color', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_main_color_b',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#e5ac00',
                            'title'   => esc_html__( 'Main Color - Button Hover', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_main_color_t',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#222',
                            'title'   => esc_html__( 'Main Color - Text Inside', 'dukamarket' ),
                            'desc'    => esc_html__( 'Text inside "Boxes has background main color" will has this color', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_main_color_2',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#0068c9',
                            'title'   => esc_html__( 'Main Color 2', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_main_color_3',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#cc1414',
                            'title'   => esc_html__( 'Main Color 3', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_main_color_4',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#5aab19',
                            'title'   => esc_html__( 'Main Color 4', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_main_color_5',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#263c97',
                            'title'   => esc_html__( 'Main Color 5', 'dukamarket' ),
                        ),
                        array(
                            'id'    => 'metabox_body_background',
                            'type'  => 'color',
                            'rgba'  => true,
                            'title' => esc_html__( 'Body Background', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_main_container',
                            'type'    => 'slider',
                            'title'   => esc_html__( 'Main Container', 'dukamarket' ),
                            'min'     => 1140,
                            'max'     => 1920,
                            'step'    => 10,
                            'unit'    => esc_html__( 'px', 'dukamarket' ),
                            'default' => 1410,
                        ),
                        array(
                            'id'      => 'metabox_main_fw',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Main Font Weight', 'dukamarket' ),
                            'options' => array(
                                400 => esc_html__( 'Regular', 'dukamarket' ),
                                500 => esc_html__( 'Medium', 'dukamarket' ),
                                600 => esc_html__( 'Semi-bold', 'dukamarket' ),
                                700 => esc_html__( 'Bold', 'dukamarket' ),
                            ),
                            'default' => 500,
                        ),
                        array(
                            'id'      => 'metabox_main_bora',
                            'type'    => 'number',
                            'title'   => esc_html__( 'Main Border Radius', 'dukamarket' ),
                            'min'     => 0,
                            'max'     => 100,
                            'unit'    => esc_html__( 'px', 'dukamarket' ),
                            'default' => 2,
                        ),
                        array(
                            'id'      => 'metabox_main_bora_2',
                            'type'    => 'number',
                            'title'   => esc_html__( 'Main Border Radius 2', 'dukamarket' ),
                            'desc'    => esc_html__( ' for Section ( add class: main-bora-2 ) or Shortcode ( option Border Radius )', 'dukamarket' ),
                            'min'     => 0,
                            'max'     => 100,
                            'unit'    => esc_html__( 'px', 'dukamarket' ),
                            'default' => 2,
                        ),
                        array(
                            'id'             => 'body_typography',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'Typography of Body', 'dukamarket' ),
                            'font_family'    => true,
                            'font_weight'    => true,
                            'font_style'     => true,
                            'subset'         => true,
                            'text_align'     => true,
                            'text_transform' => true,
                            'font_size'      => true,
                            'line_height'    => true,
                            'letter_spacing' => true,
                            'extra_styles'   => true,
                            'color'          => true,
                            'output'         => 'body',
                        ),
                    ),
                ),
                'header'  => array(
                    'name'   => 'header',
                    'title'  => esc_html__( 'Header', 'dukamarket' ),
                    'icon'   => 'fa fa-folder-open-o',
                    'fields' => array(
                        array(
                            'id'         => 'metabox_header_template',
                            'type'       => 'select_preview',
                            'options'    => dukamarket_file_options( '/templates/header/', 'header' ),
                            'default'    => 'style-01',
                            'attributes' => array(
                                'data-depend-id' => 'metabox_header_template',
                            ),
                        ),
                        array(
                            'id'          => 'metabox_header_banner',
                            'type'        => 'select',
                            'options'     => 'page',
                            'chosen'      => true,
                            'ajax'        => true,
                            'placeholder' => esc_html__( 'None', 'dukamarket' ),
                            'title'       => esc_html__( 'Header Banner', 'dukamarket' ),
                            'desc'        => esc_html__( 'Get banner on header from page builder', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_enable_primary_menu',
                            'type'    => 'switcher',
                            'title'   => esc_html__( 'Enable Primary Menu', 'dukamarket' ),
                            'default' => 1,
                        ),
                        array(
                            'id'          => 'metabox_primary_menu',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Primary Menu', 'dukamarket' ),
                            'desc'        => esc_html__( 'default is Display location on Menu panel: "Primary Menu"', 'dukamarket' ),
                            'options'     => 'menus',
                            'chosen'      => true,
                            'ajax'        => true,
                            'query_args'  => array(
                                'data-slug' => true,
                            ),
                            'placeholder' => esc_html__( 'None', 'dukamarket' ),
                            'dependency'  => array( 'metabox_enable_primary_menu', '==', 1 ),
                        ),
                        array(
                            'id'          => 'metabox_header_submenu',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Header Submenu', 'dukamarket' ),
                            'options'     => 'menus',
                            'chosen'      => true,
                            'ajax'        => true,
                            'query_args'  => array(
                                'data-slug' => true,
                            ),
                            'placeholder' => esc_html__( 'None', 'dukamarket' ),
                        ),
                        array(
                            'id'          => 'metabox_header_submenu_2',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Header Submenu 2', 'dukamarket' ),
                            'options'     => 'menus',
                            'chosen'      => true,
                            'ajax'        => true,
                            'query_args'  => array(
                                'data-slug' => true,
                            ),
                            'placeholder' => esc_html__( 'None', 'dukamarket' ),
                        ),
                        array(
                            'id'    => 'metabox_header_message',
                            'type'  => 'text',
                            'title' => esc_html__( 'Header Message', 'dukamarket' ),
                        ),
                        array(
                            'id'          => 'metabox_vertical_menu',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Vertical Menu', 'dukamarket' ),
                            'options'     => 'menus',
                            'chosen'      => true,
                            'ajax'        => true,
                            'query_args'  => array(
                                'data-slug' => true,
                            ),
                            'placeholder' => esc_html__( 'None', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_vertical_title',
                            'type'    => 'text',
                            'title'   => esc_html__( 'Vertical Title', 'dukamarket' ),
                            'default' => esc_html__( 'Shop by Department', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_vertical_items',
                            'type'    => 'number',
                            'unit'    => 'items',
                            'default' => 13,
                            'title'   => esc_html__( 'Vertical Items', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_vertical_show_more',
                            'type'    => 'text',
                            'title'   => esc_html__( 'Vertical Button Show More', 'dukamarket' ),
                            'default' => esc_html__( 'More Categories', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'metabox_vertical_show_less',
                            'type'    => 'text',
                            'title'   => esc_html__( 'Vertical Button Show Less', 'dukamarket' ),
                            'default' => esc_html__( 'Less Categories', 'dukamarket' ),
                        ),
                    ),
                ),
                'footer'  => array(
                    'name'   => 'footer',
                    'title'  => esc_html__( 'Footer', 'dukamarket' ),
                    'icon'   => 'fa fa-folder-open-o',
                    'fields' => array(
                        array(
                            'id'      => 'metabox_footer_template',
                            'type'    => 'select_preview',
                            'default' => 'footer-01',
                            'options' => dukamarket_footer_preview(),
                        ),
                    ),
                ),
            ),
        );
        // -----------------------------------------
        // Post Meta box Options                   -
        // -----------------------------------------
        $sections[] = array(
            'id'        => '_custom_metabox_post_options',
            'title'     => esc_html__( 'Post Meta', 'dukamarket' ),
            'post_type' => 'post',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => array(
                array(
                    'name'   => 'post_options',
                    'icon'   => 'fa fa-picture-o',
                    'fields' => array(
                        array(
                            'id'    => 'post_formats',
                            'type'  => 'tabbed',
                            'title' => esc_html__( 'Post formats', 'dukamarket' ),
                            'desc'  => esc_html__( 'The data post formats', 'dukamarket' ),
                            'tabs'  => array(
                                array(
                                    'title'  => esc_html__( 'Quote', 'dukamarket' ),
                                    'fields' => array(
                                        array(
                                            'id'         => 'quote',
                                            'type'       => 'text',
                                            'title'      => esc_html__( 'Quote Text', 'dukamarket' ),
                                            'attributes' => array(
                                                'style' => 'width:100%',
                                            ),
                                        ),
                                    ),
                                ),
                                array(
                                    'title'  => esc_html__( 'Gallery', 'dukamarket' ),
                                    'fields' => array(
                                        array(
                                            'id'    => 'gallery',
                                            'type'  => 'gallery',
                                            'title' => esc_html__( 'Gallery source', 'dukamarket' ),
                                        ),
                                    ),
                                ),
                                array(
                                    'title'  => esc_html__( 'Video', 'dukamarket' ),
                                    'fields' => array(
                                        array(
                                            'id'      => 'video',
                                            'type'    => 'upload',
                                            'library' => 'video',
                                            'title'   => esc_html__( 'Video source', 'dukamarket' ),
                                        ),
                                    ),
                                ),
                                array(
                                    'title'  => esc_html__( 'Audio', 'dukamarket' ),
                                    'fields' => array(
                                        array(
                                            'id'      => 'audio',
                                            'type'    => 'upload',
                                            'title'   => esc_html__( 'Audio source', 'dukamarket' ),
                                            'library' => 'audio',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),

            ),
        );
        // -----------------------------------------
        // Product Meta box Options                -
        // -----------------------------------------
        if ( class_exists( 'WooCommerce' ) ) {
            $sections[] = array(
                'id'        => '_custom_metabox_product_options',
                'title'     => esc_html__( 'Custom Product Options', 'dukamarket' ),
                'post_type' => 'product',
                'context'   => 'side',
                'priority'  => 'high',
                'sections'  => array(
                    array(
                        'name'   => 'product_option',
                        'fields' => array(
                            array(
                                'id'    => 'poster',
                                'type'  => 'image',
                                'title' => esc_html__( 'Poster Video', 'dukamarket' ),
                            ),
                            array(
                                'id'    => 'video',
                                'type'  => 'text',
                                'title' => esc_html__( 'Video Url', 'dukamarket' ),
                            ),
                            array(
                                'id'    => 'gallery',
                                'type'  => 'gallery',
                                'title' => esc_html__( '360 Degree', 'dukamarket' ),
                            ),
                        ),
                    ),
                ),
            );
        }

        OVIC_Metabox::instance( apply_filters( 'dukamarket_framework_metabox_options', $sections ) );
    }

    add_action( 'init', 'dukamarket_metabox_options' );
}