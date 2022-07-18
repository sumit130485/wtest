<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Core\Schemes;
use Elementor\Controls_Manager as Controls_Manager;

class Elementor_Ovic_Brand extends Ovic_Widget_Elementor
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
        return 'ovic_brand';
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
        return esc_html__( 'Brand', 'dukamarket' );
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
        return 'eicon-review';
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
            'category',
            [
                'label'       => esc_html__( 'Products Brand', 'dukamarket' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_taxonomy( [
                    'hide_empty' => false,
                    'taxonomy'   => 'product_brand',
                ] ),
                'multiple'    => true,
                'label_block' => true,
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
                    '{{WRAPPER}} .image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'background',
            [
                'label'     => esc_html__( 'Background', 'dukamarket' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .image' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'space',
            [
                'label'      => esc_html__( 'Padding', 'dukamarket' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'label'    => esc_html__( 'Border', 'dukamarket' ),
                'selector' => '{{WRAPPER}} .image',
            ]
        );

        $this->add_control(
            'full_width',
            [
                'label'     => esc_html__( 'Item Full Width', 'dukamarket' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .thumb' => 'width: 100%;',
                ],
            ]
        );

        $this->add_control(
            'image_effect',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'Ovic Hover Animation', 'dukamarket' ),
                'options' => dukamarket_effect_style(),
                'default' => '',
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
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if ( !empty( $settings['text_button'] ) ) {
            $this->add_render_attribute( '_wrapper', 'class', 'has-button' );
        }

        echo ovic_do_shortcode( $this->get_name(), $settings );
    }
}