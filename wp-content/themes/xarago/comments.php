<?php
/**
 * The template for displaying Comments.
 */
?>
<div id="comments">
<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (_e('Please do not load this page directly. Thanks!','xarago'));

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'xarago') ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

	<?php if ( have_comments() ) : // if there are comments ?>
        <?php if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>
    		
      <h3 class="comment-heading"><?php
			printf( _n( '<strong>1 COMMENT</strong> to %2$s', '<strong>%1$s COMMENTS</strong> to %2$s', get_comments_number(), 'xarago' ),
			number_format_i18n( get_comments_number() ), '&quot;' . get_the_title() . '&quot;' );
			?></h3>
        <ol class="blog-comment">
            <?php wp_list_comments('type=comment&avatar_size=50&callback=indonez_comment'); ?>
        </ol>
        <?php endif; ?>
        <div class="clear"></div>
        
        <?php if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
    		<h3 class="comment-heading"><?php _e('Trackbacks for this post', 'xarago') ?></h3>
    		<ol class="commentlist">
				<?php wp_list_comments('type=pings&callback=indonez_list_pings'); ?>
            </ol>
        <?php endif; ?>
		    <div class="clear"></div>
        
    		<nav class="comment-navigation">
    			<div class="alignleft"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'xarago' )); ?></div>
    			<div class="alignright"><?php next_comments_link(esc_html__( 'Newer Comments &rarr;', 'xarago' )); ?></div>
    		</nav>
    		
		<?php if ('closed' == $post->comment_status ) : // if the post has comments but comments are now closed ?>
		<p class="nocomments"><?php _e('Comments are now closed for this article.', 'xarago') ?></p>
		<?php endif; ?>

 		<?php else :  ?>
		
        <?php if ('open' == $post->comment_status) : // if comments are open but no comments so far ?>
        <!-- If comments are open, but there are no comments. -->

        <?php else : // if comments are closed ?>
		
		<?php if (is_single()) { ?><p class="nocomments"><?php _e('Comments are closed.', 'xarago') ?></p><?php } ?>

        <?php endif; ?>
        
        
<?php endif; ?>


	<?php if ( comments_open() ) : ?>
  <?php 
  $defaults = array( 
  'fields' => apply_filters( 'comment_form_default_fields', 
    array(
      'author' => '<input id="author" name="author" type="text" value="' .esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1"' . esc_attr($req) . '   class="textfield"/>'.
			            '<label class="label-required">'. esc_html__( 'Name' ,'xarago') .'<em>*</em></label>',
      
      'email'  => '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2"' . esc_attr($req) . '  class="textfield" />'.
              '<label class="label-required">'. esc_html__( 'Email' ,'xarago') .'<em>*</em></label>',
      
      'url'    => '<input id="url" name="url" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30" tabindex="2"' . esc_attr($req) . '  class="textfield" />'.
              '<label class="label-required">'. esc_html__( 'URL' ,'xarago') .'</label>')),
      
      'comment_field' => 
                '<textarea id="comment" name="comment" cols="2" rows="8" tabindex="4" aria-required="true" class="textarea" placeholder="'. esc_html__( 'Enter your Message' ,'xarago') .'"></textarea>',
      
      'comment_notes_after' => '',
      'id_form' => 'comment-form',
	     'class_form' => 'uk-form idz-margin-bottom-small',
      'id_submit' => 'submit',
	     'class_submit'=>'uk-button uk-button-small idz-button-grey',
      'title_reply' => __( 'Leave Comment','xarago' ),
      'title_reply_to' => esc_attr__( 'Reply to %s' ,'xarago'),
      'cancel_reply_link' => __( 'Cancel reply' ,'xarago'),
      'label_submit' => __( 'Send Message ','xarago') . ''
      );


comment_form($defaults); 

?>
	<?php endif; // If registration required and not logged in ?>

</div>