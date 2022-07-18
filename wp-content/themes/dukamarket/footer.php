<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage DukaMarket
 * @since 1.0
 * @version 1.2
 */
?>
<?php
if (dukamarket_get_option('enable_backtotop') == 1 && !dukamarket_is_mobile()) {
    echo '<a href="#" class="backtotop action-to-top"></a>';
}
/* FOOTER */
do_action('ovic_footer_content');
/* NEWSLETTER */
dukamarket_popup_newsletter();
?>
</div><!-- #page -->
<?php
/* WP FOOTER */
wp_footer();
?>
</body>
</html>
