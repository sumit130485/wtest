<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Person"
 * @version 1.0.0
 */
class Shortcode_Ovic_Person extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode = 'ovic_person';
    public $default   = array(
        'style' => 'style-01',
    );

    public function content( $atts, $content = null )
    {
        $css_class = $this->main_class( $atts, array(
            'ovic-person',
            $atts['style']
        ) );
        if ( !is_array( $atts['link'] ) ) {
            $atts['link'] = array(
                'url' => $atts['link'],
            );
        }
        if ( !is_array( $atts['avatar'] ) ) {
            $atts['avatar'] = array(
                'id' => $atts['avatar'],
            );
        }
        if ( !is_array( $atts['signature'] ) ) {
            $atts['signature'] = array(
                'id' => $atts['signature'],
            );
        }
        $atts['link']['url'] = apply_filters( 'ovic_shortcode_vc_link', $atts['link']['url'] );
        $link                = $this->add_link_attributes( $atts['link'], true );

        ob_start();
        ?>
        <div class="<?php echo esc_attr( $css_class ); ?>">
            <div class="inner">
                <?php if ( !empty( $atts['avatar']['id'] ) ): ?>
                    <div class="avatar">
                        <a <?php echo esc_attr( $link ); ?>><?php echo wp_get_attachment_image( $atts['avatar']['id'], 'full' ); ?></a>
                    </div>
                <?php endif; ?>
                <div class="content">
                    <?php if ( !empty( $atts['name'] ) ): ?>
                        <p class="name"><a <?php echo esc_attr( $link ); ?>><?php echo esc_html( $atts['name'] ); ?></a></p>
                    <?php endif; ?>
                    <?php if ( !empty( $atts['position'] ) ): ?>
                        <p class="posi"><?php echo esc_html( $atts['position'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( !empty( $atts['desc'] ) ): ?>
                        <p class="desc"><?php echo esc_html( $atts['desc'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( !empty( $atts['signature']['id'] ) ): ?>
                        <div class="signature"><?php echo wp_get_attachment_image( $atts['signature']['id'], 'full' ); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}