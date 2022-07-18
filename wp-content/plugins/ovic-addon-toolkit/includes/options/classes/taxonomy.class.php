<?php if (!defined('ABSPATH')) {
    die;
} // Cannot access pages directly.
/**
 *
 * Taxonomy Class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if (!class_exists('OVIC_Taxonomy')) {
    class OVIC_Taxonomy extends OVIC_Abstract
    {
        // constants
        public $options  = array();
        public $errors   = array();
        public $abstract = 'taxonomy';

        // run taxonomy construct
        public function __construct($options)
        {
            // Get options taxonomy
            $this->options = apply_filters('ovic_options_taxonomy', $options);

            // Actions taxonomy
            add_action('admin_init', array(&$this, 'add_taxonomy_fields'));

            // wp enqueue for typography and output css
            parent::__construct();
        }

        // instance
        public static function instance($options = array())
        {
            return new self($options);
        }

        // add taxonomy add/edit fields
        public function add_taxonomy_fields()
        {
            foreach ($this->options as $option) {
                $opt_taxonomy = $option['taxonomy'];
                $get_taxonomy = ovic_get_var('taxonomy');
                if ($get_taxonomy == $opt_taxonomy) {
                    add_action($opt_taxonomy.'_add_form_fields', array(&$this, 'render_taxonomy_form_fields'));
                    add_action($opt_taxonomy.'_edit_form', array(&$this, 'render_taxonomy_form_fields'));

                    add_action('created_'.$opt_taxonomy, array(&$this, 'save_taxonomy'));
                    add_action('edited_'.$opt_taxonomy, array(&$this, 'save_taxonomy'));
                    add_action('delete_'.$opt_taxonomy, array(&$this, 'delete_taxonomy'));
                }
            }
        }

        // render taxonomy add/edit form fields
        public function render_taxonomy_form_fields($term)
        {
            $value     = '';
            $form_edit = (is_object($term) && isset($term->taxonomy)) ? true : false;
            $taxonomy  = ($form_edit) ? $term->taxonomy : $term;
            $classname = ($form_edit) ? 'edit' : 'add';

            wp_nonce_field('ovic-taxonomy', 'ovic-taxonomy-nonce');

            do_action('ovic_html_taxonomy_before');

            echo '<div class="ovic ovic-taxonomy ovic-taxonomy-'.$classname.'-fields ovic-onload">';

            foreach ($this->options as $option) {
                if ($taxonomy == $option['taxonomy']) {
                    if ($form_edit) {
                        $value        = get_term_meta($term->term_id, $option['id'], true);
                        $timenow      = round(microtime(true));
                        $expires      = (isset($value['_transient']['expires'])) ? $value['_transient']['expires'] : 0;
                        $errors       = (isset($value['_transient']['errors'])) ? $value['_transient']['errors'] : array();
                        $timein       = ovic_timeout($timenow, $expires, 30);
                        $this->errors = ($timein) ? $errors : array();
                    }
                    foreach ($option['fields'] as $field) {
                        $is_field_error = $this->error_check($field);
                        if (!empty($is_field_error)) {
                            $field['_error'] = $is_field_error;
                        }
                        $default    = (isset($field['default'])) ? $field['default'] : '';
                        $elem_id    = (isset($field['id'])) ? $field['id'] : '';
                        $elem_value = (is_array($value) && isset($value[$elem_id])) ? $value[$elem_id] : $default;
                        if (!empty($option['prefix'])) {
                            $elem_value = get_term_meta($term->term_id, "{$option['prefix']}{$elem_id}", true);
                            if (empty($elem_value)) {
                                $elem_value = $default;
                            }
                        }
                        echo OVIC::field($field, $elem_value, $option['id'], 'taxonomy');
                    }
                }
            }

            echo '</div>';

            do_action('ovic_html_taxonomy_after');
        }

        // save taxonomy form fields
        public function save_taxonomy($term_id)
        {
            if (wp_verify_nonce(ovic_get_var('ovic-taxonomy-nonce'), 'ovic-taxonomy')) {
                $errors   = array();
                $taxonomy = ovic_get_var('taxonomy');
                foreach ($this->options as $request_value) {
                    if ($taxonomy == $request_value['taxonomy']) {
                        $request_key = $request_value['id'];
                        $request     = ovic_get_var($request_key, array());
                        // ignore _nonce
                        if (isset($request['_nonce'])) {
                            unset($request['_nonce']);
                        }
                        // sanitize and validate
                        if (!empty($request_value['fields'])) {
                            foreach ($request_value['fields'] as $field) {
                                if (!empty($field['id'])) {
                                    // sanitize
                                    if (!empty($field['sanitize'])) {
                                        $sanitize = $field['sanitize'];
                                        if (function_exists($sanitize)) {
                                            $value_sanitize        = ovic_get_vars($request_key, $field['id']);
                                            $request[$field['id']] = call_user_func($sanitize, $value_sanitize);
                                        }
                                    }
                                    // validate
                                    if (!empty($field['validate'])) {
                                        $validate = $field['validate'];
                                        if (function_exists($validate)) {
                                            $value_validate = ovic_get_vars($request_key, $field['id']);
                                            $has_validated  = call_user_func($validate, $value_validate);
                                            if (!empty($has_validated)) {
                                                $meta_value            = get_term_meta($term_id, $request_key, true);
                                                $errors[$field['id']]  = array(
                                                    'code'    => $field['id'],
                                                    'message' => $has_validated,
                                                    'type'    => 'error'
                                                );
                                                $default_value         = isset($field['default']) ? $field['default'] : '';
                                                $request[$field['id']] = (isset($meta_value[$field['id']])) ? $meta_value[$field['id']] : $default_value;
                                            }
                                        }
                                    }
                                    // auto sanitize
                                    if (!isset($request[$field['id']]) || is_null($request[$field['id']])) {
                                        $request[$field['id']] = '';
                                    }
                                }
                            }
                        }
                        $request['_transient']['expires'] = round(microtime(true));
                        if (!empty($errors)) {
                            $request['_transient']['errors'] = $errors;
                        }
                        $request = apply_filters('ovic_save_taxonomy', $request, $request_key, $term_id);
                        if (empty($request)) {
                            if (!empty($request_value['prefix'])) {
                                foreach ($request as $key => $value) {
                                    if ($key != '_transient' && $key != '_restore' && $key != '_nonce') {
                                        delete_term_meta($term_id, "{$request_value['prefix']}{$key}", $value);
                                    }
                                }
                            }
                            delete_term_meta($term_id, $request_key);
                        } else {
                            if (!empty($request_value['prefix'])) {
                                foreach ($request as $key => $value) {
                                    if ($key != '_transient' && $key != '_restore' && $key != '_nonce') {
                                        unset($request[$key]);
                                        update_term_meta($term_id, "{$request_value['prefix']}{$key}", $value);
                                    }
                                }
                            }
                            update_term_meta($term_id, $request_key, $request);
                        }
                    }
                }
                set_transient('ovic-taxonomy-transient', $errors, 10);
            }
        }

        // delete taxonomy
        public function delete_taxonomy($term_id)
        {
            $taxonomy = ovic_get_var('taxonomy');
            if (!empty($taxonomy)) {
                foreach ($this->options as $request_value) {
                    if ($taxonomy == $request_value['taxonomy']) {
                        $request_key = $request_value['id'];
                        delete_term_meta($term_id, $request_key);
                    }
                }
            }
        }
    }
}
