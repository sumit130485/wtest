<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Running"
 * @version 1.0.0
 */
class Shortcode_Ovic_Running extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode = 'ovic_running';
    public $default   = array();

    public function content( $atts, $content = null )
    {
        $css_class = $this->main_class( $atts, array(
            'ovic-running'
        ) );

        ob_start();
        ?>
        <div class="<?php echo esc_attr( $css_class ); ?>">
            <div class="wrap">
                <div class="inner">
                    <?php foreach ( $atts['texts'] as $text ): ?>
                        <p class="item"><?php echo esc_html( $text['text'] ); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}