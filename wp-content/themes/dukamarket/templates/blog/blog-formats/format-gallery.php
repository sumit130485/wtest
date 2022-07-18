<?php
/**
 * Template Format Gallery
 *
 * @param $data
 *
 * @return string
 */
?>
<?php
$data_slick = array(
    'infinite'      => true,
    'autoplay'      => true,
    'arrows'        => false,
    'slidesToShow'  => 1,
    'slidesMargin'  => 30,
    'autoplaySpeed' => 2000,
    'speed'         => 1500,
);
$galleries  = !empty( $data ) ? explode( ',', $data ) : array();
?>
<?php if ( !empty( $galleries ) ): ?>
    <div class="post-thumb gallery owl-slick" data-slick="<?php echo esc_attr( wp_json_encode( $data_slick ) ); ?>">
        <?php foreach ( $galleries as $gallery ): ?>
            <figure>
                <?php echo wp_get_attachment_image( $gallery, 'full' ); ?>
            </figure>
        <?php endforeach; ?>
    </div>
<?php endif; ?>