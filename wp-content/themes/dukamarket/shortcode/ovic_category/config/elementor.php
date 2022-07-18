<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Controls_Manager as Controls_Manager;

class Elementor_Ovic_Category extends Ovic_Widget_Elementor
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
        return 'ovic_category';
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
        return esc_html__( 'Category', 'dukamarket' );
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
        return 'eicon-product-categories';
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
            'category',
            [
                'label'       => esc_html__( 'Products Category', 'dukamarket' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_taxonomy( [
                    'hide_empty' => false,
                    'taxonomy'   => 'product_cat',
                ] ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Title', 'dukamarket' ),
                'description' => esc_html__( 'Default is Category Name', 'dukamarket' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'type'        => Controls_Manager::MEDIA,
                'label'       => esc_html__( 'Image', 'dukamarket' ),
                'description' => esc_html__( 'Default is Category Thumbnail', 'dukamarket' ),
                'label_block' => true,
                'condition'   => [
                    'style!' => [
                        'style-03',
                        'style-05',
                        'style-06'
                    ],
                ],
            ]
        );

        $this->add_control(
            'image_icon',
            [
                'type'             => Controls_Manager::ICONS,
                'label'            => esc_html__( 'Icon', 'dukamarket' ),
                'description'      => esc_html__( 'Default is Category Thumbnail', 'dukamarket' ),
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'far fa-paper-plane',
                    'library' => 'fa-regular',
                ],
                'condition'        => [
                    'style' => [
                        'style-03',
                        'style-05',
                        'style-06'
                    ],
                ],
            ]
        );

        $this->add_control(
            'count',
            [
                'type'    => Controls_Manager::SWITCHER,
                'label'   => esc_html__( 'Show Count', 'dukamarket' ),
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label'     => esc_html__( 'Height', 'dukamarket' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .thumb' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style!' => [
                        'style-03',
                        'style-05',
                        'style-06'
                    ],
                ],
            ]
        );

        $this->add_control(
            'image_effect',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'Hover', 'dukamarket' ),
                'options' => dukamarket_effect_style(),
                'default' => '',
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

        $this->end_controls_section();
    }
}