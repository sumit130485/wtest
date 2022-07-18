<?php if (!defined('ABSPATH')) {
    die;
} // Cannot access pages directly.
/**
 *
 * Customize Class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if (!class_exists('OVIC_Customize')) {
    class OVIC_Customize extends OVIC_Abstract
    {
        // constants
        public $priority = 1;
        public $unique   = '';
        public $options  = array();
        public $abstract = 'customize';
        // default args
        public $args = array(
            // typography options
            'enqueue_webfont' => true,
            'async_webfont'   => false,
            // others
            'output_css'      => true,
        );

        // run customize construct
        public function __construct($options, $option_name)
        {
            // Get options customize
            $this->unique  = apply_filters("ovic_customize_name_options", $option_name);
            $this->args    = apply_filters("ovic_customize_{$this->unique}_settings", $this->args, $this);
            $this->options = apply_filters("ovic_customize_{$this->unique}_options", $options);

            // Actions customize
            add_action('customize_register', array(&$this, 'add_customize_options'));
            add_action('customize_controls_enqueue_scripts', array(&$this, 'enqueue_field_scripts'), 30);

            // wp enqueue for typography and output css
            parent::__construct();
        }

        // instance
        public static function instance($options, $option_name)
        {
            return new self($options, $option_name);
        }

        public function add_customize_options($wp_customize)
        {
            // load extra WP_Customize_Control
            OVIC::include_plugin_file('functions/customize.php');
            $panel_priority = 1;

            foreach ($this->options as $value) {
                $this->priority = $panel_priority;
                if (isset($value['sections'])) {
                    $unique_id = $this->unique.'-'.sanitize_title($value['name']);
                    $wp_customize->add_panel(new WP_Customize_Panel_OVIC($wp_customize, $unique_id,
                            array(
                                'title'       => $value['title'],
                                'priority'    => (isset($value['priority'])) ? $value['priority'] : $panel_priority,
                                'description' => (isset($value['description'])) ? $value['description'] : '',
                            )
                        )
                    );
                    $this->add_section($wp_customize, $value, $unique_id);
                } else {
                    $this->add_section($wp_customize, $value);
                }
                $panel_priority++;
            }
        }

        // add customize section
        public function add_section($wp_customize, $value, $panel = false)
        {
            $priority = ($panel) ? 1 : $this->priority;
            $sections = ($panel) ? $value['sections'] : array('sections' => $value);
            foreach ($sections as $section) {
                $section_name = !empty($section['name']) ? $section['name'] : $section['title'];
                $section_name = sanitize_title($section_name);
                $section_id   = $this->unique.'-'.$section_name;
                $wp_customize->add_section(new WP_Customize_Section_OVIC($wp_customize, $section_id, array(
                            'title'       => $section['title'],
                            'priority'    => (isset($section['priority'])) ? $section['priority'] : $priority,
                            'description' => (isset($section['description'])) ? $section['description'] : '',
                            'panel'       => ($panel) ? $panel : '',
                        )
                    )
                );
                $field_priority = 1;
                if (!empty($section['fields'])) {
                    foreach ($section['fields'] as $field) {
                        $field_id        = (isset($field['id'])) ? $field['id'] : sanitize_title('-nonce-'.$section_name.'-'.$field_priority);
                        $setting_id      = $this->unique.'['.$field_id.']';
                        $setting_args    = (isset($field['setting_args'])) ? $field['setting_args'] : array();
                        $control_args    = (isset($field['control_args'])) ? $field['control_args'] : array();
                        $field_default   = (isset($field['default'])) ? $field['default'] : '';
                        $field_sanitize  = (isset($field['sanitize'])) ? $field['sanitize'] : '';
                        $field_validate  = (isset($field['validate'])) ? $field['validate'] : '';
                        $field_transport = (isset($field['transport'])) ? $field['transport'] : 'refresh';
                        $wp_customize->add_setting($setting_id,
                            wp_parse_args($setting_args, array(
                                    'default'           => $field_default,
                                    'type'              => 'option',
                                    'transport'         => $field_transport,
                                    'capability'        => 'edit_theme_options',
                                    'sanitize_callback' => $field_sanitize,
                                    'validate_callback' => $field_validate,
                                )
                            )
                        );
                        $wp_customize->add_control(new WP_Customize_Control_OVIC($wp_customize, $setting_id,
                                wp_parse_args($control_args, array(
                                        'unique'   => $this->unique,
                                        'field'    => $field,
                                        'section'  => $section_id,
                                        'settings' => $setting_id,
                                        'priority' => $field_priority,
                                    )
                                )
                            )
                        );
                        if (isset($field['selective_refresh']) && isset($wp_customize->selective_refresh)) {
                            $wp_customize->selective_refresh->add_partial($setting_id, $field['selective_refresh']);
                        }
                        $field_priority++;
                    }
                }
                $priority++;
            }
        }
    }
}
