<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Core\Schemes;
use Elementor\Controls_Manager as Controls_Manager;

class Elementor_Ovic_Menu extends Ovic_Widget_Elementor
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
        return 'ovic_menu';
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
        return esc_html__( 'Menu', 'dukamarket' );
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
        return 'eicon-nav-menu';
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
            'layout',
            [
                'type'         => Controls_Manager::SELECT,
                'label'        => esc_html__( 'Layout', 'dukamarket' ),
                'options'      => [
                    ''           => esc_html__( 'Vertical', 'dukamarket' ),
                    'horizontal' => esc_html__( 'Horizontal', 'dukamarket' ),
                ],
                'prefix_class' => 'yes-',
                'default'      => '',
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'     => esc_html__( 'Columns', 'dukamarket' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 2,
                'selectors' => [
                    '{{WRAPPER}} .widget > ul > li'     => 'width: calc((100% / {{VALUE}}) - (var(--menu-space,0px) * 2));',
                    '{{WRAPPER}} .widget > * > ul > li' => 'width: calc((100% / {{VALUE}}) - (var(--menu-space,0px) * 2));',
                ],
                'condition' => [
                    'layout' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'columns_space',
            [
                'label'     => esc_html__( 'Columns Space', 'dukamarket' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'default'   => 5,
                'selectors' => [
                    '{{WRAPPER}} ul'                    => '--menu-space: {{VALUE}}px;',
                    '{{WRAPPER}} .widget > ul'          => 'margin-left: -{{VALUE}}px;margin-right: -{{VALUE}}px;',
                    '{{WRAPPER}} .widget > * > ul'      => 'margin-left: -{{VALUE}}px;margin-right: -{{VALUE}}px;',
                    '{{WRAPPER}} .widget > ul > li'     => 'margin-left: {{VALUE}}px;margin-right: {{VALUE}}px;',
                    '{{WRAPPER}} .widget > * > ul > li' => 'margin-left: {{VALUE}}px;margin-right: {{VALUE}}px;',
                ],
                'condition' => [
                    'layout'   => '',
                    'columns!' => '',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Title', 'dukamarket' ),
            ]
        );

        $this->add_control(
            'delimiter',
            [
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Delimiter', 'dukamarket' ),
                'selectors' => [
                    '{{WRAPPER}} .ovic-custommenu' => '--menu-delimiter: "{{VALUE}}";',
                ],
                'condition'   => [
                    'layout' => 'horizontal',
                ],
            ]
        );

        $this->add_control(
            'delimiter_opacity',
            [
                'label'     => esc_html__( 'Delimiter Opacity', 'dukamarket' ),
                'type'      => Controls_Manager::NUMBER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ovic-custommenu' => '--menu-delimiter-o: {{VALUE}};',
                ],
                'condition'   => [
                    'layout' => 'horizontal',
                ],
            ]
        );

        $locations = array();
        $menus     = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
        if ( !empty( $menus ) ) {
            foreach ( $menus as $menu ) {
                $locations[ $menu->slug ] = $menu->name;
            }
        }

        $this->add_control(
            'nav_menu',
            [
                'label_block' => true,
                'options'     => $locations,
                'type'        => Controls_Manager::SELECT2,
                'label'       => esc_html__( 'Menu', 'dukamarket' ),
                'description' => esc_html__( 'Select menu to display.', 'dukamarket' ),
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

        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__( 'Title', 'dukamarket' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'dukamarket' ),
                'name'     => 'title_typography',
                'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .widget-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'dukamarket' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'     => esc_html__( 'Margin', 'dukamarket' ),
                'type'      => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'margin-bottom: {{VALUE}}px;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'item_section',
            [
                'label' => esc_html__( 'Item', 'dukamarket' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'dukamarket' ),
                'name'     => 'item_typography',
                'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ovic-custommenu',
            ]
        );

        $this->add_control(
            'item_color',
            [
                'label'     => esc_html__( 'Color', 'dukamarket' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ovic-custommenu' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_space',
            [
                'label'     => esc_html__( 'Item Space', 'dukamarket' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'selectors' => [
                    '{{WRAPPER}} .ovic-custommenu' => '--item-space: {{VALUE}}px;',
                ],
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