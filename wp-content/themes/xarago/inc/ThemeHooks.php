<?php

/**
 * Manages all filter-related modifications.
 * @author Indonez
 * @link http://indonez.com
 */
 
if ( ! class_exists( 'XaragoThemeHooks' ) ) :
class XaragoThemeHooks
{

    public function __construct()
    {
        
        add_action('xarago_header_section', array( $this, 'xarago_header_part_section'));
        add_action('xarago_slider_section', array( $this, 'xarago_slider_part_section'));
        add_action('xarago_social_icon', array( $this, 'xarago_social_icon'));
        add_action('xarago_footer_section', array( $this, 'xarago_footer_part_section'));
        add_action( 'show_user_profile', array( $this,'idz_show_extra_profile_fields' ));
        add_action( 'edit_user_profile', array( $this,'idz_show_extra_profile_fields' ));
        add_action( 'personal_options_update', array( $this,'idz_save_extra_profile_fields' ));
        add_action( 'edit_user_profile_update', array( $this,'idz_save_extra_profile_fields' ));
        add_action('pre_get_posts', array( $this,'advanced_search_query'), 1000);
    }
	

    /**
     * Header section
     *
     */
    public function xarago_header_part_section()
    {
	 	
		global $post, $xarago_opts, $woocommerce, $XaragoTheme;
		 
		 $site_logo = (!empty($xarago_opts['xarago_custom_logo']['url']))? $xarago_opts['xarago_custom_logo']['url']: get_template_directory_uri().'/images/logo.svg';
		 $xarago_header_cart_button = isset($xarago_opts['xarago_header_cart_button'])? $xarago_opts['xarago_header_cart_button']: 0;
         $xarago_header_top_menu = isset($xarago_opts['xarago_header_top_menu'])? $xarago_opts['xarago_header_top_menu']: 0;
         $xarago_header_search = isset($xarago_opts['xarago_header_search'])? $xarago_opts['xarago_header_search']: 0;
         
         $cart_bar = $XaragoTheme->xaragowoo->xarago_header_cart_widget();
         $product_cat = $XaragoTheme->xaragowoo->xarago_woocommerce_cat_list();
        
         $out ='';
         
         $out .='<header>';
            $out .='<div id="primary-info">';
                $out .='<div class="uk-container uk-container-center">';
                    $out .='<div class="uk-grid">';
                        $out .='<div class="uk-width-1-2 uk-width-medium-1-1 uk-width-small-1-1">';
                            $out .='<!-- main logo begin -->';
                            $out .='<div id="logo">';
                                $out .='<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($site_logo).'" alt="'.esc_attr(get_bloginfo('name')).'"/></a>';
                            $out .='</div>';
                            $out .='<div id="slogan">';
                                $out .='<p>'.esc_attr(get_bloginfo('description')).'</p>';
                            $out .='</div>';
                            $out .='<!-- main logo end -->';
                        $out .='</div>';
                        $out .='<div class="uk-width-1-2 uk-width-medium-1-1 uk-width-small-1-1">';
                            $out .='<!-- top info begin -->';
                            $out .='<div class="idz-header-list">';
                                if ($xarago_header_cart_button == 1 || $xarago_header_top_menu == 1) {
                                    $out .='<ul class="uk-list uk-align-right">';
                                        if ($xarago_header_cart_button == 1) {
                                            $out .='<li class="idz-mini-info">'.$cart_bar.'</li>';
                                        }
                                        if ($xarago_header_top_menu == 1) {
                                            $out .= wp_nav_menu(array(
                                                'theme_location' => 'topmenu',
                                                'container'      => false, 
                                                'menu_class'     => false,
                                                'items_wrap'     => '%3$s',
                                                'depth'          => 1,
                                                'walker'         => '',
                                                'echo'           => false,
                                                'fallback_cb'    => false
                                                )
                                            );
                                        }
                                    $out .='</ul>';
                                }

                                if ($xarago_header_search == 1 ) {
                                    $out .= '<form id="header-search" class="uk-form uk-hidden-medium uk-hidden-small" role="search" method="get" action="'.esc_url( get_permalink( woocommerce_get_page_id( 'shop' ) ) ).'">';
                                        $out .='<fieldset>';
                                        $out .= '<!-- With this hidden input you can define a specific post type. -->';
                                        $out .= '<input type="search" placeholder="'.esc_attr__( 'Search', 'xarago' ).'" value="'.get_search_query().'" name="s" title="'.esc_attr__( 'Search for:', 'xarago' ).'" />';
                                       	$out .= '<input type="hidden" name="post_type" value="product" />';
                                        $out .= '<select name="category">';
                                            $out .= '<option value="">'.esc_attr__('All Categories','xarago').'</option>';
                                            foreach ($product_cat as $cat ) {
                                                $out .= '<option value="'.$cat->slug.'">'.esc_attr($cat->name).'</option>';
                                            } 
                                        $out .= '</select>';
                                        $out .= '<button type="submit"  class="uk-button uk-icon-search"></button>';
                                        $out .='</fieldset>';
                                    $out .= '</form>';
                                }
                            $out .='</div>';
                            $out .='<!-- top info end -->';
                        $out .='</div>';
                        
                        $out .='<div class="uk-width-1-1">';
                            $out .='<div id="secondary-info">';
                                ob_start();
                                get_template_part('elements/base/navigation');
                                $out .= ob_get_clean();
                            $out .='</div>';
                        $out .='</div>';
                        
                    $out .='</div>';
                $out .='</div>';
            $out .='</div>';
        $out .='</header>';
			
		echo $out;
	  
    }
	
	/**
     * Slider Section
     *
     */
	
	
	public function xarago_slider_part_section(){
	
	ob_start();
	get_template_part('elements/base/slideshow');
	$out = ob_get_clean();
	echo $out;
	
	}

	
	/**
     * Social Icon
     *
     */
	 
	 public function xarago_social_icon()
	 {
		 
		global $xarago_opts;
		 
    	$get_social_icon = array('facebook','twitter','instagram', 'rss', 'linkedin', 'flickr','googleplus', 'dribbble' , 'pinterest', 'youtube', 'vimeo', 'tumblr', 'behance', 'soundcloud');
		
		$customsocial = isset($xarago_opts['customsocial']) ? $xarago_opts['customsocial'] : '';
    	
    	  echo '<ul class="social-icon">';
    	  
    		if($get_social_icon){
    			foreach($get_social_icon as $social_link) {
    				if(!empty($xarago_opts[$social_link])) { 
    					echo '<li><a href="'. esc_url($xarago_opts[$social_link]) .'" title="'. esc_attr($social_link) .'"  target="_blank"><i class="fa fa-'.esc_attr($social_link).'"></i></a></li>';
    				}								
    			}
    			if(!empty($xarago_opts['skype'])) { 
    			echo '<li><a href="skype:'. esc_attr($xarago_opts['skype']) .'?call" title="'. esc_attr($xarago_opts['skype']) .'" class="skype-bgcolor"  target="_blank"><i class="fa fa-skype"></i></a></li>';
    			}	
    		}		
    		
    		if($customsocial!=""){echo wp_kses($customsocial, array('li'=>array(), 'a'=>array('href'=>array(), 'title'=>array(), 'target'=>array()), 'i'=>array('class'=>array())));}
			
    	 echo '</ul>';
		 
		 
	 }
	 
	 
	 /**
     * Footer Section
     *
     */
	 
	 
	 public function xarago_footer_part_section()
	 {
		 
		global $xarago_opts;
		 
		$footertext = (!empty($xarago_opts['xarago_footer_text'])) ? $xarago_opts['xarago_footer_text'] : esc_html__("&copy; 2015 - All rights reserved. Theme by indonez.",'xarago');
		$xarago_top_footer_section = isset($xarago_opts['xarago_top_footer_section'])? $xarago_opts['xarago_top_footer_section']: 0;
		
		 $out='';
		 
		 $out.='<footer>';
             $out .='<div class="uk-container uk-container-center">';
                if ($xarago_top_footer_section == 1) {
                     $out .='<div class="uk-grid">';
                        $out .='<div id="left-footer-content" class="uk-width-1-2 uk-width-small-1-1">';
                           if ( is_active_sidebar( 'idz-ui-sidebar-top-footer-left' ) ) :
                                ob_start();
                                dynamic_sidebar( 'idz-ui-sidebar-top-footer-left' );
                                $out .= ob_get_clean();
                            else :
                                $out .='<span>'.esc_html__('Add widget to WP Admin &rarr; Appearance &rarr; Widgets &rarr; Top Footer Left','xarago').'</span>';  
                            endif;  
                        $out .='</div>';
                        $out .='<div id="right-footer-content" class="uk-width-1-2 uk-width-small-1-1">';
                            if ( is_active_sidebar( 'idz-ui-sidebar-top-footer-right' ) ) :
                                ob_start();
                                dynamic_sidebar( 'idz-ui-sidebar-top-footer-right' );
                                $out .= ob_get_clean();
                            else :
                                $out .='<span>'.esc_html__('Add widget to WP Admin &rarr; Appearance &rarr; Widgets &rarr; Top Footer Right','xarago').'</span>';  
                            endif;  
                        $out .='</div>';
                    $out .='</div>';
                }
                $out .='<hr>';
                $out .='<div class="uk-grid">';
                    $out .='<div class="uk-width-1-4 uk-width-medium-1-3 uk-width-small-1-1">';
                        if ( is_active_sidebar( 'idz-ui-sidebar-footer1' ) ) :
                            ob_start();
                            dynamic_sidebar( 'idz-ui-sidebar-footer1' );
                            $out .= ob_get_clean();
                        else :
                            $out .='<span>'.esc_html__('Add widget to WP Admin &rarr; Appearance &rarr; Widgets &rarr; Footer1 Sidebar','xarago').'</span>';  
                        endif;  
                    $out .='</div>';
                    $out .='<div class="uk-width-1-4 uk-width-medium-1-3 uk-width-small-1-1">';
                       if ( is_active_sidebar( 'idz-ui-sidebar-footer2' ) ) :
                            ob_start();
                            dynamic_sidebar( 'idz-ui-sidebar-footer2' );
                            $out .= ob_get_clean();
                        else :
                            $out .='<span>'.esc_html__('Add widget to WP Admin &rarr; Appearance &rarr; Widgets &rarr; Footer1 Sidebar','xarago').'</span>';  
                        endif;  
                    $out .='</div>';
                    $out .='<div class="uk-width-1-4 uk-width-medium-1-3 uk-width-small-1-1">';
                        if ( is_active_sidebar( 'idz-ui-sidebar-footer3' ) ) :
                            ob_start();
                            dynamic_sidebar( 'idz-ui-sidebar-footer3' );
                            $out .= ob_get_clean();
                        else :
                            $out .='<span>'.esc_html__('Add widget to WP Admin &rarr; Appearance &rarr; Widgets &rarr; Footer1 Sidebar','xarago').'</span>';  
                        endif;  
                    $out .='</div>';
                    $out .='<div class="uk-width-1-4 uk-width-medium-1-1 uk-width-small-1-1">';
                        if ( is_active_sidebar( 'idz-ui-sidebar-footer4' ) ) :
                            ob_start();
                            dynamic_sidebar( 'idz-ui-sidebar-footer4' );
                            $out .= ob_get_clean();
                        else :
                            $out .='<span>'.esc_html__('Add widget to WP Admin &rarr; Appearance &rarr; Widgets &rarr; Footer1 Sidebar','xarago').'</span>';  
                        endif;  
                    $out .='</div>';
                $out .='</div>';
                $out .='<div class="uk-grid uk-margin-large-top uk-margin-large-bottom">';
                    $out .='<div class="uk-width-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-text-right">';
                        $out.='<p class="copyright-text">'.wp_kses_post($footertext).'</p>';
                    $out .='</div>';
                $out .='</div>';
            $out .='</div>';
            $out .='<a href="#top" class="to-top uk-icon-arrow-circle-o-up" data-uk-smooth-scroll></a>';    
        $out.='</footer>';
		
		
		echo $out;
		 
	 }

     /* Add Custom Info for User */
    public function idz_show_extra_profile_fields( $user ) { ?>

        <h3><?php esc_attr__('Extra profile information','xarago');?></h3>

        <table class="form-table">
            <tr>
                <th><label for="facebook">Facebook</label></th>

                <td>
                    <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php esc_attr__('Please enter your facebook profile url. Example: https://www.facebook.com/indonez','xarago');?></span>
                </td>
            </tr>
            
            <tr>
                <th><label for="twitter">Twitter</label></th>

                <td>
                    <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php esc_attr__('Please enter your twitter profile url. Example: https://twitter.com/indonezTheme','xarago');?></span>
                </td>
            </tr>
            
            <tr>
                <th><label for="instagram">Instagram</label></th>

                <td>
                    <input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php esc_attr__('Please enter your instagram profile url. Example: http://instagram.com/insideenvato/','xarago');?></span>
                </td>
            </tr>
            
            <tr>
                <th><label for="linkedin">Linkedin</label></th>

                <td>
                    <input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php esc_attr__('Please enter your linkedin profile url. Example: https://au.linkedin.com/in/joshjanssen','xarago');?></span>
                </td>
            </tr>

        </table>
    <?php }

    /* Save additional user info */
    public function idz_save_extra_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;

        update_user_meta( $user_id, 'twitter', sanitize_text_field($_POST['twitter']));
        update_user_meta( $user_id, 'facebook', sanitize_text_field($_POST['facebook']));
        update_user_meta( $user_id, 'instagram', sanitize_text_field($_POST['instagram']));
        update_user_meta( $user_id, 'linkedin', sanitize_text_field($_POST['linkedin']));
    }

    // advanced search functionality
    function advanced_search_query($query) {

        if($query->is_search()) {
            // category terms search.
            if (isset($_GET['category']) && !empty($_GET['category'])) {
                $query->set('tax_query', array(array(
                    'taxonomy' => '',
                    'field' => 'slug',
                    'terms' => array($_GET['category']) )
                ));
            }    
            return $query;
        }
    }

} 

endif;