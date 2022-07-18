<?php
/**
 * Template Popup Newsletter
 *
 * @return string
 */
?>
<?php
$effect      = dukamarket_get_option( 'popup_effect' );
$bg          = dukamarket_get_option( 'popup_bg' );
$img         = dukamarket_get_option( 'popup_img' );
$text_1      = dukamarket_get_option( 'popup_text_1' );
$text_2      = dukamarket_get_option( 'popup_text_2' );
$text_3      = dukamarket_get_option( 'popup_text_3' );
$text_4      = dukamarket_get_option( 'popup_text_4' );
$placeholder = dukamarket_get_option( 'input_placeholder' );
$button      = dukamarket_get_option( 'popup_button' );
$delay       = dukamarket_get_option( 'popup_delay' );
if ( !empty( $bg ) ) {
    $style = 'background-image: url(' . wp_get_attachment_image_url( $bg, 'full' ) . ' );';
} else {
    $style = '';
}
?>
<div id="dukamarket-popup-newsletter" class="dukamarket-popup-newsletter white-popup mfp-with-anim mfp-hide" data-effect="<?php echo esc_attr( $effect ); ?>" data-delay="<?php echo esc_attr( $delay ); ?>">
    <div class="popup-inner" style="<?php echo esc_attr( $style ); ?>">
        <?php if ( $img ): ?>
            <figure class="image"><?php echo wp_get_attachment_image( $img, 'full' ); ?></figure>
        <?php endif; ?>
        <?php if ( $text_1 ) : ?>
            <p class="text-1"><?php echo esc_html( $text_1 ); ?></p>
        <?php endif; ?>
        <?php if ( $text_2 ) : ?>
            <h2 class="text-2"><?php echo esc_html( $text_2 ); ?></h2>
        <?php endif; ?>
        <?php if ( $text_3 ) : ?>
            <p class="text-3"><?php echo esc_html( $text_3 ); ?></p>
        <?php endif; ?>
        <?php echo dukamarket_do_shortcode( 'ovic_newsletter',
            array(
                'title'       => '',
                'subtitle'    => '',
                'desc'        => '',
                'style'       => 'style-03',
                'placeholder' => $placeholder,
                'button'      => $button,
            )
        ); ?>
        <?php if ( $text_4 ) : ?>
            <p class="text-4"><a href="#" class="mfp-close"><?php echo esc_html( $text_4 ); ?></a></p>
        <?php endif; ?>
        <label for="dukamarket_disabled_popup_by_user" class="dukamarket_disabled_popup_by_user disabled_popup">
            <input id="dukamarket_disabled_popup_by_user" name="dukamarket_disabled_popup_by_user" type="checkbox">
            <span></span>
            <?php echo esc_html__( 'Do not show this popup again', 'dukamarket' ); ?>
        </label>
        <button title="Close (Esc)" type="button" class="mfp-close">×</button>
    </div>
</div>