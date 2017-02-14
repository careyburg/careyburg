<?php
/**
 * Default template file
 * @author Indonez
 * @link http://indonez.com
 */

get_header();

echo '<section id="main-container">';

get_template_part('elements/base/header');

get_template_part('elements/base/precontent');

if (have_posts()) {
	
    while (have_posts()) {
        the_post();
		
		if(is_page()){
			get_template_part('elements/content/content-page');	
		}else{
			get_template_part('elements/content/content');
		}
    }

    // Previous/next page navigation.
    echo xarago_theme()->helpers->xarago_get_posts_pagination();

	
} else {
	
    echo '<p>' . esc_html__('Nothing found here. Sorry!', 'xarago') . '</p>';
}

get_template_part('elements/base/postcontent');

echo '</section>';

get_template_part('elements/base/footer');

get_footer();