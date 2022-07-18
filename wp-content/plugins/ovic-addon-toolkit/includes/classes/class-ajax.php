<?php
/**
 * Define a constant if it is not already defined.
 *
 * @param  string  $name  Constant name.
 * @param  string  $value  Value.
 *
 * @since 3.0.0
 */
if (!function_exists('ovic_maybe_define_constant')) {
    function ovic_maybe_define_constant($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }
}
/**
 * Wrapper for nocache_headers which also disables page caching.
 *
 * @since 3.2.4
 */
if (!function_exists('ovic_nocache_headers')) {
    function ovic_nocache_headers()
    {
        OVIC_AJAX::set_nocache_constants();
        nocache_headers();
    }
}
if (!class_exists('OVIC_AJAX')) {
    class OVIC_AJAX
    {
        /**
         * Hook in ajax handlers.
         */
        public static function init()
        {
            add_action('init', array(__CLASS__, 'define_ajax'), 0);
            add_action('template_redirect', array(__CLASS__, 'do_ovic_ajax'), 0);
            add_action('after_setup_theme', array(__CLASS__, 'add_ajax_events'));
        }

        /**
         * Get OVIC Ajax Endpoint.
         *
         * @param  string  $request  Optional.
         *
         * @return string
         */
        public static function get_endpoint($request = '')
        {
            return esc_url_raw(apply_filters('ovic_ajax_get_endpoint',
                    add_query_arg(
                        'ovic-ajax',
                        $request,
                        remove_query_arg(
                            array(),
                            home_url('/', 'relative')
                        )
                    ),
                    $request
                )
            );
        }

        /**
         * Set constants to prevent caching by some plugins.
         *
         * @param  mixed  $return  Value to return. Previously hooked into a filter.
         *
         * @return mixed
         */
        public static function set_nocache_constants($return = true)
        {
            ovic_maybe_define_constant('DONOTCACHEPAGE', true);
            ovic_maybe_define_constant('DONOTCACHEOBJECT', true);
            ovic_maybe_define_constant('DONOTCACHEDB', true);

            return $return;
        }

        /**
         * Set OVIC AJAX constant and headers.
         */
        public static function define_ajax()
        {
            if (!empty($_GET['ovic-ajax'])) {
                ovic_maybe_define_constant('DOING_AJAX', true);
                ovic_maybe_define_constant('OVIC_DOING_AJAX', true);
                if (!WP_DEBUG || (WP_DEBUG && !WP_DEBUG_DISPLAY)) {
                    @ini_set('display_errors', 0); // Turn off display_errors during AJAX events to prevent malformed JSON.
                }
                $GLOBALS['wpdb']->hide_errors();
                if (!defined('SHORTINIT')) {
                    define('SHORTINIT', true);
                }
            }
        }

        /**
         * Send headers for OVIC Ajax Requests.
         *
         * @since 2.5.0
         */
        private static function ovic_ajax_headers()
        {
            if (!headers_sent()) {
                send_origin_headers();
                send_nosniff_header();
                ovic_nocache_headers();
                header('Content-Type: text/html; charset='.get_option('blog_charset'));
                header('X-Robots-Tag: noindex');
                status_header(200);
            } elseif (class_exists('Automattic\Jetpack\Constants') && Automattic\Jetpack\Constants::is_true('WP_DEBUG')) {
                headers_sent($file, $line);
                trigger_error("ovic_ajax_headers cannot set headers - headers already sent by {$file} on line {$line}", E_USER_NOTICE); // @codingStandardsIgnoreLine
            }
        }

        /**
         * Check for OVIC Ajax request and fire action.
         */
        public static function do_ovic_ajax()
        {
            global $wp_query;

            // phpcs:disable WordPress.Security.NonceVerification.Recommended
            if (!empty($_GET['ovic-ajax'])) {
                $wp_query->set('ovic-ajax', sanitize_text_field(wp_unslash($_GET['ovic-ajax'])));
            }
            // phpcs:disable WordPress.Security.NonceVerification.Recommended
            if (!empty($_GET['ovic_raw_content'])) {
                $wp_query->set('ovic_raw_content', sanitize_text_field(wp_unslash($_GET['ovic_raw_content'])));
            }

            $action  = $wp_query->get('ovic-ajax');
            $content = $wp_query->get('ovic_raw_content');

            if ($action || $content) {
                self::ovic_ajax_headers();
                if ($action) {
                    $action = sanitize_text_field($action);
                    do_action('ovic_ajax_'.$action);
                    wp_die();
                } else {
                    remove_all_actions('wp_head');
                    remove_all_actions('wp_footer');
                    do_action('ovic_ajax_raw_content');
                }
            }
        }

        /**
         * Hook in methods - uses WordPress ajax handlers (admin-ajax).
         */
        public static function add_ajax_events()
        {
            // ovic_EVENT => nopriv.
            $ajax_events = array(
                'add_to_cart_single' => true,
                'clear_cache'        => false,
            );
            $ajax_events = apply_filters('ovic_ajax_event_register', $ajax_events);
            if (!empty($ajax_events)) {
                foreach ($ajax_events as $ajax_event => $nopriv) {
                    add_action('wp_ajax_ovic_'.$ajax_event, array(__CLASS__, $ajax_event));
                    if ($nopriv) {
                        add_action('wp_ajax_nopriv_ovic_'.$ajax_event, array(__CLASS__, $ajax_event));
                        // OVIC AJAX can be used for frontend ajax requests.
                        add_action('ovic_ajax_'.$ajax_event, array(__CLASS__, $ajax_event));
                    }
                }
            }
        }

        /**
         * Deletes all cache.
         *
         * @echo int  Number of deleted transient DB entries
         */
        public static function clear_cache()
        {
            global $wpdb;

            $count = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '\_transient\_%' OR option_name LIKE '\_site\_transient\_%'");

//            delete_expired_transients(true);

            wp_cache_flush();

            wp_send_json_success(absint($count));

            wp_die();
        }

        public static function add_to_cart_single()
        {

            $product_id = !empty($_POST['product_id']) ? apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id'])) : 0;

            if (isset($_POST['add-to-cart'])) {
                $product_id = absint($_POST['add-to-cart']);
            }

            // phpcs:disable WordPress.Security.NonceVerification.Missing
            if (empty($product_id)) {
                return;
            }

            $product           = wc_get_product($product_id);
            $quantity          = empty($_POST['quantity']) ? 1 : wc_stock_amount(wp_unslash($_POST['quantity']));
            $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
            $product_status    = get_post_status($product_id);
            $variation_id      = isset($_POST['variation_id']) ? absint($_POST['variation_id']) : 0;
            $variation         = array();

            if ($product && 'variation' === $product->get_type()) {
                $variation_id = $product_id;
                $product_id   = $product->get_parent_id();
                $variation    = $product->get_variation_attributes();
            }

            if ($product && $passed_validation && 'publish' === $product_status) {

                if ('variation' === $product->get_type() && $variation_id > 0 && $product_id > 0) {

                    WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation);

                } elseif (is_array($quantity) && !empty($quantity) && 'group' === $product->get_type()) {

                    foreach ($quantity as $product_id => $qty) {
                        if ($qty > 0) {
                            WC()->cart->add_to_cart($product_id, $qty);
                        }
                    }

                } elseif (!is_array($quantity) && is_numeric($quantity) && 'simple' === $product->get_type()) {

                    WC()->cart->add_to_cart($product_id, $quantity);

                }

                do_action('woocommerce_ajax_added_to_cart', $product_id);

                if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
                    wc_add_to_cart_message(array($product_id => $quantity), true);
                }

                wc_clear_notices();

                // Return fragments
                WC_AJAX::get_refreshed_fragments();

            } else {

                // If there was an error adding to the cart, redirect to the product page to show any errors
                $data = array(
                    'error'       => true,
                    'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id),
                );

                wp_send_json($data);

            }
            wp_die();
        }
    }

    OVIC_AJAX::init();
}