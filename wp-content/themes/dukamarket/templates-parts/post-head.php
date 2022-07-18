<?php
$page_layout = dukamarket_page_layout();
$post_style  = dukamarket_get_option( 'single_layout', 'standard' );
$class       = 'post-head style-' . $post_style . ' sidebar-' . $page_layout['layout'];
while ( have_posts() ): the_post(); ?>
    <div class="container">
        <?php dukamarket_breadcrumb(); ?>
        <div class="<?php echo esc_attr( $class ); ?>">
            <?php if ( has_post_thumbnail() ) dukamarket_post_formats(); ?>
            <div class="post-text">
                <div class="inner">
                    <?php dukamarket_post_title( false ); ?>
                    <div class="post-metas">
                        <?php
                        dukamarket_get_term_list( 'category', esc_html__( 'Categories: ', 'dukamarket' ) );
                        dukamarket_post_author();
                        dukamarket_post_date();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endwhile;
