<?php

/**
 * Manages all filter-related modifications.
 * @author Indonez
 * @link http://indonez.com
 */
if ( ! class_exists( 'XaragoThemeFilters' ) ) :
class XaragoThemeFilters
{

    public function __construct()
    {
		
		add_filter( 'body_class',  array($this, 'xarago_body_class_attr'));
		
		// Allow shortcode in contact form 7
		add_filter( 'wpcf7_form_class_attr',  array($this, 'xarago_form_class_attr'));
		
		// Allow shortcode in wp nav menu
		add_filter('wp_nav_menu',  array($this, 'xarago_do_menu_shortcodes')); 
		
		// Remove height/width images in content editor
		add_filter( 'post_thumbnail_html', array($this, 'xarago_remove_thumb_dimensions'), 10);
		add_filter( 'image_send_to_editor', array($this, 'xarago_remove_thumb_dimensions'), 10);
		
		// Allow upload SVG to media library
		add_filter( 'upload_mimes', array($this, 'xarago_wpcontent_svg_mime_type'));
		
		// Add custom link to menu
		add_filter('wp_nav_menu_items', array($this, 'xarago_add_custom_link_to_menu'), 10, 2 );
		
		// remove automatic responsive iamge in WP 4.4
		add_filter( 'max_srcset_image_width', create_function( '', 'return 1;' ) );
		
		// Search Form
		add_filter( 'get_search_form', array($this, 'xarago_search_form'), 10);

		add_filter( 'wp_kses_allowed_html', array($this,'xarago_allowed_html'), 10, 2 );
		
    }
	
	/**
     * Body Class filter
     *
     */
	
	public function xarago_body_class_attr( $class ) {
	
		global $xarago_opts, $post;
		$id = ( isset( $post->ID ) ? get_the_ID() : "" );
		
		$addclass = '';
                
		$bodyclass = array('XaragoTheme', $addclass);
		
		$class[] = implode(" ",$bodyclass);
		
		return $class;
		
		
	}
	
	
	
	/**
     * Contact form 7 filter
     *
     */
	
	public function xarago_form_class_attr( $class ) {
		$class .= ' uk-form';
		return $class;
	}
	
	/**
     * Add Shortcode in Menu
     *
     */
	public function xarago_do_menu_shortcodes( $menu ){ 
		return do_shortcode( $menu ); 
	}

	
	/**
     * Add custom logout link to registered menu
     *
     */
	public function xarago_add_custom_link_to_menu( $items, $args ) {
		 
		 if ($args->theme_location == 'registered_user') {
			 
			 $items .='<li><a href="'.esc_url(wp_logout_url(get_permalink())).'"><i class="uk-icon-sign-out"></i>'.esc_html__('Logout', 'xarago').'</a></li>';
		}
		 
		 return $items;
	 }
	 
	/**
     * Search Form
     *
     */
	public function xarago_search_form( $form ) {
		
		global $xarago_opts;
		
		$searchtype = isset($xarago_opts['xarago_search_type']) ? $xarago_opts['xarago_search_type'] :"1";
		
		if($searchtype==2){
			$showinput = '<input type="hidden" name="post_type" value="product" />';
		}else{
			$showinput = '';
		}
		
		$form = '<form method="get" class="uk-form searchform" action="' . esc_url(home_url( '/' )) . '" >
		<fieldset>
			<div class="uk-form-icon">
				<i class="uk-icon-search"></i>
				<input type="search" value="' . get_search_query() . '" name="s" placeholder="'.esc_attr__('Search and type enter...','xarago').'"/>'.$showinput.'
				
			</div>
			</fieldset>
		</form>';

		return $form;
	}
	
	/**
     * Remove height/width images in content editor
     *
     */
	public function xarago_remove_thumb_dimensions( $html ) {
		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		return $html;
	}
	
	public function xarago_wpcontent_svg_mime_type( $mimes = array() ) {
	  $mimes['svg']  = 'image/svg+xml';
	  $mimes['svgz'] = 'image/svg+xml';
	  return $mimes;
	}

	function xarago_allowed_html( $tags, $context ){
		$tags['br'] = array();
		return $tags;
	}
	
} 
endif;