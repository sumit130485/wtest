<?php if ( !defined( 'ABSPATH' ) ) {
    die;
} // Cannot access pages directly.
/*==========================================================================
THEME BOX OPTIONS
===========================================================================*/
if ( !function_exists( 'dukamarket_theme_options' ) && class_exists( 'OVIC_Options' ) ) {
    function dukamarket_theme_options()
    {
        $options = array();
        // -----------------------------------------
        // Theme Options              -
        // -----------------------------------------
        $options['general_main'] = array(
            'name'     => 'general_main',
            'icon'     => 'fa fa-wordpress',
            'title'    => esc_html__( 'General', 'dukamarket' ),
            'sections' => array(
                array(
                    'title'  => esc_html__( 'General', 'dukamarket' ),
                    'fields' => array(
                        array(
                            'id'    => 'logo',
                            'type'  => 'image',
                            'title' => esc_html__( 'Logo', 'dukamarket' ),
                            'desc'  => esc_html__( 'Setting Logo For Site', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'default_color',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#222',
                            'title'   => esc_html__( 'Default Color', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'main_color',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#fcbe00',
                            'title'   => esc_html__( 'Main Color', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'main_color_b',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#e5ac00',
                            'title'   => esc_html__( 'Main Color - Button Hover', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'main_color_t',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#222',
                            'title'   => esc_html__( 'Main Color - Text Inside', 'dukamarket' ),
                            'desc'    => esc_html__( 'Text inside "Boxes has background main color" will has this color', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'main_color_2',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#0068c9',
                            'title'   => esc_html__( 'Main Color 2', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'main_color_3',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#cc1414',
                            'title'   => esc_html__( 'Main Color 3', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'main_color_4',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#5aab19',
                            'title'   => esc_html__( 'Main Color 4', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'main_color_5',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#263c97',
                            'title'   => esc_html__( 'Main Color 5', 'dukamarket' ),
                        ),
                        array(
                            'id'    => 'body_background',
                            'type'  => 'color',
                            'rgba'  => true,
                            'title' => esc_html__( 'Body Background', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'main_container',
                            'type'    => 'slider',
                            'title'   => esc_html__( 'Main Container', 'dukamarket' ),
                            'min'     => 1140,
                            'max'     => 1920,
                            'step'    => 10,
                            'unit'    => esc_html__( 'px', 'dukamarket' ),
                            'default' => 1410,
                        ),
                        array(
                            'id'      => 'main_fw',
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
                            'id'      => 'main_bora',
                            'type'    => 'number',
                            'title'   => esc_html__( 'Main Border Radius', 'dukamarket' ),
                            'min'     => 0,
                            'max'     => 100,
                            'unit'    => esc_html__( 'px', 'dukamarket' ),
                            'default' => 2,
                        ),
                        array(
                            'id'      => 'main_bora_2',
                            'type'    => 'number',
                            'title'   => esc_html__( 'Main Border Radius 2', 'dukamarket' ),
                            'desc'    => esc_html__( ' for Section ( add class: main-bora-2 ) or Shortcode ( option Border Radius )', 'dukamarket' ),
                            'min'     => 0,
                            'max'     => 100,
                            'unit'    => esc_html__( 'px', 'dukamarket' ),
                            'default' => 2,
                        ),
                    ),
                ),
                array(
                    'title'  => esc_html__( 'Enable/Disable', 'dukamarket' ),
                    'fields' => array(
                        array(
                            'id'    => 'disable_equal',
                            'type'  => 'switcher',
                            'title' => esc_html__( 'Disable Equal Height', 'dukamarket' ),
                        ),
                        array(
                            'id'    => 'enable_cache_option',
                            'type'  => 'switcher',
                            'title' => esc_html__( 'Enable Cache Options', 'dukamarket' ),
                        ),
                        array(
                            'id'    => 'enable_ajax_comment',
                            'type'  => 'switcher',
                            'title' => esc_html__( 'Enable Nav Ajax Comment', 'dukamarket' ),
                        ),
                        array(
                            'id'    => 'enable_backtotop',
                            'type'  => 'switcher',
                            'title' => esc_html__( 'Enable Back To Top Button', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'enable_ovic_rtl',
                            'type'    => 'switcher',
                            'title'   => esc_html__( 'Enable Ovic RTL', 'dukamarket' ),
                            'desc'    =>
                                '<ul>
                                    <li>' . esc_html__( 'If RTL Language:', 'dukamarket' ) . '</li>
                                    <li>' . esc_html__( '- Sections has class "rtl-bg" will be has rtl background', 'dukamarket' ) . '</li>
                                    <li>' . esc_html__( '- Align has direction left/right will be start/end', 'dukamarket' ) . '</li>
                                </ul>',
                            'default' => 1,
                        ),
                    ),
                ),
                array(
                    'title'  => esc_html__( 'Sidebar Settings', 'dukamarket' ),
                    'fields' => array(
                        array(
                            'id'      => 'sidebar_width',
                            'type'    => 'slider',
                            'title'   => esc_html__( 'Sidebar Width', 'dukamarket' ),
                            'min'     => 200,
                            'max'     => 500,
                            'step'    => 1,
                            'unit'    => esc_html__( 'px', 'dukamarket' ),
                            'default' => 300,
                        ),
                        array(
                            'id'      => 'sidebar_space',
                            'type'    => 'spinner',
                            'title'   => esc_html__( 'Sidebar Space', 'dukamarket' ),
                            'min'     => 0,
                            'max'     => 200,
                            'step'    => 1,
                            'unit'    => 'px',
                            'default' => 70,
                        ),
                        array(
                            'id'      => 'sidebar_width_tablet',
                            'type'    => 'slider',
                            'title'   => esc_html__( 'Sidebar Width Tablet', 'dukamarket' ),
                            'desc'    => esc_html__( 'resolution < 1200px', 'dukamarket' ),
                            'min'     => 200,
                            'max'     => 500,
                            'step'    => 1,
                            'unit'    => esc_html__( 'px', 'dukamarket' ),
                            'default' => 290,
                        ),
                        array(
                            'id'      => 'sidebar_space_tablet',
                            'type'    => 'spinner',
                            'title'   => esc_html__( 'Sidebar Space Tablet', 'dukamarket' ),
                            'desc'    => esc_html__( 'resolution < 1200px', 'dukamarket' ),
                            'min'     => 0,
                            'max'     => 200,
                            'step'    => 1,
                            'unit'    => 'px',
                            'default' => 30,
                        ),
                        array(
                            'id'    => 'sticky_sidebar',
                            'type'  => 'switcher',
                            'title' => esc_html__( 'Sticky Sidebar', 'dukamarket' ),
                        ),
                        array(
                            'id'           => 'multi_sidebar',
                            'type'         => 'repeater',
                            'button_title' => esc_html__( 'Add Sidebar', 'dukamarket' ),
                            'title'        => esc_html__( 'Multi Sidebar', 'dukamarket' ),
                            'fields'       => array(
                                array(
                                    'id'    => 'add_sidebar',
                                    'type'  => 'text',
                                    'title' => esc_html__( 'Name Sidebar', 'dukamarket' ),
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'title'  => esc_html__( 'Popup Newsletter', 'dukamarket' ),
                    'fields' => array(
                        array(
                            'id'    => 'enable_popup',
                            'type'  => 'switcher',
                            'title' => esc_html__( 'Enable Popup', 'dukamarket' ),
                        ),
                        array(
                            'id'         => 'popup_page',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Popup Page', 'dukamarket' ),
                            'options'    => 'page',
                            'multiple'   => true,
                            'chosen'     => true,
                            'query_args' => array(
                                'posts_per_page' => -1,
                            ),
                            'desc'       => esc_html__( 'The page popup will be show.', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'popup_effect',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Popup Effect', 'dukamarket' ),
                            'options' => array(
                                'mfp-zoom-in'         => esc_html__( 'Zoom In', 'dukamarket' ),
                                'mfp-newspaper'       => esc_html__( 'Newspaper', 'dukamarket' ),
                                'mfp-move-horizontal' => esc_html__( 'Horizontal Move', 'dukamarket' ),
                                'mfp-move-from-top'   => esc_html__( 'Move From Top', 'dukamarket' ),
                                'mfp-3d-unfold'       => esc_html__( '3D Unfold', 'dukamarket' ),
                                'mfp-zoom-out'        => esc_html__( 'Zoom Out', 'dukamarket' ),
                            ),
                            'default' => 'mfp-zoom-in',
                        ),
                        array(
                            'id'    => 'popup_bg',
                            'type'  => 'image',
                            'title' => esc_html__( 'Background', 'dukamarket' ),
                        ),
                        array(
                            'id'    => 'popup_img',
                            'type'  => 'image',
                            'title' => esc_html__( 'Image', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'popup_text_1',
                            'type'    => 'text',
                            'title'   => esc_html__( 'Text 1', 'dukamarket' ),
                            'default' => esc_html__( 'SIGN UP FOR OUR NEWSLETTER & PROMOTIONS !', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'popup_text_2',
                            'type'    => 'text',
                            'title'   => esc_html__( 'Text 2', 'dukamarket' ),
                            'default' => esc_html__( 'SALE 20% OFF', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'popup_text_3',
                            'type'    => 'text',
                            'title'   => esc_html__( 'Text 3', 'dukamarket' ),
                            'default' => esc_html__( 'ON YOUR NEXT PURCHASE', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'input_placeholder',
                            'type'    => 'text',
                            'title'   => esc_html__( 'Input Placeholder', 'dukamarket' ),
                            'default' => esc_html__( 'Enter your email address here...', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'popup_button',
                            'type'    => 'text',
                            'title'   => esc_html__( 'Button', 'dukamarket' ),
                            'default' => esc_html__( 'Subscribe & Get our promotion now !', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'popup_text_4',
                            'type'    => 'text',
                            'title'   => esc_html__( 'Text 4', 'dukamarket' ),
                            'default' => esc_html__( 'No Thank ! I am not interested in this promotion ', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'popup_delay',
                            'type'    => 'spinner',
                            'title'   => esc_html__( 'Delay', 'dukamarket' ),
                            'step'    => 1,
                            'min'     => 0,
                            'max'     => 9999,
                            'unit'    => 'milliseconds',
                            'default' => 1000,
                        ),
                    ),
                ),
                array(
                    'title'  => esc_html__( 'Page Head', 'dukamarket' ),
                    'fields' => array(
                        array(
                            'id'    => 'page_head_bg',
                            'type'  => 'image',
                            'title' => esc_html__( 'Background', 'dukamarket' ),
                        ),
                    ),
                ),
                array(
                    'title'  => esc_html__( '404 Error', 'dukamarket' ),
                    'fields' => array(
                        array(
                            'id'    => '404_image',
                            'type'  => 'image',
                            'title' => esc_html__( '404 Image', 'dukamarket' ),
                        ),
                    ),
                ),
                array(
                    'title'  => esc_html__( 'ACE Settings', 'dukamarket' ),
                    'fields' => array(
                        array(
                            'id'       => 'ace_style',
                            'type'     => 'code_editor',
                            'settings' => array(
                                'theme' => 'dracula',
                                'mode'  => 'css',
                            ),
                            'title'    => esc_html__( 'Editor Style', 'dukamarket' ),
                        ),
                        array(
                            'id'       => 'ace_script',
                            'type'     => 'code_editor',
                            'settings' => array(
                                'theme' => 'dracula',
                                'mode'  => 'javascript',
                            ),
                            'title'    => esc_html__( 'Editor Javascript', 'dukamarket' ),
                        ),
                    ),
                ),
            ),
        );
        $options['header_main']  = array(
            'name'     => 'header_main',
            'icon'     => 'fa fa-folder-open-o',
            'title'    => esc_html__( 'Header', 'dukamarket' ),
            'sections' => array(
                array(
                    'title'  => esc_html__( 'Header Main', 'dukamarket' ),
                    'fields' => array(
                        array(
                            'id'      => 'sticky_menu',
                            'type'    => 'button_set',
                            'title'   => esc_html__( 'Header Sticky', 'dukamarket' ),
                            'options' => array(
                                'none'     => esc_html__( 'None', 'dukamarket' ),
                                'template' => esc_html__( 'Template', 'dukamarket' ),
                                'jquery'   => esc_html__( 'jQuery', 'dukamarket' ),
                            ),
                            'default' => 'none',
                        ),
                        array(
                            'id'         => 'header_template',
                            'type'       => 'select_preview',
                            'title'      => esc_html__( 'Header Layout', 'dukamarket' ),
                            'options'    => dukamarket_file_options( '/templates/header/', 'header' ),
                            'default'    => 'style-01',
                            'attributes' => array(
                                'data-depend-id' => 'header_template',
                            ),
                        ),
                        array(
                            'id'          => 'header_banner',
                            'type'        => 'select',
                            'options'     => 'page',
                            'chosen'      => true,
                            'ajax'        => true,
                            'placeholder' => esc_html__( 'None', 'dukamarket' ),
                            'title'       => esc_html__( 'Header Banner', 'dukamarket' ),
                            'desc'        => esc_html__( 'Get banner on header from page builder', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'enable_primary_menu',
                            'type'    => 'switcher',
                            'title'   => esc_html__( 'Enable Primary Menu', 'dukamarket' ),
                            'default' => 1,
                        ),
                        array(
                            'id'          => 'header_submenu',
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
                            'id'          => 'header_submenu_2',
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
                            'id'    => 'header_message',
                            'type'  => 'text',
                            'title' => esc_html__( 'Header Message', 'dukamarket' ),
                        ),
                    ),
                ),
                array(
                    'title'  => esc_html__( 'Vertical Menu', 'dukamarket' ),
                    'fields' => array(
                        array(
                            'id'       => 'vertical_always_open',
                            'type'     => 'select',
                            'options'  => 'page',
                            'multiple' => true,
                            'chosen'   => true,
                            'ajax'     => true,
                            'title'    => esc_html__( 'Vertical Menu Always Open', 'dukamarket' ),
                        ),
                        array(
                            'id'          => 'vertical_menu',
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
                            'id'      => 'vertical_title',
                            'type'    => 'text',
                            'title'   => esc_html__( 'Vertical Title', 'dukamarket' ),
                            'default' => esc_html__( 'Shop by Department', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'vertical_items',
                            'type'    => 'number',
                            'unit'    => 'items',
                            'default' => 13,
                            'title'   => esc_html__( 'Vertical Items', 'dukamarket' ),
                        ),
                        array(
                            'title'   => esc_html__( 'Vertical Button Show More', 'dukamarket' ),
                            'id'      => 'vertical_show_more',
                            'type'    => 'text',
                            'default' => esc_html__( 'More Categories', 'dukamarket' ),
                        ),
                        array(
                            'title'   => esc_html__( 'Vertical Button Show Less', 'dukamarket' ),
                            'id'      => 'vertical_show_less',
                            'type'    => 'text',
                            'default' => esc_html__( 'Less Categories', 'dukamarket' ),
                        ),
                    ),
                ),
            ),
        );
        $options['footer_main']  = array(
            'name'   => 'footer_main',
            'icon'   => 'fa fa-folder-open-o',
            'title'  => esc_html__( 'Footer', 'dukamarket' ),
            'fields' => array(
                array(
                    'id'      => 'footer_template',
                    'type'    => 'select_preview',
                    'default' => 'footer-01',
                    'title'   => esc_html__( 'Footer Layout', 'dukamarket' ),
                    'options' => dukamarket_footer_preview(),
                ),
            ),
        );
        $options['mobile_main']  = array(
            'name'     => 'mobile_main',
            'icon'     => 'fa fa-wordpress',
            'title'    => esc_html__( 'Mobile', 'dukamarket' ),
            'sections' => array(
                array(
                    'title'  => esc_html__( 'Mobile Layout', 'dukamarket' ),
                    'fields' => array(
                        array(
                            'id'      => 'mobile_enable',
                            'type'    => 'switcher',
                            'title'   => esc_html__( 'Mobile version', 'dukamarket' ),
                            'default' => 1,
                        ),
                        array(
                            'id'    => 'logo_mobile',
                            'type'  => 'image',
                            'title' => esc_html__( 'Logo Mobile', 'dukamarket' ),
                            'desc'  => esc_html__( 'Setting Logo For Site', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'mobile_layout',
                            'type'    => 'image_select',
                            'default' => 'style-01',
                            'title'   => esc_html__( 'Mobile Layout', 'dukamarket' ),
                            'options' => array(
                                'style-01' => get_theme_file_uri( 'templates/mobile/mobile-style-01.png' ),
                                'style-02' => get_theme_file_uri( 'templates/mobile/mobile-style-02.png' ),
                                'style-03' => get_theme_file_uri( 'templates/mobile/mobile-style-03.png' ),
                            ),
                        ),
                        array(
                            'id'      => 'mobile_banner',
                            'type'    => 'switcher',
                            'title'   => esc_html__( 'Mobile Top Banner', 'dukamarket' ),
                            'default' => 1,
                        ),
                        array(
                            'id'      => 'background_mobile',
                            'type'    => 'background',
                            'title'   => esc_html__( 'Background Mobile', 'dukamarket' ),
                            'desc'    => esc_html__( 'Setting Background For Mobile Menu', 'dukamarket' ),
                            'default' => array(
                                'background-position'   => 'center center',
                                'background-repeat'     => 'no-repeat',
                                'background-attachment' => 'scroll',
                                'background-size'       => 'cover',
                            ),
                            'output'  => '.ovic-menu-clone-wrap .head-menu-mobile'
                        ),
                    )
                ),
                array(
                    'title'  => esc_html__( 'Mobile Content', 'dukamarket' ),
                    'fields' => array(
                        array(
                            'id'          => 'mobile_menu_top',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Mobile Menu Top', 'dukamarket' ),
                            'options'     => 'menus',
                            'chosen'      => true,
                            'ajax'        => true,
                            'query_args'  => array(
                                'data-slug' => true,
                            ),
                            'placeholder' => esc_html__( 'None', 'dukamarket' ),
                        ),
                        array(
                            'id'          => 'mobile_menu_bottom',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Mobile Menu Bottom', 'dukamarket' ),
                            'options'     => 'menus',
                            'chosen'      => true,
                            'ajax'        => true,
                            'query_args'  => array(
                                'data-slug' => true,
                            ),
                            'placeholder' => esc_html__( 'None', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'mobile_footer',
                            'type'    => 'select_preview',
                            'default' => 'inherit',
                            'title'   => esc_html__( 'Footer Mobile', 'dukamarket' ),
                            'options' => dukamarket_footer_preview( true ),
                        ),
                    )
                ),
            )
        );
        $options['posts_main']   = array(
            'name'     => 'posts_main',
            'icon'     => 'fa fa-rss',
            'title'    => esc_html__( 'Posts Settings', 'dukamarket' ),
            'sections' => array(
                array(
                    'title'  => esc_html__( 'Blog Page', 'dukamarket' ),
                    'fields' => array(
                        array(
                            'id'      => 'blog_page_title',
                            'type'    => 'switcher',
                            'title'   => esc_html__( 'Page Title', 'dukamarket' ),
                            'default' => 1,
                        ),
                        array(
                            'id'      => 'blog_list_style',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Blog Style', 'dukamarket' ),
                            'options' => array(
                                'standard' => esc_html__( 'Standard', 'dukamarket' ),
                                'grid'     => esc_html__( 'Grid', 'dukamarket' ),
                            ),
                            'default' => 'standard',
                        ),
                        array(
                            'id'      => 'sidebar_blog_layout',
                            'type'    => 'image_select',
                            'title'   => esc_html__( 'Sidebar Blog Layout', 'dukamarket' ),
                            'desc'    => esc_html__( 'Select sidebar position on Blog.', 'dukamarket' ),
                            'options' => array(
                                'left'  => get_theme_file_uri( 'assets/images/left-sidebar.png' ),
                                'right' => get_theme_file_uri( 'assets/images/right-sidebar.png' ),
                                'full'  => get_theme_file_uri( 'assets/images/no-sidebar.png' ),
                            ),
                            'default' => 'left',
                        ),
                        array(
                            'id'         => 'blog_used_sidebar',
                            'type'       => 'select',
                            'default'    => 'widget-area',
                            'title'      => esc_html__( 'Blog Sidebar', 'dukamarket' ),
                            'options'    => 'sidebars',
                            'dependency' => array( 'sidebar_blog_layout', '!=', 'full' ),
                        ),
                        array(
                            'id'      => 'blog_pagination',
                            'type'    => 'button_set',
                            'title'   => esc_html__( 'Blog Pagination', 'dukamarket' ),
                            'options' => array(
                                'pagination' => esc_html__( 'Pagination', 'dukamarket' ),
                                'load_more'  => esc_html__( 'Load More', 'dukamarket' ),
                                'infinite'   => esc_html__( 'Infinite Scrolling', 'dukamarket' ),
                            ),
                            'default' => 'pagination',
                            'desc'    => esc_html__( 'Select style pagination on blog page.', 'dukamarket' ),
                        ),
                    ),
                ),
                array(
                    'title'  => esc_html__( 'Post Single', 'dukamarket' ),
                    'fields' => array(
                        array(
                            'id'      => 'single_layout',
                            'type'    => 'select',
                            'default' => 'standard',
                            'title'   => esc_html__( 'Single Post Layout', 'dukamarket' ),
                            'options' => array(
                                'standard' => esc_html__( 'Standard', 'dukamarket' ),
                                'modern'   => esc_html__( 'Modern', 'dukamarket' ),
                            ),
                        ),
                        array(
                            'id'         => 'head_height_post',
                            'type'       => 'spinner',
                            'title'      => esc_html__( 'Thumb Height', 'dukamarket' ),
                            'min'        => 200,
                            'max'        => 1000,
                            'step'       => 1,
                            'unit'       => 'px',
                            'dependency' => array( 'single_layout', '==', 'modern' ),
                        ),
                        array(
                            'id'      => 'sidebar_single_layout',
                            'type'    => 'image_select',
                            'title'   => esc_html__( ' Sidebar Single Post Layout', 'dukamarket' ),
                            'desc'    => esc_html__( 'Select sidebar position on Blog.', 'dukamarket' ),
                            'options' => array(
                                'left'  => get_theme_file_uri( 'assets/images/left-sidebar.png' ),
                                'right' => get_theme_file_uri( 'assets/images/right-sidebar.png' ),
                                'full'  => get_theme_file_uri( 'assets/images/no-sidebar.png' ),
                            ),
                            'default' => 'right',
                        ),
                        array(
                            'id'         => 'single_used_sidebar',
                            'type'       => 'select',
                            'default'    => 'widget-area',
                            'title'      => esc_html__( 'Blog Single Sidebar', 'dukamarket' ),
                            'options'    => 'sidebars',
                            'dependency' => array( 'sidebar_single_layout', '!=', 'full' ),
                        ),
                        array(
                            'id'    => 'enable_share_post',
                            'type'  => 'switcher',
                            'title' => esc_html__( 'Enable Share', 'dukamarket' ),
                        ),
                        array(
                            'id'    => 'enable_pagination_post',
                            'type'  => 'switcher',
                            'title' => esc_html__( 'Enable Prev/Next Post', 'dukamarket' ),
                        ),
                        array(
                            'id'    => 'enable_author_info',
                            'type'  => 'switcher',
                            'title' => esc_html__( 'Enable Author Info', 'dukamarket' ),
                        ),
                    ),
                ),
            ),
        );
        if ( class_exists( 'WooCommerce' ) ) {
            $options['woocommerce_mains'] = array(
                'name'     => 'woocommerce_mains',
                'icon'     => 'fa fa-shopping-bag',
                'title'    => esc_html__( 'WooCommerce', 'dukamarket' ),
                'sections' => array(
                    array(
                        'title'  => esc_html__( 'Shop Page', 'dukamarket' ),
                        'fields' => array(
                            array(
                                'id'      => 'shop_page_title',
                                'type'    => 'switcher',
                                'title'   => esc_html__( 'Page Title', 'dukamarket' ),
                                'default' => 1,
                            ),
                            array(
                                'id'          => 'shop_builder_top',
                                'type'        => 'select',
                                'options'     => 'page',
                                'query_args'  => array(
                                    'posts_per_page' => -1,
                                ),
                                'chosen'      => true,
                                'ajax'        => true,
                                'placeholder' => esc_html__( 'Select Page', 'dukamarket' ),
                                'title'       => esc_html__( 'Shop Builder Top', 'dukamarket' ),
                                'desc'        => esc_html__( 'Get shop banner from page builder.', 'dukamarket' ),
                            ),
                            array(
                                'id'      => 'shop_builder_position',
                                'type'    => 'select',
                                'title'   => esc_html__( 'Shop Builder Position', 'dukamarket' ),
                                'options' => array(
                                    'outside' => esc_html__( 'Outside', 'dukamarket' ),
                                    'inside'  => esc_html__( 'Inside', 'dukamarket' ),
                                ),
                                'default' => 'inside',
                            ),
                            array(
                                'id'          => 'shop_builder_bot',
                                'type'        => 'select',
                                'options'     => 'page',
                                'query_args'  => array(
                                    'posts_per_page' => -1,
                                ),
                                'chosen'      => true,
                                'ajax'        => true,
                                'placeholder' => esc_html__( 'Select Page', 'dukamarket' ),
                                'title'       => esc_html__( 'Shop Builder Bottom', 'dukamarket' ),
                                'desc'        => esc_html__( 'Get shop banner from page builder.', 'dukamarket' ),
                            ),
                            array(
                                'id'      => 'shop_page_layout',
                                'type'    => 'image_select',
                                'default' => 'grid',
                                'title'   => esc_html__( 'Shop Layout', 'dukamarket' ),
                                'desc'    => esc_html__( 'Select layout for shop product, product category archive.',
                                    'dukamarket' ),
                                'options' => array(
                                    'grid' => get_theme_file_uri( 'assets/images/grid-display.png' ),
                                    'list' => get_theme_file_uri( 'assets/images/list-display.png' ),
                                ),
                            ),
                            array(
                                'id'      => 'product_loop_columns',
                                'type'    => 'spinner',
                                'title'   => esc_html__( 'Products Columns', 'dukamarket' ),
                                'desc'    => esc_html__( 'for Grid', 'dukamarket' ),
                                'max'     => 6,
                                'min'     => 2,
                                'step'    => 1,
                                'unit'    => 'columns',
                                'default' => 4,
                            ),
                            array(
                                'id'      => 'product_per_page',
                                'type'    => 'spinner',
                                'default' => '10',
                                'unit'    => 'items',
                                'title'   => esc_html__( 'Products Per Page', 'dukamarket' ),
                            ),
                            array(
                                'id'      => 'product_newness',
                                'default' => 100,
                                'type'    => 'spinner',
                                'unit'    => 'days',
                                'title'   => esc_html__( 'Products Newness', 'dukamarket' ),
                            ),
                            array(
                                'id'      => 'product_hover',
                                'type'    => 'button_set',
                                'title'   => esc_html__( 'Product Image Hover', 'dukamarket' ),
                                'options' => array(
                                    ''       => esc_html__( 'None', 'dukamarket' ),
                                    'zoom'   => esc_html__( 'Zoom Image', 'dukamarket' ),
                                    'change' => esc_html__( 'Change Image', 'dukamarket' ),
                                    'slide'  => esc_html__( 'Slide Image', 'dukamarket' ),
                                ),
                                'default' => '',
                            ),
                            array(
                                'id'      => 'woocommerce_pagination',
                                'type'    => 'button_set',
                                'title'   => esc_html__( 'Shop Pagination', 'dukamarket' ),
                                'options' => array(
                                    'pagination' => esc_html__( 'Pagination', 'dukamarket' ),
                                    'load_more'  => esc_html__( 'Load More', 'dukamarket' ),
                                    'infinite'   => esc_html__( 'Infinite Scrolling', 'dukamarket' ),
                                ),
                                'default' => 'pagination',
                                'desc'    => esc_html__( 'Select style pagination on shop page.', 'dukamarket' ),
                            ),
                        ),
                    ),
                    array(
                        'title'  => esc_html__( 'Shop Page Sidebar', 'dukamarket' ),
                        'fields' => array(
                            array(
                                'id'      => 'sidebar_shop_layout',
                                'type'    => 'image_select',
                                'title'   => esc_html__( 'Shop Page Sidebar Layout', 'dukamarket' ),
                                'desc'    => esc_html__( 'Select sidebar position on Shop Page.', 'dukamarket' ),
                                'options' => array(
                                    'left'  => get_theme_file_uri( 'assets/images/left-sidebar.png' ),
                                    'right' => get_theme_file_uri( 'assets/images/right-sidebar.png' ),
                                    'full'  => get_theme_file_uri( 'assets/images/no-sidebar.png' ),
                                ),
                                'default' => 'left',
                            ),
                            array(
                                'id'         => 'shop_used_sidebar',
                                'type'       => 'select',
                                'default'    => 'shop-widget-area',
                                'title'      => esc_html__( 'Sidebar Used For Shop', 'dukamarket' ),
                                'options'    => 'sidebars',
                                'dependency' => array( 'sidebar_shop_layout', '!=', 'full' ),
                            ),
                            array(
                                'id'         => 'shop_vendor_used_sidebar',
                                'type'       => 'select',
                                'default'    => 'shop-widget-area',
                                'title'      => esc_html__( 'Sidebar Used For Vendor', 'dukamarket' ),
                                'options'    => 'sidebars',
                                'dependency' => array( 'sidebar_shop_layout', '!=', 'full' ),
                            ),
                            array(
                                'id'      => 'shop_sidebar_width',
                                'type'    => 'slider',
                                'title'   => esc_html__( 'Sidebar Width', 'dukamarket' ),
                                'desc'    => esc_html__( 'Default is General / Sidebar settings', 'dukamarket' ),
                                'min'     => 200,
                                'max'     => 500,
                                'step'    => 1,
                                'unit'    => esc_html__( 'px', 'dukamarket' ),
                                'default' => 300,
                            ),
                            array(
                                'id'      => 'shop_sidebar_space',
                                'type'    => 'spinner',
                                'title'   => esc_html__( 'Sidebar Space', 'dukamarket' ),
                                'desc'    => esc_html__( 'Default is General / Sidebar settings', 'dukamarket' ),
                                'min'     => 0,
                                'max'     => 200,
                                'step'    => 1,
                                'unit'    => 'px',
                                'default' => 30,
                            ),
                            array(
                                'id'      => 'shop_sidebar_width_tablet',
                                'type'    => 'slider',
                                'title'   => esc_html__( 'Sidebar Width Tablet', 'dukamarket' ),
                                'desc'    => esc_html__( 'resolution < 1200px', 'dukamarket' ),
                                'min'     => 200,
                                'max'     => 500,
                                'step'    => 1,
                                'unit'    => esc_html__( 'px', 'dukamarket' ),
                                'default' => 290,
                            ),
                            array(
                                'id'      => 'shop_sidebar_space_tablet',
                                'type'    => 'spinner',
                                'title'   => esc_html__( 'Sidebar Space Tablet', 'dukamarket' ),
                                'desc'    => esc_html__( 'resolution < 1200px', 'dukamarket' ),
                                'min'     => 0,
                                'max'     => 200,
                                'step'    => 1,
                                'unit'    => 'px',
                                'default' => 30,
                            ),
                        ),
                    ),
                    array(
                        'title'  => esc_html__( 'Shop Page Items', 'dukamarket' ),
                        'fields' => array(
                            array(
                                'id'      => 'shop_product_style',
                                'type'    => 'select_preview',
                                'default' => 'style-01',
                                'title'   => esc_html__( 'Grid Items Style', 'dukamarket' ),
                                'options' => dukamarket_product_options( 'Theme Option' ),
                            ),
                            array(
                                'id'    => 'enable_short_title',
                                'type'  => 'switcher',
                                'title' => esc_html__( 'Short Title on Mobile ( < 768px )', 'dukamarket' ),
                            ),
                            array(
                                'id'    => 'short_text',
                                'type'  => 'switcher',
                                'title' => esc_html__( 'Short Title', 'dukamarket' ),
                            ),
                            array(
                                'id'    => 'disable_labels',
                                'type'  => 'switcher',
                                'title' => esc_html__( 'Disable Labels', 'dukamarket' ),
                            ),
                            array(
                                'id'    => 'disable_rating',
                                'type'  => 'switcher',
                                'title' => esc_html__( 'Disable Rating', 'dukamarket' ),
                            ),
                            array(
                                'id'    => 'disable_add_cart',
                                'type'  => 'switcher',
                                'title' => esc_html__( 'Disable Add to Cart', 'dukamarket' ),
                            ),
                        ),
                    ),
                    array(
                        'title'  => esc_html__( 'Product Single', 'dukamarket' ),
                        'fields' => array(
                            array(
                                'id'      => 'single_product_thumbnail',
                                'type'    => 'select',
                                'title'   => esc_html__( 'Product Thumbnails', 'dukamarket' ),
                                'options' => array(
                                    'standard' => esc_html__( 'Standard', 'dukamarket' ),
                                    'grid'     => esc_html__( 'Grid Gallery', 'dukamarket' ),
                                    'slide'    => esc_html__( 'Slide Gallery', 'dukamarket' ),
                                    'sticky'   => esc_html__( 'Sticky Summary', 'dukamarket' ),
                                ),
                                'default' => 'standard',
                            ),
                            array(
                                'id'    => 'enable_countdown_product',
                                'type'  => 'switcher',
                                'title' => esc_html__( 'Enable Countdown', 'dukamarket' ),
                            ),
                            array(
                                'id'    => 'enable_share_product',
                                'type'  => 'switcher',
                                'title' => esc_html__( 'Enable Share', 'dukamarket' ),
                            ),
                            array(
                                'id'    => 'disable_zoom',
                                'type'  => 'switcher',
                                'title' => esc_html__( 'Disable Zoom Gallery', 'dukamarket' ),
                            ),
                            array(
                                'id'    => 'disable_lightbox',
                                'type'  => 'switcher',
                                'title' => esc_html__( 'Disable Lightbox Gallery', 'dukamarket' ),
                            ),
                            array(
                                'id'      => 'single_product_tabs',
                                'type'    => 'select',
                                'title'   => esc_html__( 'Product Tabs', 'dukamarket' ),
                                'options' => array(
                                    ''         => esc_html__( 'Default', 'dukamarket' ),
                                    'show-all' => esc_html__( 'Show All', 'dukamarket' ),
                                ),
                                'default' => '',
                            ),
                        ),
                    ),
                    array(
                        'title'  => esc_html__( 'Related Products', 'dukamarket' ),
                        'fields' => array(
                            array(
                                'id'      => 'woo_related_enable',
                                'type'    => 'button_set',
                                'default' => 'enable',
                                'options' => array(
                                    'enable'  => esc_html__( 'Enable', 'dukamarket' ),
                                    'disable' => esc_html__( 'Disable', 'dukamarket' ),
                                ),
                                'title'   => esc_html__( 'Enable Related Products', 'dukamarket' ),
                            ),
                            array(
                                'id'         => 'woo_related_title',
                                'type'       => 'text',
                                'title'      => esc_html__( 'Related products title', 'dukamarket' ),
                                'desc'       => esc_html__( 'Related products title', 'dukamarket' ),
                                'dependency' => array( 'woo_related_enable', '==', 'enable' ),
                                'default'    => esc_html__( 'Related Products', 'dukamarket' ),
                            ),
                            array(
                                'id'         => 'woo_related_style',
                                'type'       => 'select_preview',
                                'default'    => 'style-03',
                                'title'      => esc_html__( 'Product Related Layout', 'dukamarket' ),
                                'options'    => dukamarket_product_options( 'Theme Option' ),
                                'dependency' => array( 'woo_related_enable', '==', 'enable' ),
                            ),
                            array(
                                'id'         => 'woo_related_perpage',
                                'type'       => 'spinner',
                                'title'      => esc_html__( 'Related products Items', 'dukamarket' ),
                                'desc'       => esc_html__( 'Number Related products to show', 'dukamarket' ),
                                'dependency' => array( 'woo_related_enable', '==', 'enable' ),
                                'default'    => 6,
                                'unit'       => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_related_desktop',
                                'title'   => esc_html__( 'items on Desktop', 'dukamarket' ),
                                'desc'    => esc_html__( '1500px <= resolution', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 6,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_related_laptop',
                                'title'   => esc_html__( 'items on Laptop', 'dukamarket' ),
                                'desc'    => esc_html__( '1200px <= resolution < 1500px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 5,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_related_ipad',
                                'title'   => esc_html__( 'items on Ipad', 'dukamarket' ),
                                'desc'    => esc_html__( '992px <= resolution < 1200px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 4,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_related_landscape',
                                'title'   => esc_html__( 'items on Landscape Tablet', 'dukamarket' ),
                                'desc'    => esc_html__( '768px <= resolution < 992px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 3,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_related_portrait',
                                'title'   => esc_html__( 'items on Portrait Tablet', 'dukamarket' ),
                                'desc'    => esc_html__( '480px <= resolution < 768px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 3,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_related_mobile',
                                'title'   => esc_html__( 'items on Mobile', 'dukamarket' ),
                                'desc'    => esc_html__( 'resolution < 480px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 2,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                        ),
                    ),
                    array(
                        'title'  => esc_html__( 'Upsell Products', 'dukamarket' ),
                        'fields' => array(
                            array(
                                'id'      => 'woo_upsell_enable',
                                'type'    => 'button_set',
                                'default' => 'enable',
                                'options' => array(
                                    'enable'  => esc_html__( 'Enable', 'dukamarket' ),
                                    'disable' => esc_html__( 'Disable', 'dukamarket' ),
                                ),
                                'title'   => esc_html__( 'Enable Upsell Products', 'dukamarket' ),
                            ),
                            array(
                                'id'         => 'woo_upsell_title',
                                'type'       => 'text',
                                'title'      => esc_html__( 'Upsell products title', 'dukamarket' ),
                                'desc'       => esc_html__( 'Upsell products title', 'dukamarket' ),
                                'dependency' => array( 'woo_upsell_enable', '==', 'enable' ),
                                'default'    => esc_html__( 'Upsell Products', 'dukamarket' ),
                            ),
                            array(
                                'id'         => 'woo_upsell_style',
                                'type'       => 'select_preview',
                                'default'    => 'style-03',
                                'title'      => esc_html__( 'Product Upsell Layout', 'dukamarket' ),
                                'options'    => dukamarket_product_options( 'Theme Option' ),
                                'dependency' => array( 'woo_upsell_enable', '==', 'enable' ),
                            ),
                            array(
                                'id'      => 'woo_upsell_desktop',
                                'title'   => esc_html__( 'items on Desktop', 'dukamarket' ),
                                'desc'    => esc_html__( '1500px <= resolution', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 6,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_upsell_laptop',
                                'title'   => esc_html__( 'items on Laptop', 'dukamarket' ),
                                'desc'    => esc_html__( '1200px <= resolution < 1500px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 5,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_upsell_ipad',
                                'title'   => esc_html__( 'items on Ipad', 'dukamarket' ),
                                'desc'    => esc_html__( '992px <= resolution < 1200px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 4,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_upsell_landscape',
                                'title'   => esc_html__( 'items on Landscape Tablet', 'dukamarket' ),
                                'desc'    => esc_html__( '768px <= resolution < 992px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 3,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_upsell_portrait',
                                'title'   => esc_html__( 'items on Portrait Tablet', 'dukamarket' ),
                                'desc'    => esc_html__( '480px <= resolution < 768px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 3,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_upsell_mobile',
                                'title'   => esc_html__( 'items on Mobile', 'dukamarket' ),
                                'desc'    => esc_html__( 'resolution < 480px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 2,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                        ),
                    ),
                    array(
                        'title'  => esc_html__( 'Cross Sell Products', 'dukamarket' ),
                        'fields' => array(
                            array(
                                'id'      => 'woo_crosssell_enable',
                                'type'    => 'button_set',
                                'default' => 'enable',
                                'options' => array(
                                    'enable'  => esc_html__( 'Enable', 'dukamarket' ),
                                    'disable' => esc_html__( 'Disable', 'dukamarket' ),
                                ),
                                'title'   => esc_html__( 'Enable Cross Sell Products', 'dukamarket' ),
                            ),
                            array(
                                'id'         => 'woo_crosssell_title',
                                'type'       => 'text',
                                'title'      => esc_html__( 'Cross Sell products title', 'dukamarket' ),
                                'desc'       => esc_html__( 'Cross Sell products title', 'dukamarket' ),
                                'dependency' => array( 'woo_crosssell_enable', '==', 'enable' ),
                                'default'    => esc_html__( 'Cross Sell Products', 'dukamarket' ),
                            ),
                            array(
                                'id'         => 'woo_crosssell_style',
                                'type'       => 'select_preview',
                                'default'    => 'style-03',
                                'title'      => esc_html__( 'Product Cross Sell Layout', 'dukamarket' ),
                                'options'    => dukamarket_product_options( 'Theme Option' ),
                                'dependency' => array( 'woo_crosssell_enable', '==', 'enable' ),
                            ),
                            array(
                                'id'      => 'woo_crosssell_desktop',
                                'title'   => esc_html__( 'items on Desktop', 'dukamarket' ),
                                'desc'    => esc_html__( '1500px <= resolution', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 6,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_crosssell_laptop',
                                'title'   => esc_html__( 'items on Laptop', 'dukamarket' ),
                                'desc'    => esc_html__( '1200px <= resolution < 1500px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 5,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_crosssell_ipad',
                                'title'   => esc_html__( 'items on Ipad', 'dukamarket' ),
                                'desc'    => esc_html__( '992px <= resolution < 1200px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 4,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_crosssell_landscape',
                                'title'   => esc_html__( 'items on Landscape Tablet', 'dukamarket' ),
                                'desc'    => esc_html__( '768px <= resolution < 992px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 3,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_crosssell_portrait',
                                'title'   => esc_html__( 'items on Portrait Tablet', 'dukamarket' ),
                                'desc'    => esc_html__( '480px <= resolution < 768px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 3,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                            array(
                                'id'      => 'woo_crosssell_mobile',
                                'title'   => esc_html__( 'items on Mobile', 'dukamarket' ),
                                'desc'    => esc_html__( 'resolution < 480px', 'dukamarket' ),
                                'type'    => 'slider',
                                'default' => 2,
                                'min'     => 1,
                                'max'     => 6,
                                'unit'    => 'item(s)',
                            ),
                        ),
                    ),
                ),
            );
        }
        $options['social']     = array(
            'name'   => 'social',
            'icon'   => 'fa fa-users',
            'title'  => esc_html__( 'Social', 'dukamarket' ),
            'fields' => array(
                array(
                    'id'              => 'user_all_social',
                    'type'            => 'group',
                    'title'           => esc_html__( 'Social', 'dukamarket' ),
                    'button_title'    => esc_html__( 'Add New Social', 'dukamarket' ),
                    'accordion_title' => esc_html__( 'Social Settings', 'dukamarket' ),
                    'fields'          => array(
                        array(
                            'id'      => 'title_social',
                            'type'    => 'text',
                            'title'   => esc_html__( 'Title Social', 'dukamarket' ),
                            'default' => esc_html__( 'Facebook', 'dukamarket' ),
                        ),
                        array(
                            'id'      => 'link_social',
                            'type'    => 'text',
                            'title'   => esc_html__( 'Link Social', 'dukamarket' ),
                            'default' => 'https://facebook.com',
                        ),
                        array(
                            'id'      => 'icon_social',
                            'type'    => 'icon',
                            'title'   => esc_html__( 'Icon Social', 'dukamarket' ),
                            'default' => 'fa fa-facebook',
                        ),
                    ),
                    'default'         => array(
                        array(
                            'title_social' => esc_html__( 'Facebook', 'dukamarket' ),
                            'link_social'  => 'https://facebook.com/',
                            'icon_social'  => 'fa fa-facebook',
                        ),
                        array(
                            'title_social' => esc_html__( 'Twitter', 'dukamarket' ),
                            'link_social'  => 'https://twitter.com/',
                            'icon_social'  => 'fa fa-twitter',
                        ),
                        array(
                            'title_social' => esc_html__( 'Instagram', 'dukamarket' ),
                            'link_social'  => 'https://instagram.com/',
                            'icon_social'  => 'fa fa-instagram',
                        ),
                        array(
                            'title_social' => esc_html__( 'Youtube', 'dukamarket' ),
                            'link_social'  => 'https://youtube.com/',
                            'icon_social'  => 'fa fa-youtube-play',
                        ),
                    ),
                ),
            ),
        );
        $options['typography'] = array(
            'name'   => 'typography',
            'icon'   => 'fa fa-font',
            'title'  => esc_html__( 'Typography', 'dukamarket' ),
            'fields' => array(
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
        );
        $options['backup']     = array(
            'name'   => 'backup',
            'icon'   => 'fa fa-bold',
            'title'  => esc_html__( 'Backup / Reset', 'dukamarket' ),
            'fields' => array(
                array(
                    'id'    => 'reset',
                    'type'  => 'backup',
                    'title' => esc_html__( 'Reset', 'dukamarket' ),
                ),
                array(
                    'id'      => 'delete_transients',
                    'type'    => 'content',
                    'content' => '<a href="#" data-text-done="' . esc_attr__( '%n transient database entries have been deleted.', 'dukamarket' ) . '" class="button button-primary delete-transients"/>' . esc_html__( 'Delete Transients', 'dukamarket' ) . '</a><span class="spinner" style="float:none;"></span>',
                    'title'   => esc_html__( 'Delete Transients', 'dukamarket' ),
                    'desc'    => esc_html__( 'All transient related database entries will be deleted.', 'dukamarket' ),
                    'after'   => ' <p class="ovic-text-success"></p>',
                ),
            ),
        );
        //
        // Framework Settings
        //
        $settings = array(
            'option_name'      => '_ovic_customize_options',
            'menu_title'       => esc_html__( 'Theme Options', 'dukamarket' ),
            'menu_type'        => 'submenu', // menu, submenu, options, theme, etc.
            'menu_parent'      => 'ovic_addon-dashboard',
            'menu_slug'        => 'ovic_theme_options',
            'menu_position'    => 5,
            'show_search'      => true,
            'show_reset'       => true,
            'show_footer'      => false,
            'show_all_options' => true,
            'ajax_save'        => true,
            'sticky_header'    => false,
            'save_defaults'    => true,
            'framework_title'  => sprintf(
                '%s <small>%s <a href="%s" target="_blank">%s</a></small>',
                esc_html__( 'Theme Options', 'dukamarket' ),
                esc_html__( 'by', 'dukamarket' ),
                esc_url( 'https://kutethemes.com/' ),
                esc_html__( 'Kutethemes', 'dukamarket' )
            ),
        );

        OVIC_Options::instance( $settings, apply_filters( 'dukamarket_framework_theme_options', $options ) );
    }

    add_action( 'init', 'dukamarket_theme_options' );
}