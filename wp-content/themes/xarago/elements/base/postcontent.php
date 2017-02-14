<?php 
$sidebar_position = xarago_theme()->helpers->xarago_sidebar_position();
/**
 * element post content
 * should be rendered directly after the dynamic content
 * handles displaying of the sidebar (or no sidebar)
 * must be opend via the element precontent
 */

?>              
                </div>
                
                <?php if ($sidebar_position=="content-left"  && !is_page_template( 'template-sitemap.php' ) && !is_404() && !is_singular('indonez_portfolio') && !is_tax('portfolio_category')) : ?>
                	<?php if (is_home() || is_single() || is_archive() || is_category()) { ?>
                        <div class="uk-width-3-10 uk-width-medium-1-1 uk-width-small-1-1">
                    <?php } else { ?>
                        <div class="uk-width-1-4 uk-width-medium-1-3 uk-width-small-1-1">
                	<?php } ?>
                        <?php get_sidebar(); ?>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
    </section>                