<?php
/**
 * element for navigation and offcanvas navigation
 */
 
$nav = wp_nav_menu(array(
    'theme_location' => 'main',
    'menu_class'     => 'uk-navbar-nav uk-hidden-small',
    'depth'          => 3,
    'walker'         => new XaragoUikitMenuWalker('navbar'),
	'echo'           => false,
	'fallback_cb'    => false
));


$location = (!has_nav_menu( 'mobile' ) ? 'main' : 'mobile');

$nav_offcanvas = wp_nav_menu(array(
    'theme_location' => $location,
    'menu_class'     => 'uk-nav uk-nav-offcanvas uk-nav-parent-icon',
    'depth'          => 3,
	'items_wrap'     => '<ul id="%1$s" class="%2$s" data-uk-nav>%3$s</ul>',
    'walker'         => new XaragoUikitMenuWalker('offcanvas'),
    'echo'           => false,
    'fallback_cb'    => false
));

?>
  
<?php if ($nav) : ?>
    <nav id="mainmenu" class="uk-navbar">
        <?php echo $nav; ?>
        <a href="#mobile-nav" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
    </nav>
	
    <div id="mobile-nav" class="uk-offcanvas">
        <div class="uk-offcanvas-bar">
            <?php echo $nav_offcanvas; ?>
        </div>
    </div>
    
<?php else :  ?>
	
<?php echo xarago_theme()->helpers->xarago_menu_page_fallback();?>

<?php endif; ?>