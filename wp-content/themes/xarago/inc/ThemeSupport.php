<?php

/**
 * Manages all theme-support-related modifications.
 * @author Indonez
 * @link http://indonez.com
 */
 
if ( ! class_exists( 'XaragoThemeSupport' ) ) :
class XaragoThemeSupport
{

    public function __construct()
    {
        // add HTML5 support
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

        // add Featured Image support
        add_theme_support('post-thumbnails');
		set_post_thumbnail_size( 200, 200 );
		
		add_image_size( 'portfolio-thumb', 458, 500, true ); //portfolio thumbnail

		// add wp-title
		add_theme_support( 'title-tag' );
		
		// add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		
		// add post format
		add_theme_support( 'post-formats', array('gallery', 'image', 'video', 'audio', 'link', 'quote'));
		
		// this theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
		
		//add woocommerce
		add_theme_support( 'woocommerce' );
		
    }

} 
endif;