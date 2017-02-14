<?php
$page_id = xarago_theme()->helpers->xarago_get_postid();

if (function_exists('get_field')) {
	$enable_slider = get_field('enable_slider',$page_id);
	$slider = get_field('slider',$page_id);

}
?>

<?php if(function_exists('get_field') && $enable_slider=="yes"){ ?>

<section id="slideshow-container" class="<?php echo esc_attr($slider_container_class);?>">
	<!-- slideshow begin -->
	<div id="homepage-slide" class="uk-slidenav-position"  data-uk-slideshow="{autoplay:true, animation: 'scale',height: '560'}">
	
		<?php if( have_rows('slider') ): ?>
	
		<ul class="uk-slideshow uk-overlay-active">
		
			
			<?php while( have_rows('slider') ): the_row(); ?>
			
			<?php 
			$slider_image = get_sub_field('slider_image');
			$slider_content_type = get_sub_field('slider_content_type');
			$slider_content_type_1 = get_sub_field('slider_content_type_1');
            $slider_content_type_2 = get_sub_field('slider_content_type_2');
            $slider_content_type_3 = get_sub_field('slider_content_type_3');
            $slider_content_type_4 = get_sub_field('slider_content_type_4');
            
            
            if ($slider_content_type == 'content-type-1') {
                $slide_container = "slide-content1";
            } else if ($slider_content_type == 'content-type-2') {
                $slide_container = "slide-content2";
            } else if ($slider_content_type == 'content-type-3') {
                $slide_container = "slide-content3";
            } else if ($slider_content_type == 'content-type-4') {
                $slide_container = "slide-content4";
            }
			?>
			<li>
				<img src="<?php echo esc_url($slider_image);?>" alt="">
				
				<div class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle">
                    <div class="uk-container uk-container-center">
                        <!-- slide text begin -->
                        <div class="<?php echo esc_attr($slide_container);?>">
                            <?php
                                if ($slider_content_type == 'content-type-1') {
                                    echo ($slider_content_type_1);
                                } else if ($slider_content_type == 'content-type-2') {
                                    echo ($slider_content_type_2);
                                } else if ($slider_content_type == 'content-type-3') {
                                    echo ($slider_content_type_3);
                                } else if ($slider_content_type == 'content-type-4') {
                                    echo ($slider_content_type_4);
                                }
                            ?>
                            <div class="uk-clearfix"></div>
                        </div>
                        <!-- slide text end -->
                    </div>
                </div>   					                 
			</li>   
			<?php endwhile; ?>
			
		</ul>
        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>

		<?php endif; ?>
	</div>
	<!-- slideshow end -->
</section>

<?php } else { ?>
	
	<?php get_template_part('elements/base/header-inner'); ?>

<?php }  ?>