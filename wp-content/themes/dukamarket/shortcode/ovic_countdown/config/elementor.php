<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Core\Schemes;
use Elementor\Controls_Manager as Controls_Manager;
use Elementor\Group_Control_Border;

class Elementor_Ovic_Countdown extends Ovic_Widget_Elementor
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
        return 'ovic_countdown';
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
        return esc_html__( 'Countdown', 'dukamarket' );
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
        return 'eicon-countdown';
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

        $this->add_responsive_control(
            'align',
            [
                'label'        => esc_html__( 'Alignment', 'dukamarket' ),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'    => [
                        'title' => esc_html__( 'Left', 'dukamarket' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__( 'Center', 'dukamarket' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__( 'Right', 'dukamarket' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
                'default'      => '',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        echo ovic_do_shortcode( $this->get_name(), $settings );
    }
}