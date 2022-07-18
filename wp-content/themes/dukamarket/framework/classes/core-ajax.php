<?php
/**
 * Define a constant if it is not already defined.
 *
 * @param  string $name Constant name.
 * @param  string $value Value.
 *
 * @since 3.0.0
 *
 */
if ( !function_exists( 'dukamarket_maybe_define_constant' ) ) {
    function dukamarket_maybe_define_constant( $name, $value )
    {
        if ( !defined( $name ) ) {
            define( $name, $value );
        }
    }
}

/**
 * Wrapper for nocache_headers which also disables page caching.
 *
 * @since 3.2.4
 */
if ( !function_exists( 'dukamarket_nocache_headers' ) ) {
    function dukamarket_nocache_headers()
    {
        DukaMarket_Ajax::set_nocache_constants();
        nocache_headers();
    }
}

if ( !class_exists( 'DukaMarket_Ajax' ) ) {
    class DukaMarket_Ajax
    {
        /**
         * Hook in ajax handlers.
         */
        public static function init()
        {
            add_action( 'init', array( __CLASS__, 'define_ajax' ), 0 );
            add_action( 'template_redirect', array( __CLASS__, 'do_dukamarket_ajax' ), 0 );
            add_action( 'after_setup_theme', array( __CLASS__, 'add_ajax_events' ) );
        }

        /**
         * Get OVIC Ajax Endpoint.
         *
         * @param  string $request Optional.
         *
         * @return string
         */
        public static function get_endpoint( $request = '' )
        {
            return esc_url_raw( apply_filters( 'dukamarket_ajax_get_endpoint',
                    add_query_arg(
                        'dukamarket-ajax',
                        $request,
                        remove_query_arg(
                            array(),
                            home_url( '/', 'relative' )
                        )
                    ),
                    $request
                )
            );
        }

        /**
         * Set constants to prevent caching by some plugins.
         *
         * @param  mixed $return Value to return. Previously hooked into a filter.
         *
         * @return mixed
         */
        public static function set_nocache_constants( $return = true )
        {
            dukamarket_maybe_define_constant( 'DONOTCACHEPAGE', true );
            dukamarket_maybe_define_constant( 'DONOTCACHEOBJECT', true );
            dukamarket_maybe_define_constant( 'DONOTCACHEDB', true );

            return $return;
        }

        /**
         * Set OVIC AJAX constant and headers.
         */
        public static function define_ajax()
        {
            // phpcs:disable
            if ( !empty( $_GET['dukamarket-ajax'] ) ) {
                dukamarket_maybe_define_constant( 'DOING_AJAX', true );
                dukamarket_maybe_define_constant( 'OVIC_DOING_AJAX', true );
                $GLOBALS['wpdb']->hide_errors();
            }
            // phpcs:enable
        }

        /**
         * Send headers for OVIC Ajax Requests.
         *
         * @since 2.5.0
         */
        private static function dukamarket_ajax_headers()
        {
            if ( !headers_sent() ) {
                send_origin_headers();
                send_nosniff_header();
                dukamarket_nocache_headers();
                header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
                header( 'X-Robots-Tag: noindex' );
                status_header( 200 );
            }
        }

        /**
         * Check for OVIC Ajax request and fire action.
         */
        public static function do_dukamarket_ajax()
        {
            global $wp_query;
            if ( !empty( $_GET['dukamarket-ajax'] ) ) {
                $wp_query->set( 'dukamarket-ajax', sanitize_text_field( wp_unslash( $_GET['dukamarket-ajax'] ) ) );
            }
            if ( !empty( $_GET['dukamarket_raw_content'] ) ) {
                $wp_query->set( 'dukamarket_raw_content', sanitize_text_field( wp_unslash( $_GET['dukamarket_raw_content'] ) ) );
            }
            $action  = $wp_query->get( 'dukamarket-ajax' );
            $content = $wp_query->get( 'dukamarket_raw_content' );
            if ( $action || $content ) {
                self::dukamarket_ajax_headers();
                if ( $action ) {
                    $action = sanitize_text_field( $action );
                    do_action( 'dukamarket_ajax_' . $action );
                    wp_die();
                } else {
                    remove_all_actions( 'wp_head' );
                    remove_all_actions( 'wp_footer' );
                }
            }
        }

        /**
         * Hook in methods - uses WordPress ajax handlers (admin-ajax).
         */
        public static function add_ajax_events()
        {
            // dukamarket_EVENT => nopriv.
            $ajax_events = array(
                'content_ajax_tabs'     => true,
                'product_load_more'     => true,
                'update_wishlist_count' => true,
                'create_qr_code'        => true,
                'delete_transients'     => false,
            );
            $ajax_events = apply_filters( 'dukamarket_ajax_event_register', $ajax_events );
            foreach ( $ajax_events as $ajax_event => $nopriv ) {
                add_action( 'wp_ajax_dukamarket_' . $ajax_event, array( __CLASS__, $ajax_event ) );
                if ( $nopriv ) {
                    add_action( 'wp_ajax_nopriv_dukamarket_' . $ajax_event, array( __CLASS__, $ajax_event ) );
                    // OVIC AJAX can be used for frontend ajax requests.
                    add_action( 'dukamarket_ajax_' . $ajax_event, array( __CLASS__, $ajax_event ) );
                }
            }
        }

        public static function create_qr_code()
        {
            check_ajax_referer( 'dukamarket_ajax_frontend', 'security' );

            $size = '300x300';
            $data = !empty( $_POST['data'] ) ? $_POST['data'] : home_url( '/' );

            wp_send_json_success( add_query_arg(
                array(
                    'chs' => $size,
                    'cht' => 'qr',
                    'chl' => $data,
                ),
                'https://chart.googleapis.com/chart'
            ) );

            wp_die();
        }

        public static function content_ajax_tabs()
        {
            check_ajax_referer( 'dukamarket_ajax_frontend', 'security' );

            if ( !empty( $_POST['section'] ) ) {
                foreach ( $_POST['section'] as $tag => $atts ) {
                    if ( !is_array( $atts ) ) {
                        if ( class_exists( 'Elementor\Plugin' ) ) {
                            echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $atts, true );
                        } else {
                            $post_id = get_post( $atts );
                            $content = $post_id->post_content;
                            $content = apply_filters( 'the_content', $content );
                            $content = str_replace( ']]>', ']]>', $content );
                            echo wp_specialchars_decode( $content );
                        }
                    } else {
                        echo dukamarket_do_shortcode( $tag, $atts );
                    }
                }
            }
            wp_die();
        }

        /**
         * Deletes all transients.
         *
         * @echo int  Number of deleted transient DB entries
         */
        public static function delete_transients()
        {
            global $wpdb;

            $count = $wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '\_transient\_%' OR option_name LIKE '\_site\_transient\_%'" );

            do_action( 'ovic_delete_transients', $count );

            echo absint( $count );

            wp_die();
        }

        public static function update_wishlist_count()
        {
            if ( function_exists( 'YITH_WCWL' ) ) {
                wp_send_json( YITH_WCWL()->count_products() );
            }
            wp_die();
        }

        public static function product_load_more()
        {
            check_ajax_referer( 'dukamarket_ajax_frontend', 'security' );

            $data   = isset( $_POST['data'] ) ? wp_unslash( $_POST['data'] ) : array();
            $class  = isset( $data['class'] ) ? $data['class'] : array();
            $style  = isset( $data['style'] ) ? $data['style'] : 'style-01';
            $args   = isset( $data['args'] ) ? $data['args'] : array();
            $target = isset( $data['target'] ) ? $data['target'] : '';
            list( $width, $height ) = isset( $data['size_thumb'] ) ? $data['size_thumb'] : array( 300, 300 );

            add_filter( 'woocommerce_product_loop_start',
                function () use ( $width, $height, $class, $style ) {
                    dukamarket_woocommerce_setup_loop(
                        array(
                            'width'  => $width,
                            'height' => $height,
                            'class'  => $class,
                            'style'  => $style,
                        )
                    );

                    return '<ul class="products">';
                }
            );
            add_filter( 'woocommerce_product_loop_end', function () {
                return '</ul>';
            } );

            if ( !empty( $target ) ) {
                echo dukamarket_do_shortcode(
                    $target,
                    dukamarket_shortcode_products_query( $args )
                );
            }
            wp_die();
        }
    }

    DukaMarket_Ajax::init();
}