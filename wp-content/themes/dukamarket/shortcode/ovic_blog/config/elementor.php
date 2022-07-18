<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Controls_Manager as Controls_Manager;

class Elementor_Ovic_Blog extends Ovic_Widget_Elementor
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
        return 'ovic_blog';
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
        return esc_html__( 'Blog', 'dukamarket' );
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
        return 'eicon-post-list';
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

        $this->add_control(
            'style',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'Select style', 'dukamarket' ),
                'options' => dukamarket_preview_options( $this->get_name() ),
                'default' => 'style-01',
            ]
        );

        $this->add_control(
            'main_bora',
            [
                'type'         => Controls_Manager::SELECT,
                'label'        => esc_html__( 'Border Radius', 'dukamarket' ),
                'options'      => [
                    ''            => esc_html__( 'Border Radius', 'dukamarket' ),
                    'main-bora-2' => esc_html__( 'Border Radius 2', 'dukamarket' ),
                ],
                'prefix_class' => '',
                'default'      => '',
            ]
        );

        $this->add_control(
            'image_width',
            [
                'type'    => Controls_Manager::NUMBER,
                'label'   => esc_html__( 'Image width', 'dukamarket' ),
                'default' => 272,
            ]
        );

        $this->add_control(
            'image_height',
            [
                'type'    => Controls_Manager::NUMBER,
                'label'   => esc_html__( 'Image height', 'dukamarket' ),
                'default' => 170,
            ]
        );

        $this->add_control(
            'image_full_size',
            [
                'type'  => Controls_Manager::SWITCHER,
                'label' => esc_html__( 'Image Full size', 'dukamarket' ),
            ]
        );

        $this->add_control(
            'excerpt',
            [
                'type'    => Controls_Manager::SWITCHER,
                'label'   => esc_html__( 'Show Excerpt', 'dukamarket' ),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'excerpt_number',
            [
                'type'      => Controls_Manager::NUMBER,
                'label'     => esc_html__( 'Word Number in Excerpt', 'dukamarket' ),
                'default'   => 9,
                'condition' => [
                    'excerpt' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'target',
            [
                'label'   => esc_html__( 'Target', 'dukamarket' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'recent_post' => esc_html__( 'Latest', 'dukamarket' ),
                    'popularity'  => esc_html__( 'Popularity', 'dukamarket' ),
                    'date'        => esc_html__( 'Date', 'dukamarket' ),
                    'title'       => esc_html__( 'Title', 'dukamarket' ),
                    'post'        => esc_html__( 'Post', 'dukamarket' ),
                    'random'      => esc_html__( 'Random', 'dukamarket' ),
                ],
                'default' => 'recent_post',
            ]
        );

        if ( class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ) {
            $this->add_control(
                'ids',
                [
                    'label'        => esc_html__( 'Search Post', 'dukamarket' ),
                    'type'         => ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
                    'options'      => [],
                    'label_block'  => true,
                    'multiple'     => true,
                    'autocomplete' => [
                        'object' => ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_POST,
                        'query'  => [
                            'post_type' => 'post'
                        ],
                    ],
                    'condition'    => [
                        'target' => 'post'
                    ],
                    'export'       => false,
                ]
            );
        } else {
            $this->add_control(
                'ids',
                [
                    'label'       => esc_html__( 'Post', 'dukamarket' ),
                    'type'        => Controls_Manager::TEXT,
                    'description' => esc_html__( 'Post ids', 'dukamarket' ),
                    'placeholder' => '1,2,3',
                    'label_block' => true,
                    'condition'   => [
                        'target' => 'post'
                    ],
                ]
            );
        }

        $this->add_control(
            'category',
            [
                'label'       => esc_html__( 'Category', 'dukamarket' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_taxonomy( [
                    'meta_key'   => '',
                    'hide_empty' => true,
                ] ),
                'label_block' => true,
                'condition'   => [
                    'target!' => 'post'
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
                    'post__in'      => esc_html__( 'Post In', 'dukamarket' ),
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

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        echo ovic_do_shortcode( $this->get_name(), $settings );
    }
}