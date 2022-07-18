<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Controls_Manager as Controls_Manager;

class Elementor_Ovic_Products extends Ovic_Widget_Elementor
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
        return 'ovic_products';
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
        return esc_html__( 'Products', 'dukamarket' );
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
        return 'eicon-woocommerce';
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'general_section',
            array(
                'tab'   => Controls_Manager::TAB_CONTENT,
                'label' => esc_html__( 'General', 'dukamarket' ),
            )
        );

        $this->start_controls_tabs( 'tabs_general' );

        $this->start_controls_tab(
            'tab_general',
            [
                'label' => esc_html__( 'Settings', 'dukamarket' ),
            ]
        );

        $this->add_control(
            'list_style',
            array(
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'List style', 'dukamarket' ),
                'options' => [
                    'none' => esc_html__( 'None', 'dukamarket' ),
                    'grid' => esc_html__( 'Bootstrap', 'dukamarket' ),
                    'owl'  => esc_html__( 'Carousel', 'dukamarket' ),
                ],
                'default' => 'owl',
            )
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
                    'border-full'   => esc_html__( 'Full', 'dukamarket' ),
                    'border-simple' => esc_html__( 'Simple', 'dukamarket' ),
                ],
                'default'   => '',
                'condition' => [
                    'list_style'    => 'owl',
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

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_products',
            [
                'label' => esc_html__( 'Products', 'dukamarket' ),
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label'   => esc_html__( 'Pagination', 'dukamarket' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'none'      => esc_html__( 'None', 'dukamarket' ),
                    'view_all'  => esc_html__( 'View all', 'dukamarket' ),
                    'load_more' => esc_html__( 'Load More', 'dukamarket' ),
                    'infinite'  => esc_html__( 'Infinite Scrolling', 'dukamarket' ),
                ],
                'default' => 'none',
            ]
        );

        $this->add_control(
            'link',
            [
                'type'        => Controls_Manager::URL,
                'label'       => esc_html__( 'Link', 'dukamarket' ),
                'placeholder' => esc_html__( 'https://your-link.com', 'dukamarket' ),
                'default'     => [
                    'url' => '#',
                ],
                'condition'   => [
                    'pagination' => 'view_all',
                ],
            ]
        );

        $this->add_control(
            'text_button',
            [
                'type'      => Controls_Manager::TEXT,
                'label'     => esc_html__( 'Text button', 'dukamarket' ),
                'default'   => 'VIEW ALL',
                'condition' => [
                    'pagination' => 'view_all',
                ],
            ]
        );

        $this->add_control(
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
            $this->add_control(
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
            $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
            'limit',
            [
                'label'       => esc_html__( 'Limit', 'dukamarket' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 6,
                'placeholder' => 6,
            ]
        );

        $this->add_control(
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

        $this->add_control(
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

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_section',
            [
                'tab'       => Controls_Manager::TAB_SETTINGS,
                'label'     => esc_html__( 'Carousel settings', 'dukamarket' ),
                'condition' => [
                    'list_style' => 'owl',
                ],
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

        $this->bootstrap_settings( [
            'tab'       => Controls_Manager::TAB_SETTINGS,
            'label'     => esc_html__( 'Bootstrap settings', 'dukamarket' ),
            'condition' => [
                'list_style' => 'grid',
            ],
        ] );
    }

    protected function render()
    {
        $settings        = $this->get_settings_for_display();
        $settings['_id'] = substr( $this->get_id_int(), 0, 3 );

        echo ovic_do_shortcode( $this->get_name(), $settings );
    }
}