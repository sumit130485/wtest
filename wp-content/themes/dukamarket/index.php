<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage DukaMarket
 * @since 1.0
 * @version 1.0
 */

get_header();

$enable_small = 0;
$page_layout  = dukamarket_page_layout();
$post_style   = dukamarket_get_option( 'blog_list_style', 'standard' );
$page_title   = dukamarket_get_option( 'blog_page_title', 1 );
$sub_class    = 'blog-page';
if ( is_single() ) {
    $post_style = dukamarket_get_option( 'single_layout', 'standard' );
    $sub_class  = 'post-page';
}
$main_class = array(
    "container",
    "site-content",
    "sidebar-{$page_layout['layout']}",
    "style-{$post_style} {$sub_class}",
);
?>

<?php
if ( is_single() ) get_template_part( 'templates-parts/post', 'head' );
?>

    <!-- site-content-contain -->
    <div id="content" class="<?php echo implode( ' ', $main_class ); ?>">

        <?php
        if ( !is_single() && !is_404() && $page_title == 1 ) dukamarket_page_title();
        if ( !is_single() ) dukamarket_breadcrumb();
        ?>

        <div id="primary" class="content-area">

            <main id="main" class="site-main">

                <?php
                if ( have_posts() ) {
                    $path = 'content';
                    if ( is_single() ) {
                        $path       = 'single';
                        $post_style = 'standard';
                        if ( function_exists( 'ovic_set_post_views' ) ) {
                            ovic_set_post_views();
                        }
                    }
                    get_template_part( "templates/blog/blog-{$path}/{$post_style}" );
                    wp_reset_postdata();
                } else {
                    get_template_part( 'content', 'none' );
                }
                ?>

            </main><!-- #main -->

        </div><!-- #primary -->

        <?php if ( $page_layout['layout'] != 'full' ) : ?>
            <aside id="secondary" class="widget-area <?php echo esc_attr( $page_layout['sidebar'] ); ?>"
                   role="complementary"
                   aria-label="<?php esc_attr_e( 'Post Sidebar', 'dukamarket' ); ?>">
                <?php dynamic_sidebar( $page_layout['sidebar'] ); ?>
            </aside><!-- #secondary -->
        <?php endif; ?>

    </div><!-- .site-content-contain -->
<?php
get_footer();
