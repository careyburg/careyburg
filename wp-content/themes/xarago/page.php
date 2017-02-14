<?php
/**
 * Default Template
 * @author Indonez
 * @link http://indonez.com
 */

get_header();
?>
<section id="main-container">
<?php
get_template_part('elements/base/header');

get_template_part('elements/base/precontent');

if (have_posts()) {
	
    while (have_posts()) {
        the_post();
		
		get_template_part('elements/content/content-page');
    }
	
} else {
	
    echo '<p>' . esc_html__('Nothing found here. Sorry!', 'xarago') . '</p>';
}

get_template_part('elements/base/postcontent');
?>

</section>

<?php
get_template_part('elements/base/footer');

get_footer();
