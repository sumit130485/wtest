<?php
/**
 * Template Format Video
 *
 * @param $data
 *
 * @return string
 */
?>
<?php if (!empty($data)): ?>
    <div class="post-thumb video">
        <?php
        echo wp_video_shortcode(array(
            'src'     => $data,
            'poster'  => wp_get_attachment_image_url(get_post_thumbnail_id(), 'full'),
            'width'   => 1400,
            'height'  => 930,
            'preload' => 'none',
        ));
        ?>
    </div>
<?php endif; ?>