<?php

/**
 * Manages all sidebar-related modifications.
 * @author Indonez
 * @link http://indonez.com
 */

if ( ! class_exists( 'XaragoThemeSidebars' ) ) :
class XaragoThemeSidebars
{

    function __construct()
    {
		
		add_action( 'widgets_init', array($this, 'xarago_widgets_init'));

    }
	
	function xarago_widgets_init() {
    
		global $xarago_opts;
		
        // register main sidebar
        register_sidebar(array(
            'name'          => esc_html__('Post Sidebar', 'xarago'),
            'id'            => 'idz-ui-sidebar-main',
            'description'   => esc_html__('Main Sidebar on the right/left side.', 'xarago'),
            'before_widget' => '<aside id="%1$s" class="%2$s idz-ui-widget">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="uk-margin-medium-bottom"><span class="line-accent">',
            'after_title'   => '<span></h4>',
        ));
        
         // register main sidebar
        register_sidebar(array(
            'name'          => esc_html__('Shop Sidebar', 'xarago'),
            'id'            => 'idz-ui-sidebar-shop',
            'description'   => esc_html__('Main Sidebar on the right/left side.', 'xarago'),
            'before_widget' => '<div id="%1$s" class="%2$s idz-ui-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="uk-margin-medium-bottom"><span class="line-accent">',
            'after_title'   => '<span></h4>',
        ));

        // register bottom left sidebar
        register_sidebar(array(
            'name'          => esc_html__('Top Footer Left', 'xarago'),
            'id'            => 'idz-ui-sidebar-top-footer-left',
            'description'   => esc_html__('Top footer left sidebar.', 'xarago'),
            'before_widget' => '<div id="%1$s" class="%2$s idz-ui-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="idz-ui-widget-title">',
            'after_title'   => '</h4>'
        ));

        // register bottom right sidebar
        register_sidebar(array(
            'name'          => esc_html__('Top Footer Right', 'xarago'),
            'id'            => 'idz-ui-sidebar-top-footer-right',
            'description'   => esc_html__('Top footer right sidebar.', 'xarago'),
            'before_widget' => '<div id="%1$s" class="%2$s idz-ui-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="idz-ui-widget-title">',
            'after_title'   => '</h4>'
        ));

        // register footer sidebar
        register_sidebar(array(
            'name'          => esc_html__('Footer 1', 'xarago'),
            'id'            => 'idz-ui-sidebar-footer1',
            'description'   => esc_html__('Footer sidebar, show on first column.', 'xarago'),
            'before_widget' => '<div id="%1$s" class="%2$s idz-ui-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>'
        ));
		
		register_sidebar(array(
            'name'          => esc_html__('Footer 2', 'xarago'),
            'id'            => 'idz-ui-sidebar-footer2',
            'description'   => esc_html__('Footer sidebar, show on second column.', 'xarago'),
            'before_widget' => '<div id="%1$s" class="%2$s idz-ui-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>'
        ));
		
		register_sidebar(array(
            'name'          => esc_html__('Footer 3', 'xarago'),
            'id'            => 'idz-ui-sidebar-footer3',
            'description'   => esc_html__('Footer sidebar, show on third column.', 'xarago'),
            'before_widget' => '<div id="%1$s" class="%2$s idz-ui-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>'
        ));
		
		register_sidebar(array(
            'name'          => esc_html__('Footer 4', 'xarago'),
            'id'            => 'idz-ui-sidebar-footer4',
            'description'   => esc_html__('Footer sidebar, show on fourth column.', 'xarago'),
            'before_widget' => '<div id="%1$s" class="%2$s idz-ui-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>'
        ));
		
		// register custom sidebar
		if(!empty($xarago_opts['xarago_sidebars']) && $xarago_opts['xarago_sidebars'] !=""){
    	   
           if (is_array($xarago_opts['xarago_sidebars'])) {
                $sidebars = $xarago_opts['xarago_sidebars'];
                $i = 0;
        		foreach ( $sidebars as $sidebar) {
        		  $i++;
        		  $sidebar_id = str_replace(' ','-',$sidebar.'-'.$i);
                  if ( function_exists( 'register_sidebar' ) ) {
                      register_sidebar(array(
            			 'name'               => esc_attr($sidebar),
            			 'id'                 => strtolower($sidebar_id),
            			 'description'        => esc_html__('A Custom sidebar created from Appearance >> Theme Options >> Sidebars.', 'xarago'),
            			 'before_widget'      => '<aside id="%1$s" class="%2$s idz-ui-widget">',
            			 'after_widget'       => '</aside>',
            			 'before_title'       => '<h4 class="uk-margin-medium-bottom"><span class="line-accent">',
            			 'after_title'        => '<span></h4>',
            		  ));  
                  }
        		} 
           }  
    
    	}
	
	
	}

} 
endif;