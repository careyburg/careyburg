<?php
/**
 * Template Name: sitemap
 * @author Indonez
 * @link http://indonez.com
 */

get_header();
?>
<section id="main-container">
<?php
get_template_part('elements/base/header');

get_template_part('elements/base/precontent');
?>
<div class="uk-grid sitemap-wrap">

<div class="uk-width-1-3 uk-width-small-1-1">
	<h3><?php echo esc_html__('Pages','xarago');?></h3>
	<ul class="idz-ui-list check">
		<?php  wp_list_pages(array('exclude' => '','title_li' => '',));?>
	</ul>
</div>

<div class="uk-width-1-3 uk-width-small-1-1 idz-ui-margin-top-ml">
	<h3><span><?php echo esc_html__('Blog Archives','xarago');?></span></h3>
	<h4><?php echo esc_html__('Archives by Month','xarago');?></h4>
	<ul class="idz-ui-list check">
		 <?php wp_get_archives('type=monthly'); ?>
	</ul>
	<h4><?php echo esc_html__('Archives by Category','xarago');?></h4>
	<ul class="idz-ui-list check">
		<?php
		$cats = get_categories('exclude=');
		foreach ($cats as $cat) {
			$cat_id = $cat->cat_ID;
			$cat_name = $cat->name;
			$cat_link = get_category_link($cat_id); 
		?>
			<li><a href="<?php echo esc_url($cat_link);?>"><?php echo esc_html($cat_name);?></a></li>
		<?php } ?>
	</ul>
	<h4><?php echo esc_html__('Archives by Tag','xarago');?></h4>
	<ul class="idz-ui-list check">
		<?php
		$tags = array();
		$posts = get_posts('numberposts=-1');
		foreach ($posts as $p) {
			foreach (wp_get_post_tags($p->ID) as $tag) {
				if (array_key_exists($tag->name, $tags))
					$tags[$tag->name]['count']++;
				else {
					$tags[$tag->name]['count'] = 1;
					$tags[$tag->name]['link'] = get_tag_link($tag->term_id);
				}
			}
		}
		?>

		<?php foreach ($tags as $tag_name => $tag) { ?>
				<li><a href="<?php echo esc_url($tag['link']);?>"><?php echo esc_html($tag_name);?></a></li>
		<?php } ?>
	</ul>
	<h4><?php echo esc_html__('Archives by Author','xarago');?></h4>
	<ul class="idz-ui-list check">
	  <?php  wp_list_authors(array('exclude_admin' => false,)); ?>
	</ul>
</div>

<div class="uk-width-1-3 uk-width-small-1-1 idz-ui-margin-top-ml">
	<h3><span><?php echo esc_html__('Latest 20 Posts','xarago');?></span></h3>
	<ul class="idz-ui-list check">
		<?php
		query_posts('posts_per_page=20&post_type=post'); 
		while (have_posts()) : the_post(); ?>
			<li><a href="<?php esc_url(the_permalink());?>" title="<?php esc_attr(the_title()); ?>"><?php the_title();?></a></li>
		<?php endwhile; wp_reset_query();?>
	</ul>
</div>

</div>
<?php

get_template_part('elements/base/postcontent');
?>

</section>

<?php
get_template_part('elements/base/footer');

get_footer();