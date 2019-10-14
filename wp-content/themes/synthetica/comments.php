<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Primex
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
?>

<div id="comments" class="col-12 blog-details-comments comments-area">
	<?php
	if ( have_comments() ) :
		?>
        <div class="width-100 mx-auto text-center margin-80px-tb md-margin-50px-tb sm-margin-30px-tb">
            <div class="position-relative overflow-hidden width-100">
                <span class="text-small text-outside-line-full alt-font font-weight-600 text-uppercase text-extra-dark-gray">
                    <?php
                    $comments_number = get_comments_number();
                    if ( '1' === $comments_number ) {
                        /* translators: %s: post title */
                        printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'primex' ), get_the_title() );
                    } else {
                        printf(
                        /* translators: 1: number of comments, 2: post title */
                            _nx(
                                '%1$s Reply to &ldquo;%2$s&rdquo;',
                                '%1$s Replies to &ldquo;%2$s&rdquo;',
                                $comments_number,
                                'comments title',
                                'primex'
                            ),
                            number_format_i18n( $comments_number ),
                            get_the_title()
                        );
                    }
                    ?>
                </span>
            </div>
        </div>

		<ul class="blog-comment commentlist clearfix">
			<?php
				wp_list_comments(
					array(
						'avatar_size' => 100,
						'style'       => 'ul',
						'short_ping'  => true,
						'reply_text'  => __( 'Reply', 'synthetica' ),
                        'walker' => new Snth_Walker_Comment,
					)
				);
			?>
		</ul>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => '<span class="screen-reader-text">' . __( 'Previous', 'primex' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'primex' ) . '</span>',
			)
		);

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'primex' ); ?></p>
		<?php
	endif;

    snth_comment_form();
	?>

</div><!-- #comments -->
