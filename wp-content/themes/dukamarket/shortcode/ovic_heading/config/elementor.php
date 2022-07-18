<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Controls_Manager as Controls_Manager;

class Elementor_Ovic_Heading extends Ovic_Widget_Elementor
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
        return 'ovic_heading';
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
        return esc_html__( 'Heading', 'dukamarket' );
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
        return 'eicon-heading';
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
            'hide_border',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Hide Border', 'dukamarket' ),
                'prefix_class' => 'hide-border-',
            ]
        );

        $this->add_control(
            'text',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Text', 'dukamarket' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button',
            [
                'type'  => Controls_Manager::TEXT,
                'label' => esc_html__( 'Button', 'dukamarket' ),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Link', 'dukamarket' ),
                'type'  => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'date',
            [
                'type'           => Controls_Manager::DATE_TIME,
                'label'          => esc_html__( 'Countdown', 'dukamarket' ),
                'picker_options' => [
                    'dateFormat' => 'm/j/Y H:i:s',
                    'time_24hr'  => true,
                ],
            ]
        );

        $this->add_control(
            'date_title',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Countdown Title', 'dukamarket' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'days_text',
            [
                'type'  => Controls_Manager::TEXT,
                'label' => esc_html__( 'Days text', 'dukamarket' ),
            ]
        );

        $this->add_control(
            'hrs_text',
            [
                'type'  => Controls_Manager::TEXT,
                'label' => esc_html__( 'Hours text', 'dukamarket' ),
            ]
        );

        $this->add_control(
            'mins_text',
            [
                'type'  => Controls_Manager::TEXT,
                'label' => esc_html__( 'Mins text', 'dukamarket' ),
            ]
        );

        $this->add_control(
            'secs_text',
            [
                'type'  => Controls_Manager::TEXT,
                'label' => esc_html__( 'Secs text', 'dukamarket' ),
            ]
        );

        $this->end_controls_section();
    }
}