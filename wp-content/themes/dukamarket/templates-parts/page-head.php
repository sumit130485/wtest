<?php
$style    = '';
$bg_to    = dukamarket_get_option( 'page_head_bg' );
$bg       = dukamarket_theme_option_meta( '_custom_page_side_options', null, 'page_head_bg' );
$height   = dukamarket_theme_option_meta( '_custom_page_side_options', null, 'page_head_height' );
$height_t = dukamarket_theme_option_meta( '_custom_page_side_options', null, 'page_head_height_t' );
$height_m = dukamarket_theme_option_meta( '_custom_page_side_options', null, 'page_head_height_m' );
if ( !empty( $bg ) ) {
    $style .= 'background-image: url(' . wp_get_attachment_image_url( $bg, '$bg' ) . ');';
} elseif ( !empty( $bg_to ) ) {
    $style .= 'background-image: url(' . wp_get_attachment_image_url( $bg_to, '$bg_to' ) . ');';
}
if ( !empty( $height ) )
    $style .= '--head-height: ' . $height . 'px;';
if ( !empty( $height_t ) )
    $style .= '--head-height-t: ' . $height_t . 'px;';
if ( !empty( $height_m ) )
    $style .= '--head-height-m: ' . $height_m . 'px;';
?>
<div class="page-head" <?php if ( !empty( $style ) ) echo 'style="' . esc_attr( $style ) . '""'; ?>>
    <div class="container">
        <div class="head-inner">
            <?php
            dukamarket_page_title();
            dukamarket_breadcrumb();
            ?>
        </div>
    </div>
</div>
