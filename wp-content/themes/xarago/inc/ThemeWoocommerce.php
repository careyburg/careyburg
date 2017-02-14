<?php

/**
 * Manages all theme-support-related modifications.
 * @author Indonez
 * @link http://indonez.com
 */
 
if ( ! class_exists( 'XaragoThemeWoocommerce' ) ) :
class XaragoThemeWoocommerce
{
	
	public function __construct()
    {
        // Remove default product title
        remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
        // Add custom heading product title
        add_action('woocommerce_shop_loop_item_title', array($this, 'xarago_product_title'), 11);
        
        // Remove default product permalink
        remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
    	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

        // Add product items container
        add_action( 'woocommerce_before_shop_loop_item', array($this,'xarago_product_container_start'), 21 );
        add_action( 'woocommerce_after_shop_loop_item', array($this,'xarago_product_container_end'), 21 );
        add_action('woocommerce_before_shop_loop', array($this, 'xarago_loop_ulprod_wrapper_start'), 40 );
        add_action('woocommerce_after_shop_loop', array($this, 'xarago_loop_ulprod_wrapper_end'), 6 );
    
        // Add product items overlay
        add_action( 'woocommerce_before_shop_loop_item', array($this,'xarago_product_overlay_start'), 21 );
        add_action( 'woocommerce_before_shop_loop_item', array($this,'xarago_add_custom_button'),21);
        add_action( 'woocommerce_before_shop_loop_item_title', array($this,'xarago_product_overlay_end'), 21 );

        add_action( 'woocommerce_before_shop_loop_item', array($this,'xarago_custom_replace_sale_text'), 21 );

        // yith
        add_filter('yith-wcwl-browse-wishlist-label', array($this, 'xarago_wclc_browse_wishlist_text'));
        
        // Product per page
        add_filter('loop_shop_per_page', array($this, 'xarago_show_products_per_page' ), 20 );
        // Columns loop
        add_filter('loop_shop_columns', array($this, 'xarago_loop_columns'), 999);
        // Related Products
        add_filter('woocommerce_output_related_products_args', array($this, 'xarago_woocommerce_related_products_args'));
        // Remove default shop archive page title
        add_filter('woocommerce_show_page_title', array($this, 'xarago_woocommerce_show_page_title'));
        // Onsale text
        add_filter('woocommerce_sale_flash', array($this, 'xarago_custom_replace_sale_text'));
        
        // Remove default product price
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
        // Remove default add to cart button
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        
        /* Single product title */
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
        add_action( 'woocommerce_single_product_summary', array($this,'xarago_woocommerce_template_single_title'), 5 );

        /* Checkout page */
        add_action( 'woocommerce_before_checkout_form', array($this, 'xarago_order_steps'), 10 );
        add_action( 'woocommerce_before_cart', array($this, 'xarago_order_steps'), 10 );
        
	}
	
	//if woocommerce activated
    public function xarago_is_woocommerce_activated()
    {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
		
    }
	
	//return is_woocommerce function
	public function xarago_is_true_woocommerce(){
		if( function_exists("is_woocommerce") && is_woocommerce()){
		return true;
		}
		return false;
	}
	
	//return is_product function
	public function xarago_is_true_product(){
		if( function_exists("is_product") && is_product()){
		return true;
		}
		return false;
	}
	
	//return is_shop function
	public function xarago_is_true_shop(){
		if( function_exists("is_shop") && is_shop()){
		return true;
		}
		return false;
	}
	
	//return if woocommere page
	public function xarago_is_true_woopage(){
		if( function_exists("is_cart") && is_cart()){
		  return true;
		}elseif(function_exists("is_checkout") && is_checkout()){
		  return true;	
		}elseif(function_exists("is_account_page") && is_account_page()){
		  return true;		
		}
		return false;
	}
	
	//return is_product_category function
	public function xarago_is_true_product_category(){
		if( function_exists("is_product_category") && is_product_category()){
		return true;
		}
		return false;
	}
	
	//disable shop page title
	public function xarago_woocommerce_show_page_title(){
		return false;
	}
	
	
	//header cart icon
	public function xarago_header_cart_widget()
	{
		if($this->xarago_is_woocommerce_activated()){
			
			global $woocommerce, $xarago_opts, $product;

			$cart_subtotal 	= $woocommerce->cart->get_cart_subtotal();
			$cart_url 		= $woocommerce->cart->get_cart_url();
			$checkout_url 	= $woocommerce->cart->get_checkout_url();
			$cart_items 	= $woocommerce->cart->get_cart_item_quantities();
			$items 			= $woocommerce->cart->get_cart();
			$cart_subtotal 	= $woocommerce->cart->get_cart_subtotal();
			$currency		= get_woocommerce_currency_symbol();
			$cart_button = isset($xarago_opts['xarago_header_cart_button'])? $xarago_opts['xarago_header_cart_button']: 0;
			
			$totalqty = 0;
			if(is_array($cart_items)){
				foreach($cart_items as $cart_item){
					$totalqty += (is_numeric($cart_item))? $cart_item : 0;
				}
			}
			
			ob_start();
			echo '<div class="uk-button-dropdown" data-uk-dropdown>';
                echo '<a href=""><span class="uk-icon-button uk-icon-shopping-cart"></span><div class="uk-badge uk-badge-notification uk-badge-danger">'.$totalqty.'</div>'.$cart_subtotal.'</a>';
                echo '<div class="uk-dropdown uk-dropdown-center">';
                    echo '<ul class="uk-nav uk-nav-dropdown idz-product-widget">';
	                	foreach ($items as $item => $val) {
	                		$product_data = $val['data']->post; 
	                		$product_detail = wc_get_product( $val['product_id'] );
	                		$price = get_post_meta($val['product_id'] , '_price', true);

	                        echo '<li class="uk-text-truncate">';
	                            echo '<a href="'.get_permalink($product_data->ID).'">';
	                                echo $product_detail->get_image();
	                                echo '<p>'.esc_attr($product_data->post_title).'</p>';
	                            echo '</a>';
	                            echo '<span>'.esc_attr($val['quantity']).' x '.$currency.''.$price.'</span>';
	                        echo '</li>';
	                    }
	                    echo '<li class="subtotal-price">';
                        echo '<h6>'.esc_html__('Subtotal','xarago').' : ';
                        echo $cart_subtotal;
                        echo '</h6>';
                        echo '</li>';
                        echo '<li>';
                            echo '<a href="'.esc_url($cart_url).'" class="uk-button uk-button-mini idz-button-white uk-width-1-2">'.esc_html__('View cart','xarago').'</a>';
                            echo '<a href="'.esc_url($checkout_url).'" class="uk-button uk-button-mini idz-button-white uk-width-1-2">'.esc_html__('Checkout','xarago').'</a>';
                        echo '</li>';
                    echo '</ul>';

                echo '</div>';
            echo '</div>';

            return ob_get_clean();

		}

	}
	
	//Product item per page
	function xarago_show_products_per_page() {
		global $xarago_opts;
		$show_product = isset($xarago_opts['xarago_products_items']) ? $xarago_opts['xarago_products_items'] :"8";
			
		return $show_product;

	}
	
	//Product column
	function xarago_loop_columns() {
		global $xarago_opts;
		$col = isset($xarago_opts['xarago_product_column']) ? $xarago_opts['xarago_product_column'] :"4";
		
		return $col;
	}
    
    	//Product column
	function xarago_product_container_start() {
        
		echo '<div class="product-content uk-margin-medium-bottom">';
	}
	
    function xarago_product_container_end() {
        
		echo '</div>';
	}
    
	//Product ul wrapper start
	function xarago_loop_ulprod_wrapper_start(){
		
		global $xarago_opts;
		$col = isset($xarago_opts['xarago_product_column']) ? $xarago_opts['xarago_product_column'] :"3";
		
		echo '<div class="woocommerce columns-'.esc_attr($col).'">';
	}

	//Product ul wrapper end
	function xarago_loop_ulprod_wrapper_end(){
		echo '</div>';
	}
	
	
	//Product image wrapper start
	function xarago_product_overlay_start(){
		echo '<figure class="uk-overlay uk-overlay-hover">';
	}

	//Product image wrapper end
	function xarago_product_overlay_end(){
        echo '</figure>';
	}
	
	
	//Product button wrapper start
	function xarago_woocommerce_loop_btn_wrapper_start(){
		echo '<figcaption class="uk-overlay-panel uk-flex uk-flex-middle uk-overlay-background">';
		echo '<div class="xarago-woo-button">';
	}

	//Product button wrapper end
	function xarago_woocommerce_loop_btn_wrapper_end(){
		echo '</div>';
		echo '</figcaption>';
	}
	
	//Custom button
	function xarago_add_custom_button() {
		global $yith_wcwl, $product, $woocommerce, $xarago_opts;
		
		
		$enable = get_option( 'yith-wcqv-enable' ) == 'yes' ? true : false;
		
		if( function_exists( 'YITH_WCWL' ) ){
			$label_option = get_option( 'yith_wcwl_add_to_wishlist_text' );
			$browse_wishlist = get_option( 'yith_wcwl_browse_wishlist_text' );
			$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;
			$wishlist_url = YITH_WCWL()->get_wishlist_url('/');
			

			if( ! empty( $default_wishlists ) ){
				$default_wishlist = $default_wishlists[0]['ID'];
			}
			else{
				$default_wishlist = false;
			}
			
			$exists = YITH_WCWL()->is_product_in_wishlist( $product->id, $default_wishlist );
		}
		
		
		$product_type_external_label = isset($xarago_opts['xarago_product_type_external_labeltext']) ? $xarago_opts['xarago_product_type_external_labeltext'] :"";
		$product_type_grouped_label = isset($xarago_opts['xarago_product_type_grouped_labeltext']) ? $xarago_opts['xarago_product_type_grouped_labeltext'] :"";
		$product_type_variable_label = isset($xarago_opts['xarago_product_type_variable_labeltext']) ? $xarago_opts['xarago_product_type_variable_labeltext'] :"";
		$product_type_simple_label = isset($xarago_opts['xarago_product_type_simple_labeltext']) ? $xarago_opts['xarago_product_type_simple_labeltext'] :"";
		$viewcartlabel = isset($xarago_opts['xarago_viewcartlabeltext']) ? $xarago_opts['xarago_viewcartlabeltext'] :"";
		$infoproductlabel = isset($xarago_opts['xarago_infoproductlabeltext']) ? $xarago_opts['xarago_infoproductlabeltext'] :"";
		
		
		$product_type = $product->product_type;

		switch ( $product_type ) {
			case 'external':
				$but_woo_label = $product_type_external_label;
				$link = $product->get_product_url();
				$icontype = '<i class="fa fa-external-link"></i>';
				$addclass = '';
			break;
			case 'grouped':
				$but_woo_label = $product_type_grouped_label;
				$link = $product->get_permalink();
				$icontype = '<i class="fa fa-eye"></i>';
				$addclass = '';
			break;
			case 'simple':
				$but_woo_label = $product_type_simple_label;
				$link = $product->add_to_cart_url();
				$icontype = '<i class="fa fa-shopping-cart"></i>';
				$addclass = 'ajax_add_to_cart';
			break;
			case 'variable':
				$but_woo_label = $product_type_variable_label;
				$link = $product->get_permalink();
				$icontype = '<i class="fa fa-gear"></i>';
				$addclass = '';
			break;
			default:
				$but_woo_label = esc_html__( 'Read more', 'xarago' );
				$link = $product->get_permalink();
				$icontype = '<i class="fa fa-info"></i>';
				$addclass = '';
		}
		
		
		$out ='';
		
		$out .='<figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-right uk-flex-bottom"><ul class="icon-overlay">';

		$out .= '<li>';
			if( class_exists('YITH_WCWL') ) {
				$out .= YITH_WCWL_Shortcode::add_to_wishlist( 
						array(
							'exists' => $exists,
							'label' => '',
							'product_id' => $product->id,
							'wishlist_url' => $wishlist_url,
							'icon'	=> 'fa-heart'
						)
				);
			}
		$out .= '</li>';
		$out .='<li><a href="'.esc_url($link).'" class="add_to_cart_button product_type_'.esc_attr($product_type).' '.esc_attr($addclass).'" data-product_id="' . esc_attr($product->id) . '" data-product_sku="' . esc_attr($product->sku) . '">'. $icontype .'<span>'.do_shortcode($but_woo_label).'</span></a></li>';

		$out .='</ul></figcaption>';
		
		echo $out;
	}
	
	//Related products
	function xarago_woocommerce_related_products_args( $args ) {
		$args['posts_per_page']     = 4;
		$args['columns']            = 4;
		$args['orderby']            = 'rand';
		return $args;
	}
	
	//Product title
	function xarago_product_title(){
		global $product;
		
		echo '<h6><a href="'.esc_url(get_permalink($product->id)).'">'.get_the_title($product->id).'</a></h6>';
	}
	
    function xarago_woocommerce_template_single_title() {
        global $product;
        echo '<h2><span class="cross-accent">'.get_the_title($product->id).'</span></h2>';   
    }
    
	//Product upsell display
	function xarago_woocommerce_upsell_display(){
		woocommerce_upsell_display( -1, 3);
	}
	
	
	//Wishlist text
	function xarago_wclc_browse_wishlist_text($txtreturn=''){
		global $product;
		
		$browse_wishlist = get_option( 'yith_wcwl_browse_wishlist_text' );
		
		$txtreturn ='';
		$txtreturn .= '<i class="fa fa-check"></i><span>'.esc_html($browse_wishlist).'</span>';
        
        return $txtreturn;
	}
	
	//No stock text
	function xarago_woocommerce_nostock_badge(){
		global $product, $xarago_opts;

		$text = !empty($xarago_opts['xarago_outofstocktext']) ? $xarago_opts['xarago_outofstocktext'] :"";

		if ( !$product->is_in_stock() ) {
			echo '<span class="onsale soldout">'.esc_html($text).'</span>';
		}
		
	}

	//Sale text
	function xarago_custom_replace_sale_text() {
        global $xarago_opts, $product;
		
        $text = !empty($xarago_opts['xarago_saletext']) ? $xarago_opts['xarago_saletext'] :"";
        
        $product_item = wc_get_product( $product->id );
        $terms = wp_get_post_terms( $product->id, 'product_cat');
        
        $out = '';
    	$out .= '<ul class="product-price uk-text-right">';
            $out .= '<li>';
            foreach ($terms as $term) {
                $out .= '<a href="'.get_term_link($term).'"><div class="uk-badge uk-badge-notification uk-badge-warning">'.$term->name.'</div></a>';   
            }
            $out .= '</li>';
        	$out .= '<li>'.$product_item->get_price_html().'</li>';
        $out .= '</ul>';
        if ( $product->is_on_sale() ) {
    		$out .= '<span class="onsale">' . esc_attr($text) . '</span>';
    	}
		  
		echo $out;
		
	}
	
	
    //Custom Price for Domain
	function xarago_woocommerce_add_custom_price( $cart_object ) {
				
		global $woocommerce, $xarago_opts;
		
		$customprice = isset($xarago_opts['xarago_woocommerce_custom_price']) ? $xarago_opts['xarago_woocommerce_custom_price'] :"";
		if($customprice!=""){
		
		$tld = array();
		
		$extensions = $customprice;
		$extensions = preg_replace('/\s+/', '', $extensions);
		$tlds = explode(',', $extensions);
		
		foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {
			if(WC()->session->get( $cart_item_key.'_domain_name')){
				$domain = WC()->session->get( $cart_item_key.'_domain_name');
				list($domain, $ext) = explode('.', $domain, 2);
				
				 foreach ($tlds as $key => $value) {
					$tld = explode('|', $value);
					if($ext == $tld[0]){
						$price = $tld[1];
						$cart_item['data']->price = $price;
					}
				}
			}
		}
		
		}
		
	 }

	 public function xarago_woocommerce_cat_list()  {
	 	$args = array(
		    'orderby'    => 'date',
		    'order'      => 'DESC',
		    'hide_empty' => 0
		);

		$product_categories = get_terms( 'product_cat', $args );
		$count = count($product_categories);
		 if ( $count > 0 ) {
		 	return $product_categories;
		 }
	 }
	 
	/**
	* Custom pagination for WooCommerce instead the default woocommerce_pagination()
	* @uses plugin Prime Strategy Page Navi, but added is_singular() on #line16
	**/
	function woocommerce_pagination() {
		if (function_exists('wp_pagenavi')) {
			wp_pagenavi();
		}
	}

	function xarago_order_steps() {
		$out = '';
		$out .= '<div class="uk-grid uk-grid-divider uk-margin-large-bottom idz-checkout">';
            $out .= '<div class="uk-width-1-3 idz-number-wrap uk-text-center uk-hidden-small">';
                $out .= '<h1>01</h1>';
                $out .= '<h4><span class="line-accent">'.esc_html__('Shopping Cart','xarago').'</span></h4>';
            $out .= '</div>';
            $out .= '<div class="uk-width-1-3 uk-width-small-1-1 idz-number-wrap uk-text-center">';
                $out .= '<h1>02</h1>';
                $out .= '<h4><span class="line-accent">'.esc_html__('Check Out','xarago').'</span></h4>';
            $out .= '</div>';
            $out .= '<div class="uk-width-1-3 idz-number-wrap uk-text-center uk-hidden-small">';
                $out .= '<h1>03</h1>';
                $out .= '<h4 class="line-accent">'.esc_html__('Order Complete','xarago').'</h4>';
            $out .= '</div>';
        $out .= '</div>';

        echo $out;
	}
    
} 
endif;
