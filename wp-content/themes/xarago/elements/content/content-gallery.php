<?php
/**
 * The default template for displaying gallery content
 *
 * Used for page.
 *
 */
?>

<?php if( get_field('idz-gallery-category') ): ?>
	<ul id="filter" class="uk-subnav uk-subnav-pill uk-flex-center uk-margin-large-bottom">
	    <li class="uk-active" data-uk-filter=""><a href="#">All</a></li>
		
		<?php while( has_sub_field('idz-gallery-category') ): ?>

			<?php 

			// vars
			//$gallery_name = get_sub_field_object('idz-gallery-name');
			$gallery_name_value = get_sub_field('idz-gallery-name');
			$gallery_cat_slug = str_replace(' ', '-', $gallery_name_value);

			?>
			<li data-uk-filter="<?php echo strtolower($gallery_cat_slug);?>"><a href="#"><?php echo esc_attr($gallery_name_value);?></a></li>

	<?php endwhile; ?>
	</ul>
<?php endif; ?>

<?php
$columns = get_field('idz-gallery-page-columns');
$lightbox = get_field('idz-gallery-lightbox');


$columns_container == '';
if ($columns == '2columns') {
	$columns_container = 'uk-grid-width-medium-1-2 uk-grid-width-small-1-2 uk-margin-medium-bottom';
} else if ($columns == '3columns') {
	$columns_container = 'uk-grid-width-medium-1-3 uk-grid-width-small-1-2 uk-margin-medium-bottom';
} else if ($columns == '4columns') {
	$columns_container = 'uk-grid-width-medium-1-4 uk-grid-width-small-1-2 uk-margin-medium-bottom';
} else {
	$columns_container = 'uk-grid-width-medium-1-3 uk-grid-width-small-1-2 uk-margin-medium-bottom';
}
?>

<?php if( get_field('idz-gallery-category') ): ?>

	<ul id="pf-container" class="<?php echo esc_attr($columns_container);?>" data-uk-grid="{gutter: 35, controls: '#filter'}">

	<?php while( has_sub_field('idz-gallery-category') ): ?>

		<?php 

		// vars
		$gallery_images = get_sub_field('idz-category_images');
		$gallery_name_value = get_sub_field('idz-gallery-name');
		$gallery_cat_slug = str_replace(' ', '-', $gallery_name_value);

		foreach ($gallery_images as $gallery_image) :
		?>
			<li  data-uk-filter="<?php echo esc_attr( strtolower($gallery_cat_slug));?>">
	            <figure class="uk-overlay uk-overlay-hover">
	             	<img src="<?php echo esc_url($gallery_image['sizes']['portfolio-thumb']); ?>" alt="<?php echo esc_attr($gallery_image['alt']); ?>"  class="uk-overlay-spin" />
	                <?php if ($lightbox != 'off') { ?>
	                	<div class="uk-overlay-panel uk-overlay-background uk-overlay-icon uk-overlay-fade"></div>
	                	<a class="uk-position-cover" href="<?php echo esc_url($gallery_image['url']);?>" data-uk-lightbox="{group:'<?php echo esc_attr( strtolower($gallery_cat_slug));?>'}" title="<?php echo esc_attr( $gallery_image['title'] );?>"></a>
	                <?php } ?>
	            </figure>
	        </li>
		<?php endforeach; ?>
	<?php endwhile; ?>

	</ul>

<?php endif;?>