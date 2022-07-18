<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage DukaMarket
 * @since 1.0
 * @version 1.0
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
$fields        = dukamarket_comment_form_args();
$comment_field = dukamarket_comment_form_field();
if ( has_action( 'set_comment_cookies', 'wp_set_comment_cookies' ) && get_option( 'show_comments_cookies_opt_in' ) ) {
    $consent           = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
    $fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" ' . $consent . ' />' .
        '<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'dukamarket' ) . '</label></p>';
}
$comment_form_args = array(
    'class_submit'  => 'button',
    'comment_field' => $comment_field,
    'fields'        => $fields,
    'label_submit'  => esc_html__( 'Submit', 'dukamarket' ),
);
?>

<div id="comments" class="comments-area">

    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ( '1' === $comments_number ) {
                /* translators: %s: post title */
                printf( esc_html_x( 'One Comment on &ldquo;%s&rdquo;', 'comments title', 'dukamarket' ), '<span>' . get_the_title() . '</span>' );
            } else {
                printf(
                /* translators: 1: number of comments, 2: post title */
                    _nx(
                        '%1$s Comment on &ldquo;%2$s&rdquo;',
                        '%1$s Comments on &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'dukamarket'
                    ),
                    number_format_i18n( $comments_number ),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list commentlist">
            <?php
            wp_list_comments( array(
                    'avatar_size' => 90,
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'callback'    => 'dukamarket_callback_comment',
                )
            );
            ?>
        </ol>

        <?php
        the_comments_pagination( array(
                'prev_text' => esc_html__( 'Prev', 'dukamarket' ),
                'next_text' => esc_html__( 'Next', 'dukamarket' ),
                'type'      => 'list',
            )
        );
    endif; // Check for have_comments().
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( !comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'dukamarket' ); ?></p>
    <?php
    endif;
    comment_form( $comment_form_args );
    ?>

</div><!-- #comments -->
