<?php

/**
 * HTML comment list class.
 *
 * TODO make shure, that this theme is supporting HTML
 *      current_theme_supports( 'html5', 'comment-list' )
 *
 * @uses    Walker
 *
 * @author  Indonez
 */
if ( ! class_exists( 'IndonezUikitCommentsWalker' ) ) :
class IndonezUikitCommentsWalker extends Walker_Comment
{

    /**
     * Start the list before the elements are added.
     *
     * @see Walker_Comment::start_lvl()
     *
     * @param string $output
     *                Passed by reference. Used to append additional content.
     * @param int    $depth
     *                Depth of comment.
     * @param array  $args
     *                Uses 'style' argument for type of HTML list.
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $GLOBALS['comment_depth'] = $depth + 1;
        $output .= '<ul class="idz-ui-comments-children">' . "\n";
    }

    /**
     * End the list of items after the elements are added.
     *
     * @see Walker_Comment::end_lvl()
     *
     * @param string $output
     *                Passed by reference. Used to append additional content.
     * @param int    $depth
     *                Depth of comment.
     * @param array  $args
     *                Will only append content if style argument value is 'ol' or 'ul'.
     */
    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $GLOBALS['comment_depth'] = $depth + 1; // TODO should it not be -1???
        $output .= '</ul>' . "\n";
    }

    /**
     * Output a single comment.
     *
     * @see wp_list_comments()
     *
     * @param object $comment
     *                Comment to display.
     * @param int    $depth
     *                Depth of comment.
     * @param array  $args
     *                An array of arguments.
     */
    protected function comment($comment, $depth, $args)
    {
        $this->html5_comment($comment, $depth, $args);
    }

    /**
     * Output a comment in the HTML5 format.
     *
     * @see wp_list_comments()
     *
     * @param object $comment
     *                Comment to display.
     * @param int    $depth
     *                Depth of comment.
     * @param array  $args
     *                An array of arguments.
     */
    protected function html5_comment($comment, $depth, $args)
    {
        ?>
    <li id="comment-<?php esc_attr(comment_ID()); ?>" <?php esc_attr(comment_class($this->has_children ? 'parent' : '')); ?>>
        <article id="comment-<?php esc_attr(comment_ID()); ?>" class="uk-comment">
		
			<div class="avatar">
				<?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
			</div>

            <div class="uk-comment-body">
				<?php if ($depth < $args['max_depth']) : ?>
				<?php
				comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
				?>
				<?php endif; ?>
				<?php printf('<h4 class="uk-comment-title">%s</h4>', get_comment_author_link()); ?>
				<a href="<?php echo esc_url(get_comment_link($comment->comment_ID, $args)); ?>" class="commenttime">
					<time datetime="<?php comment_time('c'); ?>">
						<?php printf('%1$s at %2$s', get_comment_date(), get_comment_time()); ?>
					</time>
				</a>
				<?php if (current_user_can('edit_comment')) : ?>
					 <?php edit_comment_link(esc_attr__('Edit This', 'xarago')); ?>
				<?php endif; ?>
				<?php if ('0' == $comment->comment_approved) : ?>
                    <p class="comment-awaiting-moderation"><?php esc_html__('Your comment is awaiting moderation.', 'xarago'); ?></p>
                <?php endif; ?>
                <?php comment_text(); ?>
            </div>
        </article>
        <?php
    }
}
endif;