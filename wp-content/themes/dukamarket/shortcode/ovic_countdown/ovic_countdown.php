<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Countdown"
 * @version 1.0.0
 */
class Shortcode_Ovic_Countdown extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode = 'ovic_countdown';
    public $default   = array(
        'style' => 'style-01',
    );

    public function content( $atts, $content = null )
    {
        $css_class    = $this->main_class( $atts, array(
            'ovic-countdown',
            $atts['style']
        ) );
        $atts['date'] = apply_filters( 'ovic_change_datetime_countdown', $atts['date'], 0 );
        ob_start();
        ?>
        <div class="<?php echo esc_attr( $css_class ); ?>">
            <?php if ( !empty( $atts['date'] ) ):
                $params = array(
                    'days_text' => !empty( $atts['days_text'] ) ? $atts['days_text'] : esc_html__( 'Days', 'dukamarket' ),
                    'hrs_text'  => !empty( $atts['hrs_text'] ) ? $atts['hrs_text'] : esc_html__( 'Hours', 'dukamarket' ),
                    'mins_text' => !empty( $atts['mins_text'] ) ? $atts['mins_text'] : esc_html__( 'Mins', 'dukamarket' ),
                    'secs_text' => !empty( $atts['secs_text'] ) ? $atts['secs_text'] : esc_html__( 'Secs', 'dukamarket' ),
                );
                wp_enqueue_script( 'dukamarket-countdown' );
                ?>
                <div class="dukamarket-countdown"
                     data-datetime="<?php echo esc_attr( $atts['date'] ); ?>"
                     data-params="<?php echo esc_attr( wp_json_encode( $params ) ) ?>">
                </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}