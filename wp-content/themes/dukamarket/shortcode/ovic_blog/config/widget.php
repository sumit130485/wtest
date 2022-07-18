<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( !class_exists( 'Widget_Ovic_Blog' ) ) {
    class Widget_Ovic_Blog extends OVIC_Widget
    {
        /**
         * Constructor.
         */
        public function __construct()
        {
            $this->widget_cssclass    = 'ovic-blog';
            $this->widget_description = 'Display the customer blog.';
            $this->widget_id          = 'ovic_blog';
            $this->widget_name        = esc_html__( 'Ovic: Blog', 'dukamarket' );
            $this->settings           = array(
                'title'    => array(
                    'type'  => 'text',
                    'title' => esc_html__( 'Title', 'dukamarket' ),
                ),
                'style'    => array(
                    'type'    => 'select_preview',
                    'title'   => esc_html__( 'Select style', 'dukamarket' ),
                    'options' => dukamarket_file_options( '/shortcode/ovic_blog/layout/', '' ),
                    'default' => 'style-01',
                ),
                'target'   => array(
                    'type'       => 'select',
                    'title'      => esc_html__( 'Target', 'dukamarket' ),
                    'options'    => array(
                        'recent_post' => esc_html__( 'Recent post', 'dukamarket' ),
                        'popularity'  => esc_html__( 'Popularity', 'dukamarket' ),
                        'date'        => esc_html__( 'Date', 'dukamarket' ),
                        'title'       => esc_html__( 'Title', 'dukamarket' ),
                        'random'      => esc_html__( 'Random', 'dukamarket' ),
                    ),
                    'attributes' => array(
                        'data-depend-id' => 'target',
                        'style'          => 'width:100%',
                    ),
                    'default'    => 'recent_post',
                ),
                'category' => array(
                    'type'           => 'select',
                    'title'          => esc_html__( 'Category Blog', 'dukamarket' ),
                    'options'        => 'categories',
                    'chosen'         => true,
                    'query_args'     => array(
                        'orderby' => 'name',
                        'order'   => 'ASC',
                    ),
                    'default_option' => esc_html__( 'Select a category', 'dukamarket' ),
                    'placeholder'    => esc_html__( 'Select a category', 'dukamarket' ),
                ),
                'limit'    => array(
                    'type'        => 'number',
                    'unit'        => 'items(s)',
                    'default'     => '6',
                    'title'       => esc_html__( 'Limit', 'dukamarket' ),
                    'description' => esc_html__( 'How much items per page to show', 'dukamarket' ),
                ),
                'orderby'  => array(
                    'type'        => 'select',
                    'title'       => esc_html__( 'Order by', 'dukamarket' ),
                    'options'     => array(
                        ''              => esc_html__( 'None', 'dukamarket' ),
                        'date'          => esc_html__( 'Date', 'dukamarket' ),
                        'ID'            => esc_html__( 'ID', 'dukamarket' ),
                        'author'        => esc_html__( 'Author', 'dukamarket' ),
                        'title'         => esc_html__( 'Title', 'dukamarket' ),
                        'modified'      => esc_html__( 'Modified', 'dukamarket' ),
                        'rand'          => esc_html__( 'Random', 'dukamarket' ),
                        'comment_count' => esc_html__( 'Comment count', 'dukamarket' ),
                        'menu_order'    => esc_html__( 'Menu order', 'dukamarket' ),
                    ),
                    'attributes'  => array(
                        'style' => 'width:100%',
                    ),
                    'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.',
                        'dukamarket' ),
                        '<a href="' . esc_url( 'http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters' ) . '" target="_blank">' . esc_html__( 'WordPress codex page',
                            'dukamarket' ) . '</a>' ),
                ),
                'order'    => array(
                    'type'        => 'select',
                    'title'       => esc_html__( 'Sort order', 'dukamarket' ),
                    'options'     => array(
                        ''     => esc_html__( 'None', 'dukamarket' ),
                        'DESC' => esc_html__( 'Descending', 'dukamarket' ),
                        'ASC'  => esc_html__( 'Ascending', 'dukamarket' ),
                    ),
                    'attributes'  => array(
                        'style' => 'width:100%',
                    ),
                    'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.',
                        'dukamarket' ),
                        '<a href="' . esc_url( 'http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters' ) . '" target="_blank">' . esc_html__( 'WordPress codex page',
                            'dukamarket' ) . '</a>' ),
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
            $atts                 = $instance;
            $atts['title']        = '';
            $atts['carousel']     = array(
                'slidesToShow' => 1,
                'slidesMargin' => 15,
                'arrows'       => true,
                'infinite'     => true,
            );
            $atts['image_width']  = 240;
            $atts['image_height'] = 240;
            if ( $atts['style'] == 'style-04' ) {
                $atts['list_style']   = 'none';
                $atts['carousel']     = '';
                $atts['image_width']  = 75;
                $atts['image_height'] = 75;
            }

            $this->widget_start( $args, $instance );

            unset( $instance['title'] );

            echo ovic_do_shortcode( 'ovic_blog', $atts );

            $this->widget_end( $args );
        }
    }
}