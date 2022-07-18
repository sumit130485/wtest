<?php
/**
 * Template Name: Full Width Template
 *
 * @package WordPress
 * @subpackage DukaMarket
 * @since DukaMarket 1.0
 */
get_header();
?>
    <div class="fullwidth-template">
        <div class="container">
			<?php
			// Start the loop.
			while ( have_posts() ) {
				the_post();
				the_content();
			}
			wp_reset_postdata();
			// End the loop.
			?>
        </div>
    </div>
<?php
get_footer();