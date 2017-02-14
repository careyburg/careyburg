<?php

/**
 * 404 error pages
 * @author Indonez
 * @link http://indonez.com
 */

get_header();

get_template_part('elements/base/header');

get_template_part('elements/base/precontent');

$page_not_found_text = isset($xarago_opts['xarago_404_text']) ? $xarago_opts['xarago_404_text'] :"";
?>

	<div class="uk-width-5-10 uk-width-large-6-10 uk-width-medium-6-10 uk-width-small-9-10 uk-container-center error404-wrap">
		<div class="uk-panel uk-panel-box idz-ui-panel blue uk-text-contrast">
			<h1 class="uk-text-contrast"><?php esc_html_e('oops! 404 ','xarago');?> <i class="uk-icon-puzzle-piece"></i></h1>
			<p><?php echo esc_attr($page_not_found_text) ? esc_attr($page_not_found_text) : esc_html__('The page you are looking for might have been removed had its name changed or is temporarily unavailable','xarago');?></p>
			
		</div>                            
	</div>
    <div class="uk-width-5-10 uk-width-large-6-10 uk-width-medium-8-10 uk-width-small-1-1 uk-container-center error404-wrap">
        <div class="uk-panel-box idz-panel grey uk-text-contrast">
            <h1 class="uk-text-contrast"><?php esc_html_e('oops! 404 ','xarago');?><i class="uk-icon-puzzle-piece"></i></h1>
            <?php echo esc_attr($page_not_found_text) ? esc_attr($page_not_found_text) : esc_html__('The page you are looking for might have been removed<br/> had its name changed or is temporarily unavailable','xarago');?>
            <hr class="uk-margin-medium-top uk-margin-medium-bottom" />
            <h4 class="uk-text-contrast"><?php echo esc_html__('you can go to this link','xarago');?></h4>
            <div class="uk-clearfix"></div>
        </div>
    </div>

<?php

get_template_part('elements/base/postcontent');

get_template_part('elements/base/footer');

get_footer();
?>