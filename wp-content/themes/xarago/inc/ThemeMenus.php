<?php

/**
 * Manages all menu-related modifications.
 * @author Indonez
 * @link http://indonez.com
 */

if ( ! class_exists( 'XaragoThemeMenus' ) ) :
class XaragoThemeMenus
{

    public function __construct()
    {
        // register menus
		register_nav_menus( array(
	        'topmenu' => esc_html__( 'Top Menu','xarago'),
			'main' => esc_html__( 'Main Menu','xarago'),
			'mobile' => esc_html__( 'Mobile Menu','xarago')
		));
    }

} 
endif;