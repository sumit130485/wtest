<?php
if ( ! defined('ABSPATH')) {
    die('-1');
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_360degree"
 * @version 1.0.0
 */
class Shortcode_Ovic_360degree extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode = 'ovic_360degree';

    public function content($atts, $content = null)
    {
        $css_class = $this->main_class($atts, array(
            'ovic-360degree',
        ));
        ob_start();
        ?>
        <div class="<?php echo esc_attr($css_class); ?>">
            <?php
            $images_string = array();
            $images        = is_array($atts['gallery_degree']) ? $atts['gallery_degree'] : explode(',', $atts['gallery_degree']);
            if ( ! empty($images) && count($images) > 0): ?>
                <?php
                $width  = $atts['width'];
                $height = $atts['height'];
                foreach ($images as $img_id) {
                    $image           = dukamarket_resize_image($img_id, $width, $height, true, true);
                    $images_string[] = $image['url'];
                }
                wp_enqueue_style($this->enqueue_name());
                wp_enqueue_script($this->enqueue_name());
                ?>
                <div class="ovic-threed-view"
                     data-images="<?php echo esc_attr(json_encode($images_string)); ?>"
                     data-width="<?php echo esc_attr($width); ?>"
                     data-height="<?php echo esc_attr($height); ?>">
                    <ol class="threed-view-images"></ol>
                    <div class="spinner">
                        <span>0%</span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}