<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Core\Schemes;
use Elementor\Controls_Manager as Controls_Manager;

class Elementor_Ovic_Tabs extends Ovic_Widget_Elementor
{
    /**
     * Get widget name.
     *
     * Retrieve image widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'ovic_tabs';
    }

    /**
     * Get widget title.
     *
     * Retrieve image widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return esc_html__( 'Tabs', 'dukamarket' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve image widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-product-tabs';
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'general_section',
            [
                'tab'   => Controls_Manager::TAB_CONTENT,
                'label' => esc_html__( 'General', 'dukamarket' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'Tab style', 'dukamarket' ),
                'options' => dukamarket_preview_options( $this->get_name() ),
                'default' => 'style-01',
            ]
        );

        $this->add_control(
            'tab_title',
            [
                'label'       => esc_html__( 'Title', 'dukamarket' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'active',
            [
                'label'   => esc_html__( 'Active', 'dukamarket' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 1,
                'min'     => 1,
            ]
        );

        $this->add_control(
            'is_ajax',
            [
                'label' => esc_html__( 'Enable ajax', 'dukamarket' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => esc_html__( 'Alignment', 'dukamarket' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'dukamarket' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'dukamarket' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'dukamarket' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tabs-head' => 'text-align: {{VALUE}};',
                ],
                'default'   => '',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tab_section',
            [
                'tab'   => Controls_Manager::TAB_CONTENT,
                'label' => esc_html__( 'Tab Content', 'dukamarket' ),
            ]
        );

        $repeater = new Elementor\Repeater();

        $repeater->start_controls_tabs( 'tab_repeater' );

        $repeater->start_controls_tab(
            'tab_title',
            [
                'label' => esc_html__( 'Title', 'dukamarket' ),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'dukamarket' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tab Title', 'dukamarket' ),
                'placeholder' => esc_html__( 'Tab Title', 'dukamarket' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label'   => esc_html__( 'Content', 'dukamarket' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'product'  => esc_html__( 'Products', 'dukamarket' ),
                    'template' => esc_html__( 'Template', 'dukamarket' ),
                    'link'     => esc_html__( 'Simple Link', 'dukamarket' ),
                ],
                'default' => 'product',
            ]
        );

        $repeater->add_control(
            'selected_media',
            [
                'label'   => esc_html__( 'Media', 'dukamarket' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'image' => esc_html__( 'Image', 'dukamarket' ),
                    'icon'  => esc_html__( 'Icon', 'dukamarket' ),
                ],
                'default' => 'image',
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'label'            => esc_html__( 'Icon', 'dukamarket' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition'        => [
                    'selected_media' => 'icon'
                ],
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label'     => esc_html__( 'Image', 'dukamarket' ),
                'type'      => Controls_Manager::MEDIA,
                'condition' => [
                    'selected_media' => 'image'
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'       => esc_html__( 'Link', 'dukamarket' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'dukamarket' ),
                'default'     => [
                    'url' => '#',
                ],
                'condition'   => [
                    'content' => 'link',
                ],
            ]
        );

        $repeater->add_control(
            'class',
            [
                'label'       => esc_html__( 'Class', 'dukamarket' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'tab_template',
            [
                'label'     => esc_html__( 'Template', 'dukamarket' ),
                'condition' => [
                    'content' => 'template',
                ],
            ]
        );

        if ( class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ) {
            $repeater->add_control(
                'template_id',
                [
                    'label'        => esc_html__( 'Template ID', 'dukamarket' ),
                    'type'         => ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
                    'options'      => [],
                    'label_block'  => true,
                    'multiple'     => false,
                    'autocomplete' => [
                        'object' => ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_POST,
                        'query'  => [
                            'post_type' => 'elementor_library'
                        ],
                    ],
                    'description'  => sprintf( '%s <a href="%s" target="_blank">%s</a>',
                        esc_html__( 'Create template from', 'dukamarket' ),
                        admin_url( 'edit.php?post_type=elementor_library&tabs_group=library' ),
                        esc_html__( 'Here', 'dukamarket' )
                    ),
                    'export'       => false,
                ]
            );
        } else {
            $repeater->add_control(
                'template_id',
                [
                    'label'       => esc_html__( 'Template ID', 'dukamarket' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'placeholder' => '1',
                    'description' => sprintf( '%s <a href="%s" target="_blank">%s</a>',
                        esc_html__( 'Create template from', 'dukamarket' ),
                        admin_url( 'edit.php?post_type=elementor_library&tabs_group=library' ),
                        esc_html__( 'Here', 'dukamarket' )
                    ),
                ]
            );
        }

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'tab_product',
            [
                'label'     => esc_html__( 'Product', 'dukamarket' ),
                'condition' => [
                    'content' => 'product',
                ],
            ]
        );

        $repeater->add_control(
            'target',
            [
                'label'   => esc_html__( 'Target', 'dukamarket' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'recent_products'       => esc_html__( 'Recent Products', 'dukamarket' ),
                    'featured_products'     => esc_html__( 'Feature Products', 'dukamarket' ),
                    'sale_products'         => esc_html__( 'Sale Products', 'dukamarket' ),
                    'best_selling_products' => esc_html__( 'Best Selling Products', 'dukamarket' ),
                    'top_rated_products'    => esc_html__( 'Top Rated Products', 'dukamarket' ),
                    'products'              => esc_html__( 'Products', 'dukamarket' ),
                    'product_category'      => esc_html__( 'Products Category', 'dukamarket' ),
                    'related_products'      => esc_html__( 'Products Related', 'dukamarket' ),
                ],
                'default' => 'recent_products',
            ]
        );

        if ( class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ) {
            $repeater->add_control(
                'ids',
                [
                    'label'        => esc_html__( 'Search Product', 'dukamarket' ),
                    'type'         => ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
                    'options'      => [],
                    'label_block'  => true,
                    'multiple'     => true,
                    'autocomplete' => [
                        'object' => ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_POST,
                        'query'  => [
                            'post_type' => 'product'
                        ],
                    ],
                    'condition'    => [
                        'target' => 'products'
                    ],
                    'export'       => false,
                ]
            );
        } else {
            $repeater->add_control(
                'ids',
                [
                    'label'       => esc_html__( 'Product', 'dukamarket' ),
                    'type'        => Controls_Manager::TEXT,
                    'description' => esc_html__( 'Product ids', 'dukamarket' ),
                    'placeholder' => '1,2,3',
                    'label_block' => true,
                    'condition'   => [
                        'target' => 'products'
                    ],
                ]
            );
        }

        $repeater->add_control(
            'category',
            [
                'label'       => esc_html__( 'Products Category', 'dukamarket' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_taxonomy( [
                    'hide_empty' => true,
                    'taxonomy'   => 'product_cat',
                ] ),
                'label_block' => true,
                'condition'   => [
                    'target!' => 'products'
                ],
            ]
        );

        $repeater->add_control(
            'limit',
            [
                'label'       => esc_html__( 'Limit', 'dukamarket' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 6,
                'placeholder' => 6,
            ]
        );

        $repeater->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order by', 'dukamarket' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''              => esc_html__( 'None', 'dukamarket' ),
                    'date'          => esc_html__( 'Date', 'dukamarket' ),
                    'ID'            => esc_html__( 'ID', 'dukamarket' ),
                    'author'        => esc_html__( 'Author', 'dukamarket' ),
                    'title'         => esc_html__( 'Title', 'dukamarket' ),
                    'modified'      => esc_html__( 'Modified', 'dukamarket' ),
                    'rand'          => esc_html__( 'Random', 'dukamarket' ),
                    'comment_count' => esc_html__( 'Comment count', 'dukamarket' ),
                    'menu_order'    => esc_html__( 'Menu order', 'dukamarket' ),
                    'price'         => esc_html__( 'Price: low to high', 'dukamarket' ),
                    'price-desc'    => esc_html__( 'Price: high to low', 'dukamarket' ),
                    'rating'        => esc_html__( 'Average Rating', 'dukamarket' ),
                    'popularity'    => esc_html__( 'Popularity', 'dukamarket' ),
                    'post__in'      => esc_html__( 'Post In', 'dukamarket' ),
                    'most-viewed'   => esc_html__( 'Most Viewed', 'dukamarket' ),
                ],
            ]
        );

        $repeater->add_control(
            'order',
            [
                'label'   => esc_html__( 'Sort order', 'dukamarket' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''     => esc_html__( 'None', 'dukamarket' ),
                    'DESC' => esc_html__( 'Descending', 'dukamarket' ),
                    'ASC'  => esc_html__( 'Ascending', 'dukamarket' ),
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'tabs',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'product_section',
            [
                'tab'   => Controls_Manager::TAB_SETTINGS,
                'label' => esc_html__( 'Product Settings', 'dukamarket' ),
            ]
        );

        $this->add_control(
            'product_style',
            array(
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'Product style', 'dukamarket' ),
                'options' => dukamarket_product_options( 'Shortcode', true ),
                'default' => 'style-01',
            )
        );

        $this->add_control(
            'border_style_2',
            array(
                'type'      => Controls_Manager::SELECT,
                'label'     => esc_html__( 'Border Style', 'dukamarket' ),
                'options'   => [
                    ''            => esc_html__( 'None', 'dukamarket' ),
                    'border-full' => esc_html__( 'Full', 'dukamarket' ),
                ],
                'default'   => '',
                'condition' => [
                    'product_style!' => [
                        'style-03',
                        'style-04'
                    ],
                ],
            )
        );

        $this->add_control(
            'border_style',
            array(
                'type'      => Controls_Manager::SELECT,
                'label'     => esc_html__( 'Border Style', 'dukamarket' ),
                'options'   => [
                    ''              => esc_html__( 'None', 'dukamarket' ),
                    'border-simple' => esc_html__( 'Simple', 'dukamarket' ),
                    'border-full'   => esc_html__( 'Full', 'dukamarket' ),
                ],
                'default'   => '',
                'condition' => [
                    'product_style' => [
                        'style-03',
                        'style-04'
                    ],
                ],
            )
        );

        $this->product_size_field();

        $this->add_control(
            'main_bora',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'Radius of Button', 'dukamarket' ),
                'options' => [
                    ''            => esc_html__( 'Border Radius', 'dukamarket' ),
                    'main-bora-2' => esc_html__( 'Border Radius 2', 'dukamarket' ),
                ],
                'default' => '',
            ]
        );

        $this->add_control(
            'main_bora_wrap',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'Radius of Wrap', 'dukamarket' ),
                'options' => [
                    ''                 => esc_html__( 'Border Radius', 'dukamarket' ),
                    'wrap-main-bora-2' => esc_html__( 'Border Radius 2', 'dukamarket' ),
                ],
                'default' => '',
            ]
        );

        $this->add_control(
            'short_text',
            [
                'label'        => esc_html__( 'Short Title', 'dukamarket' ),
                'prefix_class' => 'short-text-',
                'type'         => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'uppercase_title',
            [
                'label'        => esc_html__( 'Uppercase Title', 'dukamarket' ),
                'prefix_class' => 'uppercase-title-',
                'type'         => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'disable_labels',
            [
                'label'        => esc_html__( 'Disable Labels', 'dukamarket' ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'labels-not-',
            ]
        );

        $this->add_control(
            'disable_rating',
            [
                'label'        => esc_html__( 'Disable Rating', 'dukamarket' ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'rating-not-',
            ]
        );

        $this->add_control(
            'disable_add_cart',
            [
                'label'        => esc_html__( 'Disable Add to Cart', 'dukamarket' ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'add-cart-not-',
            ]
        );

        $this->add_control(
            'overflow_visible',
            [
                'label' => esc_html__( 'Content Overflow', 'dukamarket' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_section',
            [
                'tab'   => Controls_Manager::TAB_SETTINGS,
                'label' => esc_html__( 'Carousel settings', 'dukamarket' ),
            ]
        );

        $this->add_control(
            'slide_nav',
            [
                'label'   => esc_html__( 'Nav style', 'dukamarket' ),
                'type'    => Controls_Manager::SELECT,
                'options' => dukamarket_nav_style(),
                'default' => '',
            ]
        );

        $this->carousel_settings( false );

        $this->end_controls_section();
    }
}