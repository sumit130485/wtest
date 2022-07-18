<?php
$header_banner = dukamarket_theme_option_meta(
    '_custom_metabox_theme_options',
    'header_banner',
    'metabox_header_banner',
    ''
);
if (!empty($header_banner)):
    ?>
    <div class="header-banner">
        <div class="container">
            <?php
            if (class_exists('Elementor\Plugin') && Elementor\Plugin::$instance->db->is_built_with_elementor($header_banner)) {
                echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display($header_banner);
            } else {
                $post_id = get_post($header_banner);
                $content = $post_id->post_content;
                $content = apply_filters('the_content', $content);
                $content = str_replace(']]>', ']]>', $content);
                echo wp_specialchars_decode($content);
            }
            ?>
        </div>
    </div>
<?php endif;