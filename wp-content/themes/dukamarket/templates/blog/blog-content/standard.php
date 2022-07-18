<?php
/**
 * Name: Blog Standard
 **/
?>
<div class="blog-content blog-standard response-content">
    <?php while ( have_posts() ): the_post(); ?>
        <article <?php post_class( 'post-item style-01' ); ?>>
            <div class="post-inner">
                <?php dukamarket_post_thumbnail_simple(); ?>
                <div class="post-info">
                    <?php
                    dukamarket_post_title();
                    if ( get_post_type() != 'product' ) {
                        dukamarket_post_author();
                    }
                    dukamarket_post_excerpt( 46 );
                    if ( get_post_type() != 'product' ) : ?>
                        <div class="post-foot">
                            <?php
                            dukamarket_post_readmore();
                            dukamarket_post_date();
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</div>
<?php dukamarket_post_pagination(); ?>
