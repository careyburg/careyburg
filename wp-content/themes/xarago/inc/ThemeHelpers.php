<?php

/**
 * Provides some helpers to use within the views.
 * @author Indonez
 * @link http://indonez.com
 */
 
if ( ! class_exists( 'XaragoThemeHelpers' ) ) :
class XaragoThemeHelpers
{
	
	
	 public function __construct()
	 {
		
		add_action( 'wp_head', array($this, 'xarago_wp_head'), 0);
		add_action( 'xarago_post_format', array($this, 'xarago_post_format'));
		add_action( 'xarago_post_thumbnail', array($this, 'xarago_post_thumbnail'));
		add_action( 'xarago_post_meta', array($this, 'xarago_post_meta'));
		add_action( 'xarago_post_social_share', array($this, 'xarago_post_social_share'));
		
		 
	 }
	 
	 
	 
	 /**
     * Main menu fallback
     */
	public function xarago_wp_head() {
        
		global $xarago_opts;
		
		echo '<meta charset="'.get_bloginfo('charset').'"/>';
		echo '<meta name="format-detection" content="telephone=no" />';

 		$responsive = isset($xarago_opts['xarago_responsive_enabled']) ? $xarago_opts['xarago_responsive_enabled'] :1;
		if($responsive==1):
			echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />';
		endif;

		echo '<link rel="pingback" href="'.get_bloginfo('pingback_url').'"/>';

		$favico = !empty($xarago_opts['xarago_custom_favicon']['url']) ? $xarago_opts['xarago_custom_favicon']['url'] : '';
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
		echo '<link rel="shortcut icon" href="'.esc_url($favico).'" type="image/x-icon"/>';
		}

		$appleicon = !empty($xarago_opts['xarago_custom_apple_icon']['url']) ? $xarago_opts['xarago_custom_apple_icon']['url'] : '';
		echo '<link rel="apple-touch-icon-precomposed" href="'.esc_url($appleicon).'">';


		echo '<!--[if lt IE 9]><script src="'.get_template_directory() . '/js/html5.js'.'"></script><![endif]-->';
	
    }
	
    /**
     * Display an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index
     * views, or a div element when on single views.
     */
    public function xarago_post_thumbnail()
    {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) {
			echo '<div class="blog-picture">';
            the_post_thumbnail('large');
			echo '</div>';
			
        } else {
			echo '<div class="blog-picture">';
            echo '<a href="'.esc_url(get_permalink()).'">';
            the_post_thumbnail('large');
            echo '</a>';
			echo '</div>';
        }
    }
	

	/**
     * Main menu fallback
     */
	public function xarago_menu_page_fallback() {
        
        print '<div class="fallbackmenu">' .esc_html__('Please manage your menu items from Appearances => Menus first','xarago') .'</div>';
    }
	
	/**
     * Get Post ID
     */
	public function xarago_get_postid()
	{
		if (in_the_loop()) {
           $post_id = get_the_ID();
        }elseif( function_exists( 'is_woocommerce' ) && is_shop() ){
			$post_id = woocommerce_get_page_id( 'shop' );
		}elseif( function_exists( 'is_woocommerce' ) && is_product_category() ){
			$post_id = woocommerce_get_page_id( 'shop' );
		}elseif( function_exists( 'is_woocommerce' ) && is_product_tag() ){
			$post_id = woocommerce_get_page_id( 'shop' );
		}elseif( function_exists( 'is_woocommerce' ) && is_product() ){
			$post_id = woocommerce_get_page_id( 'shop' );
		}else {
			global $wp_query;
			$post_id = $wp_query->get_queried_object_id();
		}
		
		return $post_id;
	}
	
	
	/**
     * Sidebar Position
     */
	public function xarago_sidebar_position()
	{
		
		global $xarago_opts, $wp_query, $woocommerce;
		
		//post layout
		$post_layout = (!empty($xarago_opts['xarago_post_sidebar'])) ? $xarago_opts['xarago_post_sidebar'] : "sidebar-right"; 
		
		//get page id
		$page_id = $this->xarago_get_postid();
		
		//get page layout
		if (function_exists('get_field')) {
		  $page_layout = get_field('page_layout',$page_id);	
		}else{
		  $page_layout = '';	
		}
		
		
		//position sidebar
		if ( $wp_query->is_page || xarago_theme()->xaragowoo->xarago_is_true_woocommerce()) {
			$position =  $page_layout;
		}else{
			$position =  $post_layout;
		}
		
		if ($position=="sidebar-right") {
    		$sidebar_position = "content-left";
    	} elseif ($position=="sidebar-left") {
    		$sidebar_position ="content-right";
    	} else {
    		$sidebar_position ="no-sidebar";
    	}
    
    	return $sidebar_position;
		
	}
	
	
	/**
     * Post Format
     */
	public function xarago_post_format()
	{
		
		global $post;
		
		if (function_exists('get_field')) {
			$gallery_set = get_field('gallery_set');
			$video_type = get_field('video_type');
			$video = get_field('video_url');
			$video_yv = get_field('youtube_or_vimeo');
			$audio_type = get_field('audio_type');
			$audio = get_field('audio_url');
			$soundcloud = get_field('soundcloud_url');
			$link = get_field('link_url');  
			$quote_text = get_field('quote_text');
			$quote_info_text = get_field('quote_info');  			
		} else {
			$gallery_set = '';
			$video = '';
			$audio = '';
			$link = '';
			$quote_text = '';
			$quote_info_text = '';  	
		}
		
		$format = get_post_format();
		
		if ( $format == 'gallery'  ) {
			
			if ($gallery_set) {
				
				
				echo '<div class="blog-slider uk-slidenav-position" data-uk-slideshow="{height: '.'373'.'}">';
                    echo '<ul class="uk-slideshow">';
						foreach ($gallery_set as $gallery) {
							echo '<li><img src="'.esc_url($gallery['sizes']['large']).'" alt="'.esc_attr($gallery['alt']).'"/></li>';
						}
					echo '</ul>';
					
					echo '<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>';
					echo '<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>';
					
				echo '</div>';
				
				
            } else {
			
                the_post_thumbnail('large');
            }
			
		}elseif($format == 'video'){
			
			if($video_type=='self_hosted'){
				
				echo '<div class="iframe-video">';
				  echo '<source src="'.esc_url($video).'">';
				echo '</video>';
				
			}else{
			
				echo '<div class="iframe-video">';
				echo $video_yv;
				echo '</div>';
			}
			
			
		}elseif($format == 'audio'){
			
			if($soundcloud!="" || $audio!=""){
				if ($audio_type=='soundcloud') {
					echo '<div class="idz-ui-audio-container">';
					echo $soundcloud;
					echo '</div>';	
				
				}else{
					
					echo '<div class="blog-audio">';
					echo '<audio preload="auto" controls>';
						echo '<source src="'.esc_url($audio).'" />';
					echo '</audio>';
					echo '</div>';
				
				}
			}
			
		}elseif($format == 'link'){
			
			if($link!=""){
				echo '<div class="blog-link uk-text-truncate">';
				echo '<a href="'.esc_url($link).'" target="_blank">';
				echo esc_html($link);
				echo '</a>';
				echo '</div>';
			}
			
		}elseif($format == 'quote'){
			
			if($quote_text!=""){
			echo '<div class="blog-quote">';			
				echo '<blockquote><p>'.wp_kses_post($quote_text).'</p><cite>'.esc_html($quote_info_text).'</cite></blockquote>'; 
			echo '</div>';
			}
			
		}else{
			
			do_action('xarago_post_thumbnail');
			
		}
		
	}
	
	
	/**
     * Post Meta
     */
	public function xarago_post_meta()
	{
		
		global $xarago_opts;
		 
		$authormeta = isset($xarago_opts['xarago_author_meta'])? $xarago_opts['xarago_author_meta']: 1;
		$postdatemeta = isset($xarago_opts['xarago_postdate_meta'])? $xarago_opts['xarago_postdate_meta']: 1;
		$postcatmeta = isset($xarago_opts['xarago_postcat_meta'])? $xarago_opts['xarago_postcat_meta']: 1;
		

		print '<ul class="uk-list post-info">';
		
			if($authormeta==1){
			printf(
	            '<li><a href="%1$s" rel="author">%2$s</a></li>',
	            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
	            get_the_author()
	        );
			}
			
			if($postdatemeta==1){
			printf(
	            '<li><time datetime="%1$s">%2$s</time></li>',
		            esc_attr(get_the_date('c')),
		            esc_html(get_the_date())
		        );
			}
			
			if($postcatmeta==1){
				print '<li>'.get_the_category_list(', ').'</li>';
			}
            
            if( has_tag() ) {
                print '<li>'.get_the_tags().'</li>';            
            } else {
                print '';
            }
            
			
			$format = get_post_format();
			
			print '<li>';
			$icon = ($format=='quote' ? 'uk-icon-quote-right' :($format=='link' ? 'uk-icon-link' : ($format=='audio' ? 'uk-icon-volume-up' : ($format=='video' ? 'uk-icon-video-camera' :($format=='image' ? 'uk-icon-image' : ($format=='gallery' ? 'uk-icon-image' : 'uk-icon-file-text-o'))))));
			print '<div class="idz-ui-post-type">';
				print ' <i class="'.esc_attr($icon).'"></i> ';
			print '</div>';
			print '</li>';
			
			edit_post_link(esc_attr__('Edit', 'xarago'), '<li>', '</li>');
			
		print '</ul>';
		
		
	}
	
	/**
     * Post Social Share
     */
	public function xarago_post_social_share()
	{
		global $post, $xarago_opts;
		
		$socialshare = isset($xarago_opts['xarago_social_share'])? $xarago_opts['xarago_social_share']: 1;
		
		if($socialshare==1){
		echo '<ul class="uk-list idz-social-share uk-hidden-small">';
				echo'<li><a href="http://www.facebook.com/share.php?u='.esc_url(get_permalink($post->ID)).'" class="uk-icon-facebook"></a></li>';
				echo'<li><a href="http://twitter.com/home?status='.esc_attr(get_the_title()).'+'.esc_url(get_permalink($post->ID)).'" class="uk-icon-twitter"></a></li>';
				echo'<li><a href="https://plus.google.com/share?&url='.esc_url(get_permalink($post->ID)).'" class="uk-icon-google-plus"></a></li>';
				echo'<li><a href="http://pinterest.com/pin/create/button/?url=' . esc_url(get_permalink($post->ID)) . '"  class="uk-icon-pinterest-p"></a></li>';
		echo '</ul>';
		}
		
		
	}
	

	/**
     * Check mobile device
     */
	
	public function xarago_ui_wp_is_mobile() {
    static $is_mobile;

    if ( isset($is_mobile) )
        return $is_mobile;

    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        $is_mobile = false;
    } elseif (
        strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
            $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
            $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
        $is_mobile = false;
    } else {
        $is_mobile = false;
    }

    return $is_mobile;
	}
	
 

    /**
     * Displays the pagination for the posts overview page (and search and archive)
     */
    public function xarago_get_posts_pagination() {

    	if (function_exists('wp_pagenavi')) {
    		wp_pagenavi();
    	} else {
    		$pagination = paginate_links(array('type' => 'array', 'mid_size' => 3, 'prev_next' => false));

	        if ($pagination == null) return;

	        $returner = array();
	        $returner[] = '<ul class="uk-pagination">';
	        $returner[] = '<li class="uk-pagination-previous">' . get_previous_posts_link() . '</li>';

	        for ($i = 0; $i < sizeof($pagination); $i++) {
	            $returner[] = '<li class="uk-hidden-small">' . $pagination[$i] . '</li>';
	        }

	        $returner[] = '<li class="uk-pagination-next">' . get_next_posts_link() . '</li>';
	        $returner[] = '</ul>';

	        return implode('', $returner);
    	}
    }

} 

endif;