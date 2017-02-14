<?php global $post;
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 */
 $xarago_opts = xarago_opts();
?>

 <article  id="post-<?php the_ID(); ?>" <?php post_class(array('uk-article', 'blog-wrapper')); ?>>

 	<?php
	$format = get_post_format($post->ID);
		
	//post title
	if (is_single()) {
		the_title('<h3 class="idz-bottom-line center">', '</h3>');
	} else {
		the_title('<h3 class="idz-bottom-line center"><a href="' . esc_url(get_permalink()) . '">', '</a></h3>');
	}

	//post entry meta
	if (!is_search()) :
		do_action('xarago_post_meta');
	endif;

	//post format embed
	if (!is_search()) :
		do_action('xarago_post_format');
	endif;
	
	?>

	<?php if (is_search()) : ?>
	
		<div class="blog-content">
			<?php the_excerpt(); ?>
		</div><!-- .idz-ui-entry-summary -->
		
	<?php else : ?>
	
		<div class="blog-content">
			<?php the_content(''); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'xarago'), 'after' => '</div>' ) );?>
		</div><!-- .idz-ui-entry-content -->

	<?php endif; ?>

    <div class="post-share">
        <div class="uk-grid uk-grid-divider uk-text-center">
            <div class="uk-width-1-3 uk-width-small-1-2 post-comment">
            	<?php $xarago_postcat_meta = !empty($xarago_opts['xarago_postcat_meta']) ? $xarago_opts['xarago_postcat_meta'] : 0;?>
            	<?php if ($xarago_postcat_meta == 1) { ?>
                <?php comments_popup_link(esc_html__('0 Comment', ''), esc_html__('1 Comments','xarago'),esc_html__('% Comments','xarago')); ?>
                <?php } ?>
            </div>
            <div class="uk-width-1-3 uk-hidden-small">
            	<?php do_action('xarago_post_social_share');?>
            </div>
            <div class="uk-width-1-3 uk-width-small-1-2 post-continue">
            	<?php 
            	$xarago_readmore_text_opt = !empty($xarago_opts['xarago_readmore_text_opt']) ? $xarago_opts['xarago_readmore_text_opt'] : 0;
            	$readmoretext = !empty($xarago_opts['xarago_readmore_text']) ? $xarago_opts['xarago_readmore_text'] : esc_html__("Continue Reading...",'xarago');
				if ($xarago_readmore_text_opt == 1) { ?>
                	<a href="<?php esc_url(the_permalink());?>"><?php echo esc_html($readmoretext);?></a>
                <?php } ?>
            </div>
        </div>
    </div>
</article>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('uk-article', 'blog-wrapper')); ?>>
	
	<?php
	
	if(is_single()){
		
		
		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) {
			comments_template( '', true );
		}
	
	}
	?>

</article>