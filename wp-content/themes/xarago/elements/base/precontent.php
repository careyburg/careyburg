<?php 
$sidebar_position = xarago_theme()->helpers->xarago_sidebar_position();
/**
 * element pre content
 * should be rendered directly before the dynamic content
 * handles displaying of the sidebar (or no sidebar)
 * must be closed via the element postcontent
 */
 
?>	
    <section class="uk-padding">
        <div class="uk-container uk-container-center">
            <div class="uk-grid uk-margin-large-bottom">
            
        		<?php if ($sidebar_position=="content-right" && !is_page_template( 'template-sitemap.php' )  && !is_404() && !is_singular('indonez_portfolio') && !is_tax('portfolio_category')) : ?>
                    <?php if (is_home() || is_single()  || is_archive() || is_category()) { ?>
                        <div class="uk-width-3-10 uk-width-medium-1-1 uk-width-small-1-1">
                    <?php } else { ?>
                        <div class="uk-width-1-4 uk-width-medium-1-3 uk-width-small-1-1">
                    <?php } ?>
                        <?php get_sidebar(); ?>
                        </div>
                
                <?php endif; ?>
        		
                <?php if ($sidebar_position != "no-sidebar" && !is_page_template( 'template-sitemap.php' ) && !is_404() && !is_singular('indonez_portfolio') && !is_tax('portfolio_category')) : ?>
                    <?php if (is_home() || is_single() || is_archive() || is_category()) { ?>
                        <div class="uk-width-7-10 uk-width-medium-1-1 uk-width-small-1-1">
                    <?php } else { ?>
                        <div class="uk-width-3-4 uk-width-medium-2-3 uk-width-small-1-1 idz-margin-top-small">
                    <?php } ?>
                <?php else : ?>
                    <div class="uk-width-1-1">
                <?php endif; ?>