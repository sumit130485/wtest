<?php
/**
 * Template Format Quote
 *
 * @param $data
 *
 * @return string
 */
?>
<div class="post-thumb quote">
    <div class="feature-image"><?php the_post_thumbnail( 'full' ); ?></div>
    <div class="blockquote">
        <blockquote>
            <?php echo esc_html( $data ); ?>
        </blockquote>
    </div>
</div>