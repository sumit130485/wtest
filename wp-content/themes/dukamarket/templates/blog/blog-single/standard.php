<?php
while ( have_posts() ): the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item post-single' ); ?>>
        <div class="post-inner">
            <?php dukamarket_post_content(); ?>
            <div class="clear"></div>
            <?php
            dukamarket_get_term_list( 'post_tag' );
            dukamarket_post_share();
            ?>
            <div class="clear"></div>
            <?php
            dukamarket_pagination_post();
            dukamarket_author_info();
            ?>
        </div>
        <?php
        /*If comments are open or we have at least one comment, load up the comment template.*/
        if ( comments_open() || get_comments_number() ) comments_template();
        ?>
    </article>
<?php endwhile;