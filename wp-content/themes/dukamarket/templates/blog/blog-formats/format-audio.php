<?php
/**
 * Template Format Audio
 *
 * @param $data
 *
 * @return string
 */
?>
<?php if (!empty($data)): ?>
    <div class="post-thumb audio">
        <div class="feature-image"><?php the_post_thumbnail('full'); ?></div>
        <?php
        echo wp_audio_shortcode(array(
            'src'     => $data,
            'preload' => 'none',
        ));
        ?>
    </div>
<?php endif; ?>