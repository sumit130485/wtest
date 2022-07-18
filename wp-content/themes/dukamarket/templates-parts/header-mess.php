<?php
$header_message = dukamarket_theme_option_meta(
    '_custom_metabox_theme_options',
    'header_message',
    'metabox_header_message'
);
if ( !empty( $header_message ) ) :?>
    <div class="header-message">
        <p><?php echo esc_html( $header_message ); ?></p>
    </div>
<?php endif;