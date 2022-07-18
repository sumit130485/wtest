<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( !class_exists( 'Widget_Ovic_Person' ) ) {
    class Widget_Ovic_Person extends OVIC_Widget
    {
        /**
         * Constructor.
         */
        public function __construct()
        {
            $this->widget_cssclass = 'ovic-person';
            $this->widget_id       = 'ovic_person';
            $this->widget_name     = esc_html__( 'Ovic: Person', 'dukamarket' );
            $this->settings        = array(
                'title'     => array(
                    'type'  => 'text',
                    'title' => esc_html__( 'Title', 'dukamarket' ),
                ),
                'style'     => array(
                    'type'    => 'select_preview',
                    'title'   => esc_html__( 'Select style', 'dukamarket' ),
                    'options' => array(
                        'style-01' => array(
                            'title'   => esc_html__( 'Style 01', 'dukamarket' ),
                            'preview' => get_theme_file_uri( 'shortcode/ovic_person/layout/style-01.jpg' ),
                        ),
                    ),
                    'default' => 'style-01',
                ),
                'avatar'    => array(
                    'type'  => 'image',
                    'title' => esc_html__( 'Avatar', 'dukamarket' ),
                ),
                'name'      => array(
                    'type'  => 'text',
                    'title' => esc_html__( 'Name', 'dukamarket' ),
                ),
                'desc'      => array(
                    'type'  => 'text',
                    'title' => esc_html__( 'Description', 'dukamarket' ),
                ),
                'signature' => array(
                    'type'  => 'image',
                    'title' => esc_html__( 'Signature', 'dukamarket' ),
                ),
                'link'      => array(
                    'type'  => 'text',
                    'title' => esc_html__( 'Link', 'dukamarket' ),
                ),
            );

            parent::__construct();
        }

        /**
         * Output widget.
         *
         * @param  array $args
         * @param  array $instance
         *
         * @see WP_Widget
         *
         */
        public function widget( $args, $instance )
        {
            $atts          = $instance;
            $atts['title'] = '';

            $this->widget_start( $args, $instance );

            unset( $instance['title'] );

            echo ovic_do_shortcode( 'ovic_person', $atts );

            $this->widget_end( $args );
        }
    }
}