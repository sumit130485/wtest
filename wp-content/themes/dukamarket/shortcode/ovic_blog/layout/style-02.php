<div class="post-inner">
    <?php dukamarket_post_thumbnail( $atts['image_width'], $atts['image_height'], true ); ?>
    <div class="post-info">
        <?php
        dukamarket_post_title();
        dukamarket_post_author();
        if ( $atts['excerpt'] == 'yes' )
            dukamarket_post_excerpt( $atts['excerpt_number'] );
        ?>
        <div class="post-foot">
            <?php
            dukamarket_post_readmore();
            dukamarket_post_date();
            ?>
        </div>
    </div>
</div>