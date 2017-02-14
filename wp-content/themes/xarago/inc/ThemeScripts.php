<?php

/**
 * Manages all filter-related modifications.
 * @author Indonez
 * @link http://indonez.com
 */

if ( ! class_exists( 'XaragoThemeScripts' ) ) :
class XaragoThemeScripts
{

    public function __construct()
    {
        // Print theme js
        add_action('wp_enqueue_scripts', array( $this, 'xarago_add_javascripts' ), 10 );
		
    }
	

    /**
     * Register theme js
     *
     */
    public function xarago_add_javascripts()
    {	
		global $XaragoTheme;
		$page_id = $XaragoTheme->helpers->xarago_get_postid();

		 //If Indonez UI Shortcodes plugin deactivate or not installed
	     if(!class_exists('IndonezUIShortcodes')) {
		 wp_enqueue_script( 'idz-ui-uikit', get_template_directory_uri() . '/js/components/uikit.js', array( 'jquery'), '', true );
		 }
		 
		 //comment reply
		 if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
		 
		 //portfolio
		 if(is_page_template('template-gallery.php')){
			 
			wp_enqueue_script('idz-ui-lightbox');
			wp_enqueue_script('idz-ui-isotope');
			wp_enqueue_script('idz-ui-portfolio'); 
			
		 }
		 
		 //post slideshow
		 if(class_exists('IndonezUIShortcodes')) {
			 $format = get_post_format();
			 if ( $format == 'gallery'  ) {
				wp_enqueue_script( 'idz-ui-slideshow' );
				wp_enqueue_script( 'idz-ui-slideshowfx' ); 
				wp_enqueue_script( 'xarago-post-slideshow', get_template_directory_uri() . '/js/post-slideshow.js', array( 'jquery'), '', true  );
			 }
			 wp_enqueue_script('idz-ui-tooltip');
		 }
		 
		 //slideshow
		 if (function_exists('get_field')) {
			$enable_slider = get_field('enable_slider',$page_id);
			if($enable_slider=="yes"){
				wp_enqueue_script( 'idz-ui-slideshow' );
				wp_enqueue_script( 'idz-ui-slideshowfx' );
			}
		 }
		 
		 wp_enqueue_script('xarago-mediaelement', get_template_directory_uri() . '/js/mediaelement.js', array( 'jquery'), '', true  );
		 wp_enqueue_script('xarago-topcart', get_template_directory_uri() . '/js/cart.js', array( 'jquery'), '', true  );
		 wp_enqueue_script('xarago-theme-functions', get_template_directory_uri() . '/js/theme-functions.js', array( 'jquery'), '', true  );

    }

} 
endif;