<?php
/**
 * Comment API: Walker_Comment class
 *
 * @package WordPress
 * @subpackage Comments
 * @since 4.4.0
 */

/**
 * Core walker class used to create an HTML list of comments.
 *
 * @since 2.7.0
 *
 * @see Walker
 */
class Snth_Walker_Comment extends Walker_Comment {

    /**
     * Starts the list before the elements are added.
     *
     * @since 2.7.0
     *
     * @see Walker::start_lvl()
     * @global int $comment_depth
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Optional. Depth of the current comment. Default 0.
     * @param array  $args   Optional. Uses 'style' argument for type of HTML list. Default empty array.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;

        switch ( $args['style'] ) {
            case 'div':
                break;
            case 'ol':
                $output .= '<ol class="child-comment">' . "\n";
                break;
            case 'ul':
            default:
                $output .= '<ul class="child-comment">' . "\n";
                break;
        }
    }

    /**
     * Ends the list of items after the elements are added.
     *
     * @since 2.7.0
     *
     * @see Walker::end_lvl()
     * @global int $comment_depth
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Optional. Depth of the current comment. Default 0.
     * @param array  $args   Optional. Will only append content if style argument value is 'ol' or 'ul'.
     *                       Default empty array.
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;

        switch ( $args['style'] ) {
            case 'div':
                break;
            case 'ol':
                $output .= "</ol><!-- .children -->\n";
                break;
            case 'ul':
            default:
                $output .= "</ul><!-- .children -->\n";
                break;
        }
    }

    /**
     * Traverses elements to create list from elements.
     *
     * This function is designed to enhance Walker::display_element() to
     * display children of higher nesting levels than selected inline on
     * the highest depth level displayed. This prevents them being orphaned
     * at the end of the comment list.
     *
     * Example: max_depth = 2, with 5 levels of nested content.
     *     1
     *      1.1
     *        1.1.1
     *        1.1.1.1
     *        1.1.1.1.1
     *        1.1.2
     *        1.1.2.1
     *     2
     *      2.2
     *
     * @since 2.7.0
     *
     * @see Walker::display_element()
     * @see wp_list_comments()
     *
     * @param WP_Comment $element           Comment data object.
     * @param array      $children_elements List of elements to continue traversing. Passed by reference.
     * @param int        $max_depth         Max depth to traverse.
     * @param int        $depth             Depth of the current element.
     * @param array      $args              An array of arguments.
     * @param string     $output            Used to append additional content. Passed by reference.
     */
    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element ) {
            return;
        }

        $id_field = $this->db_fields['id'];
        $id       = $element->$id_field;

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

        /*
         * If at the max depth, and the current element still has children, loop over those
         * and display them at this level. This is to prevent them being orphaned to the end
         * of the list.
         */
        if ( $max_depth <= $depth + 1 && isset( $children_elements[ $id ] ) ) {
            foreach ( $children_elements[ $id ] as $child ) {
                $this->display_element( $child, $children_elements, $max_depth, $depth, $args, $output );
            }

            unset( $children_elements[ $id ] );
        }

    }

    /**
     * Starts the element output.
     *
     * @since 2.7.0
     *
     * @see Walker::start_el()
     * @see wp_list_comments()
     * @global int        $comment_depth
     * @global WP_Comment $comment
     *
     * @param string     $output  Used to append additional content. Passed by reference.
     * @param WP_Comment $comment Comment data object.
     * @param int        $depth   Optional. Depth of the current comment in reference to parents. Default 0.
     * @param array      $args    Optional. An array of arguments. Default empty array.
     * @param int        $id      Optional. ID of the current comment. Default 0 (unused).
     */
    public function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment']       = $comment;

        if ( ! empty( $args['callback'] ) ) {
            ob_start();
            call_user_func( $args['callback'], $comment, $args, $depth );
            $output .= ob_get_clean();
            return;
        }

        if ( ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) && $args['short_ping'] ) {
            ob_start();
            $this->ping( $comment, $depth, $args );
            $output .= ob_get_clean();
        } elseif ( 'html5' === $args['format'] ) {
            ob_start();
            $this->html5_comment( $comment, $depth, $args );
            $output .= ob_get_clean();
        } else {
            ob_start();
            $this->comment( $comment, $depth, $args );
            $output .= ob_get_clean();
        }
    }

    /**
     * Ends the element output, if needed.
     *
     * @since 2.7.0
     *
     * @see Walker::end_el()
     * @see wp_list_comments()
     *
     * @param string     $output  Used to append additional content. Passed by reference.
     * @param WP_Comment $comment The current comment object. Default current comment.
     * @param int        $depth   Optional. Depth of the current comment. Default 0.
     * @param array      $args    Optional. An array of arguments. Default empty array.
     */
    public function end_el( &$output, $comment, $depth = 0, $args = array() ) {
        if ( ! empty( $args['end-callback'] ) ) {
            ob_start();
            call_user_func( $args['end-callback'], $comment, $args, $depth );
            $output .= ob_get_clean();
            return;
        }
        if ( 'div' == $args['style'] ) {
            $output .= "</div><!-- #comment-## -->\n";
        } else {
            $output .= "</li><!-- #comment-## -->\n";
        }
    }

    /**
     * Outputs a pingback comment.
     *
     * @since 3.6.0
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment The comment object.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function ping( $comment, $depth, $args ) {
        $tag = ( 'div' == $args['style'] ) ? 'div' : 'li';
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( '', $comment ); ?>>
        <div class="comment-body">
            <?php _e( 'Pingback:' ); ?> <?php comment_author_link( $comment ); ?> <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
        </div>
        <?php
    }

    /**
     * Outputs a single comment.
     *
     * @since 3.6.0
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function comment( $comment, $depth, $args ) {
        if ( 'div' == $args['style'] ) {
            $tag       = 'div';
            $add_below = 'comment';
        } else {
            $tag       = 'li';
            $add_below = 'div-comment';
        }

        $commenter = wp_get_current_commenter();
        if ( $commenter['comment_author_email'] ) {
            $moderation_note = __( 'Your comment is awaiting moderation.' );
        } else {
            $moderation_note = __( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.' );
        }

        ?>
        <<?php echo $tag; ?> <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?> id="comment-<?php comment_ID(); ?>">
        <?php if ( 'div' != $args['style'] ) : ?>
            <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <?php endif; ?>
        <div class="comment-author vcard">
            <?php
            if ( 0 != $args['avatar_size'] ) {
                echo get_avatar( $comment, $args['avatar_size'] );}
            ?>
            <?php
            /* translators: %s: comment author link */
            printf(
                __( '%s <span class="says">says:</span>' ),
                sprintf( '<cite class="fn">%s</cite>', get_comment_author_link( $comment ) )
            );
            ?>
        </div>
        <?php if ( '0' == $comment->comment_approved ) : ?>
            <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
            <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                <?php
                /* translators: 1: comment date, 2: comment time */
                printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
                ?>
            </a>
            <?php
            edit_comment_link( __( '(Edit)' ), '&nbsp;&nbsp;', '' );
            ?>
        </div>

        <?php
        comment_text(
            $comment,
            array_merge(
                $args,
                array(
                    'add_below' => $add_below,
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                )
            )
        );
        ?>

        <?php
        comment_reply_link(
            array_merge(
                $args,
                array(
                    'add_below' => $add_below,
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                    'before'    => '<div class="reply">',
                    'after'     => '</div>',
                )
            )
        );
        ?>

        <?php if ( 'div' != $args['style'] ) : ?>
            </div>
        <?php endif; ?>
        <?php
    }

    /**
     * Outputs a comment in the HTML5 format.
     *
     * @since 3.6.0
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function html5_comment( $comment, $depth, $args ) {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

        $commenter = wp_get_current_commenter();
        if ( $commenter['comment_author_email'] ) {
            $moderation_note = __( 'Your comment is awaiting moderation.' );
        } else {
            $moderation_note = __( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.' );
        }

        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-wrap comment-body d-block d-md-flex width-100 width-100">
            <div class="width-110px sm-width-50px text-center sm-margin-10px-bottom comment-meta">
                <?php
                if ( 0 != $args['avatar_size'] ) {
                    echo get_avatar( $comment, 85, '', '', array('class' => 'rounded-circle width-85 sm-width-100') );}
                ?>
            </div>

            <div class="comment-content width-100 padding-40px-left last-paragraph-no-margin sm-no-padding-left">
                <?php
                /* translators: %s: comment author link */
                echo sprintf( '%s', snth_get_comment_author_link( $comment ) );

                comment_reply_link(
                    array_merge(
                        $args,
                        array(
                            'add_below' => 'div-comment',
                            'reply_text' => __('Reply', 'synthetica'),
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth'],
                            'before'    => '<div class="comment-reply inner-link btn-reply text-uppercase alt-font text-extra-dark-gray">',
                            'after'     => '</div>',
                        )
                    )
                );
                ?>

                <div class="text-small text-medium-gray text-uppercase margin-10px-bottom">
                    <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                        <time datetime="<?php comment_time( 'c' ); ?>">
                            <?php
                            /* translators: 1: comment date, 2: comment time */
                            printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
                            ?>
                        </time>
                    </a>
                </div>

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
                <?php endif; ?>

                <?php comment_text(); ?>

                <div class="comment-metadata">
                    <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
                </div>
            </div>
        </article><!-- .comment-body -->
        <?php
    }
}

function snth_get_comment_author_link( $comment_ID = 0 ) {
    $comment = get_comment( $comment_ID );
    $url     = get_comment_author_url( $comment );
    $author  = get_comment_author( $comment );

    if ( empty( $url ) || 'http://' == $url ) {
        $return = "<span class='text-extra-dark-gray text-uppercase alt-font font-weight-600 text-small'>$author</span>";
    } else {
        $return = "<a href='$url' rel='external nofollow' class='text-extra-dark-gray text-uppercase alt-font font-weight-600 text-small'>$author</a>";
    }

    /**
     * Filters the comment author's link for display.
     *
     * @since 1.5.0
     * @since 4.1.0 The `$author` and `$comment_ID` parameters were added.
     *
     * @param string $return     The HTML-formatted comment author link.
     *                           Empty for an invalid URL.
     * @param string $author     The comment author's username.
     * @param int    $comment_ID The comment ID.
     */
    return apply_filters( 'get_comment_author_link', $return, $author, $comment->comment_ID );
}


function snth_comment_form( $args = array(), $post_id = null ) {
    if ( null === $post_id ) {
        $post_id = get_the_ID();
    }

    // Exit the function when comments for the post are closed.
    if ( ! comments_open( $post_id ) ) {
        /**
         * Fires after the comment form if comments are closed.
         *
         * @since 3.0.0
         */
        do_action( 'comment_form_comments_closed' );

        return;
    }

    $commenter     = wp_get_current_commenter();
    $user          = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';

    $args = wp_parse_args( $args );
    if ( ! isset( $args['format'] ) ) {
        $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
    }

    $req      = get_option( 'require_name_email' );
    $html_req = ( $req ? " required='required'" : '' );
    $html5    = 'html5' === $args['format'];

    ob_start();
    ?>
    <div class="comment-form-author col-12 col-lg-4">
        <input id="author"
               placeholder="<?php echo __( 'Name', 'synthetica' ) . ( $req ? ' *' : '' ); ?>"
               class="medium-input"
               name="author"
               type="text"
               value="<?php echo esc_attr( $commenter['comment_author'] ); ?>"
               size="30"
               maxlength="245"<?php echo $html_req; ?>
        />
    </div>
    <?php
    $author_field = ob_get_clean();

    ob_start();
    ?>
    <div class="comment-form-email col-12 col-lg-4">
        <input id="email"
               placeholder="<?php echo __( 'Email', 'synthetica' ) . ( $req ? ' *' : '' ); ?>"
               class="medium-input" name="email" <?php echo ( $html5 ? 'type="email"' : 'type="text"' ); ?>
               value="<?php echo esc_attr( $commenter['comment_author_email'] ); ?>"
               size="30"
               maxlength="100"
               aria-describedby="email-notes"<?php echo $html_req; ?>
        />
    </div>
    <?php
    $email_field = ob_get_clean();

    ob_start();
    ?>
    <div class="comment-form-email col-12 col-lg-4">
        <input id="email"
               placeholder="<?php echo __( 'Website', 'synthetica' ); ?>"
               class="medium-input" name="url" <?php echo ( $html5 ? 'type="url"' : 'type="text"' ); ?>
               value="<?php echo esc_attr( $commenter['comment_author_url'] ); ?>"
               size="30"
               maxlength="200"
        />
    </div>
    <?php
    $url_field = ob_get_clean();

    $fields   = array(
        'author' => $author_field,
        'email'  => $email_field,
        'url'    => $url_field,
    );

    if ( has_action( 'set_comment_cookies', 'wp_set_comment_cookies' ) && get_option( 'show_comments_cookies_opt_in' ) ) {
        $consent           = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

        ob_start();
        ?>
        <div class="comment-form-cookies-consent col-12">
            <label for="wp-comment-cookies-consent"><?php echo __( 'Save my name, email, and website in this browser for the next time I comment.' ); ?></label>
            <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"<?php echo $consent; ?> style="width:auto;" />
        </div>
        <?php
        $fields['cookies'] = ob_get_clean();

        // Ensure that the passed fields include cookies consent.
        if ( isset( $args['fields'] ) && ! isset( $args['fields']['cookies'] ) ) {
            $args['fields']['cookies'] = $fields['cookies'];
        }
    }

    $required_text = sprintf( ' ' . __( 'Required fields are marked %s' ), '<span class="required">*</span>' );

    /**
     * Filters the default comment form fields.
     *
     * @since 3.0.0
     *
     * @param string[] $fields Array of the default comment fields.
     */
    $fields   = apply_filters( 'comment_form_default_fields', $fields );
    $defaults = array(
        'fields'               => $fields,
        'comment_field'        => '<div class="col-12"><textarea id="comment" placeholder="' . _x( 'Your comment here', 'noun' ) . '"  name="comment" cols="58" rows="7" tabindex="4" class="comment_field" maxlength="65525" required="required"></textarea></div>',
        /** This filter is documented in wp-includes/link-template.php */
        'must_log_in'          => '<p class="must-log-in">' . sprintf(
            /* translators: %s: login URL */
                __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
                wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
            ) . '</p>',
        /** This filter is documented in wp-includes/link-template.php */
        'logged_in_as'         => '<div class="col-12 logged-in-as"><p>' . sprintf(
            /* translators: 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
                __( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>' ),
                get_edit_user_link(),
                /* translators: %s: user name */
                esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
                $user_identity,
                wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ), $post_id ) )
            ) . '</p></div>',
        'comment_notes_before' => '<div class="col-12 comment-notes"><p><span id="email-notes">' . __( 'Your email address will not be published.' ) . '</span>' . ( $req ? $required_text : '' ) . '</p></div>',
        'comment_notes_after'  => '',
        'action'               => site_url( '/wp-comments-post.php' ),
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'class_form'           => 'comment-form',
        'class_submit'         => 'submit btn btn-dark-gray btn-small margin-15px-top',
        'name_submit'          => 'submit',
        'title_reply'          => __( 'Leave a Reply' ),
        'title_reply_to'       => __( 'Leave a Reply to %s' ),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title"><span class="text-small text-outside-line-full alt-font font-weight-600 text-uppercase text-extra-dark-gray">',
        'title_reply_after'    => '</span></h3>',
        'cancel_reply_before'  => '',
        'cancel_reply_after'   => '',
        'cancel_reply_link'    => __( 'Cancel reply' ),
        'label_submit'         => __( 'Post Comment' ),
        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        'submit_field'         => '<div class="form-submit col-12 text-center">%1$s %2$s</div>',
        'format'               => 'xhtml',
    );

    /**
     * Filters the comment form default arguments.
     *
     * Use {@see 'comment_form_default_fields'} to filter the comment fields.
     *
     * @since 3.0.0
     *
     * @param array $defaults The default comment form arguments.
     */
    $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

    // Ensure that the filtered args contain all required default values.
    $args = array_merge( $defaults, $args );

    /**
     * Fires before the comment form.
     *
     * @since 3.0.0
     */
    do_action( 'comment_form_before' );
    ?>
    <div id="respond" class="comment-respond">
        <div class="row">
        <div class="col-12 mx-auto text-center margin-30px-top">
            <div class="position-relative overflow-hidden width-100">
                    <?php
                    echo $args['title_reply_before'];
                    comment_form_title( $args['title_reply'], $args['title_reply_to'] );
                    echo $args['cancel_reply_before'];
                    ?>
                </span>
            </div>
        </div>
        <?php

        cancel_comment_reply_link( $args['cancel_reply_link'] );

        echo $args['cancel_reply_after'];

        echo $args['title_reply_after'];

        if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) :
            echo $args['must_log_in'];
            /**
             * Fires after the HTML-formatted 'must log in after' message in the comment form.
             *
             * @since 3.0.0
             */
            do_action( 'comment_form_must_log_in_after' );
        else :
            ?>
            <div class="col-12 mx-auto margin-20px-top">
                <form action="<?php echo esc_url( $args['action'] ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="<?php echo esc_attr( $args['class_form'] ); ?>"<?php echo $html5 ? ' novalidate' : ''; ?>>
                    <div class="row">
                        <?php
                        /**
                         * Fires at the top of the comment form, inside the form tag.
                         *
                         * @since 3.0.0
                         */
                        do_action( 'comment_form_top' );

                        if ( is_user_logged_in() ) :
                            /**
                             * Filters the 'logged in' message for the comment form for display.
                             *
                             * @since 3.0.0
                             *
                             * @param string $args_logged_in The logged-in-as HTML-formatted message.
                             * @param array  $commenter      An array containing the comment author's
                             *                               username, email, and URL.
                             * @param string $user_identity  If the commenter is a registered user,
                             *                               the display name, blank otherwise.
                             */
                            echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );

                            /**
                             * Fires after the is_user_logged_in() check in the comment form.
                             *
                             * @since 3.0.0
                             *
                             * @param array  $commenter     An array containing the comment author's
                             *                              username, email, and URL.
                             * @param string $user_identity If the commenter is a registered user,
                             *                              the display name, blank otherwise.
                             */
                            do_action( 'comment_form_logged_in_after', $commenter, $user_identity );

                        else :

                            echo $args['comment_notes_before'];

                        endif;

                        // Prepare an array of all fields, including the textarea
                        $comment_fields = array( 'comment' => $args['comment_field'] ) + (array) $args['fields'];

                        /**
                         * Filters the comment form fields, including the textarea.
                         *
                         * @since 4.4.0
                         *
                         * @param array $comment_fields The comment fields.
                         */
                        $comment_fields = apply_filters( 'comment_form_fields', $comment_fields );

                        // Get an array of field names, excluding the textarea
                        $comment_field_keys = array_diff( array_keys( $comment_fields ), array( 'comment' ) );

                        // Get the first and the last field name, excluding the textarea
                        $first_field = reset( $comment_field_keys );
                        $last_field  = end( $comment_field_keys );

                        foreach ( $comment_fields as $name => $field ) {

                            if ( 'comment' === $name ) {

                                /**
                                 * Filters the content of the comment textarea field for display.
                                 *
                                 * @since 3.0.0
                                 *
                                 * @param string $args_comment_field The content of the comment textarea field.
                                 */
                                echo apply_filters( 'comment_form_field_comment', $field );

                                echo $args['comment_notes_after'];

                            } elseif ( ! is_user_logged_in() ) {

                                if ( $first_field === $name ) {
                                    /**
                                     * Fires before the comment fields in the comment form, excluding the textarea.
                                     *
                                     * @since 3.0.0
                                     */
                                    do_action( 'comment_form_before_fields' );
                                }

                                /**
                                 * Filters a comment form field for display.
                                 *
                                 * The dynamic portion of the filter hook, `$name`, refers to the name
                                 * of the comment form field. Such as 'author', 'email', or 'url'.
                                 *
                                 * @since 3.0.0
                                 *
                                 * @param string $field The HTML-formatted output of the comment form field.
                                 */
                                echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";

                                if ( $last_field === $name ) {
                                    /**
                                     * Fires after the comment fields in the comment form, excluding the textarea.
                                     *
                                     * @since 3.0.0
                                     */
                                    do_action( 'comment_form_after_fields' );
                                }
                            }
                        }

                        $submit_button = sprintf(
                            $args['submit_button'],
                            esc_attr( $args['name_submit'] ),
                            esc_attr( $args['id_submit'] ),
                            esc_attr( $args['class_submit'] ),
                            esc_attr( $args['label_submit'] )
                        );

                        /**
                         * Filters the submit button for the comment form to display.
                         *
                         * @since 4.2.0
                         *
                         * @param string $submit_button HTML markup for the submit button.
                         * @param array  $args          Arguments passed to comment_form().
                         */
                        $submit_button = apply_filters( 'comment_form_submit_button', $submit_button, $args );

                        $submit_field = sprintf(
                            $args['submit_field'],
                            $submit_button,
                            get_comment_id_fields( $post_id )
                        );

                        /**
                         * Filters the submit field for the comment form to display.
                         *
                         * The submit field includes the submit button, hidden fields for the
                         * comment form, and any wrapper markup.
                         *
                         * @since 4.2.0
                         *
                         * @param string $submit_field HTML markup for the submit field.
                         * @param array  $args         Arguments passed to comment_form().
                         */
                        echo apply_filters( 'comment_form_submit_field', $submit_field, $args );

                        /**
                         * Fires at the bottom of the comment form, inside the closing </form> tag.
                         *
                         * @since 1.5.0
                         *
                         * @param int $post_id The post ID.
                         */
                        do_action( 'comment_form', $post_id );
                        ?>
                    </div>
                </form>
            </div>
        <?php endif; ?>

        </div>
    </div><!-- #respond -->
    <?php

    /**
     * Fires after the comment form.
     *
     * @since 3.0.0
     */
    do_action( 'comment_form_after' );
}
