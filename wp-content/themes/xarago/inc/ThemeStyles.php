<?php

/**
 * Manages all filter-related modifications.
 * @author Indonez
 * @link http://indonez.com
 */
 
if ( ! class_exists( 'XaragoThemeStyles' ) ) :
class XaragoThemeStyles
{

    public function __construct()
    {
        // Print styleshhet
        add_action('wp_enqueue_scripts', array( $this, 'xarago_add_stylesheet' ), 10 );
		add_action('wp_enqueue_scripts', array( $this, 'xarago_remove_stylesheet' ), 25 );
    }
	
	/**
     * Register google font
     *
     */
	 public function xarago_google_font()
	 {	
		global $xarago_opts;
		
		$fonts_url = '';
		
		$body_google_font = (!empty($xarago_opts['xarago_body_font_typo']['font-family'])) ? $xarago_opts['xarago_body_font_typo']['font-family'] : "";
		$menu_google_font = (!empty($xarago_opts['xarago_menu_typo']['font-family'])) ? $xarago_opts['xarago_menu_typo']['font-family'] : "";
		
		$h1_typo_google_font = (!empty($xarago_opts['xarago_h1_typo']['font-family'])) ? $xarago_opts['xarago_h1_typo']['font-family'] : "";
		$h2_typo_google_font = (!empty($xarago_opts['xarago_h2_typo']['font-family'])) ? $xarago_opts['xarago_h2_typo']['font-family'] : "";
		$h3_typo_google_font = (!empty($xarago_opts['xarago_h3_typo']['font-family'])) ? $xarago_opts['xarago_h3_typo']['font-family'] : "";
		$h4_typo_google_font = (!empty($xarago_opts['xarago_h4_typo']['font-family'])) ? $xarago_opts['xarago_h4_typo']['font-family'] : "";
		$h5_typo_google_font = (!empty($xarago_opts['xarago_h5_typo']['font-family'])) ? $xarago_opts['xarago_h5_typo']['font-family'] : "";
		$h6_typo_google_font = (!empty($xarago_opts['xarago_h6_typo']['font-family'])) ? $xarago_opts['xarago_h6_typo']['font-family'] : "";
		
		$body_font = _x( 'on', $body_google_font.' font: on or off', 'xarago' ); 
		$menu_font = _x( 'on', $menu_google_font.' font: on or off', 'xarago' );
		$h1_font = _x( 'on', $h1_typo_google_font.' font: on or off', 'xarago' );
		$h2_font = _x( 'on', $h2_typo_google_font.' font: on or off', 'xarago' );
		$h3_font = _x( 'on', $h3_typo_google_font.' font: on or off', 'xarago' );
		$h4_font = _x( 'on', $h4_typo_google_font.' font: on or off', 'xarago' );
		$h5_font = _x( 'on', $h5_typo_google_font.' font: on or off', 'xarago' );
		$h6_font = _x( 'on', $h6_typo_google_font.' font: on or off', 'xarago' );
		$montserrat = _x( 'on', 'Montserrat font: on or off', 'xarago' );
		$roboto = _x( 'on', 'Roboto font: on or off', 'xarago' );
		$damion = _x( 'on', 'Damion font: on or off', 'xarago' );
	 
		if ( 'off' !== $body_font || 'off' !== $menu_font || 'off' !== $h1_font || 'off' !== $h2_font 
				|| 'off' !== $h3_font || 'off' !== $h4_font || 'off' !== $h5_font || 'off' !== $h6_font
				|| 'off' !== $montserrat || 'off' !== $roboto 
			) {
				
			$font_families = array();
			
			if ( 'off' !== $body_font ) {
				$font_families[] = $body_google_font.':400,300,400italic,300italic,600,600italic,700,700italic,800,800italic';
			}
			
			if ( 'off' !== $menu_font ) {
				$font_families[] = $menu_google_font.':400,300,400italic,300italic,600,600italic,700,700italic,800,800italic';
			}
			
			if ( 'off' !== $h1_font ) {
				$font_families[] = $h1_typo_google_font.':400,300,400italic,300italic,600,600italic,700,700italic,800,800italic';
			}
			
			if ( 'off' !== $h2_font ) {
				$font_families[] = $h2_typo_google_font.':400,300,400italic,300italic,600,600italic,700,700italic,800,800italic';
			}
			
			if ( 'off' !== $h3_font ) {
				$font_families[] = $h3_typo_google_font.':400,300,400italic,300italic,600,600italic,700,700italic,800,800italic';
			}
			
			if ( 'off' !== $h4_font ) {
				$font_families[] = $h4_typo_google_font.':400,300,400italic,300italic,600,600italic,700,700italic,800,800italic';
			}
			
			if ( 'off' !== $h5_font ) {
				$font_families[] = $h5_typo_google_font.':400,300,400italic,300italic,600,600italic,700,700italic,800,800italic';
			}
			
			if ( 'off' !== $h6_font ) {
				$font_families[] = $h6_typo_google_font.':400,300,400italic,300italic,600,600italic,700,700italic,800,800italic';
			}
			
			if ( 'off' !== $montserrat ) {
				$font_families[] = 'Montserrat:400,400italic,700,700italic';
			}
		 
			if ( 'off' !== $roboto ) {
				$font_families[] = 'Roboto:400,300,400italic,300italic,600,600italic,700,700italic,800,800italic';
			}

			if ( 'off' !== $damion ) {
				$font_families[] = 'Damion:400,300,400italic,300italic,600,600italic,700,700italic,800,800italic';
			}

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext,cyrillic,cyrillic-ext' ),
			);
	 
			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}
	 
		return esc_url_raw( $fonts_url );
		 
	 }
	 
	/**
     * Darker or Lighter Color
     *
     */  
	public function xarago_color_reator($color, $per) 
	{ 
		$color = substr( $color, 1 ); // Removes first character of hex string (#)
		$rgb = ''; // Empty variable 
		$per = $per/100*255; // Creates a percentage to work with. Change the middle figure to control colour temperature
		 
		if  ($per < 0 ) // Check to see if the percentage is a negative number 
		{ 
			// DARKER 
			$per =  abs($per); // Turns Neg Number to Pos Number 
			for ($x=0;$x<3;$x++) 
			{ 
				$c = hexdec(substr($color,(2*$x),2)) - $per; 
				$c = ($c < 0) ? 0 : dechex($c); 
				$rgb .= (strlen($c) < 2) ? '0'.$c : $c; 
			}   
		}  
		else 
		{ 
			// LIGHTER         
			for ($x=0;$x<3;$x++) 
			{             
				$c = hexdec(substr($color,(2*$x),2)) + $per; 
				$c = ($c > 255) ? 'ff' : dechex($c); 
				$rgb .= (strlen($c) < 2) ? '0'.$c : $c; 
			}    
		} 
		return '#'.$rgb; 
	}
	
	/**
     * Darker or Lighter Color
     *
     */ 
	public function xarago_hex_color_to_rgb($Hex){
	   
	if (substr($Hex,0,1) == "#")
		$Hex = substr($Hex,1);

	$R = substr($Hex,0,2);
	$G = substr($Hex,2,2);
	$B = substr($Hex,4,2);

	$R = hexdec($R);
	$G = hexdec($G);
	$B = hexdec($B);

	$RGB['R'] = $R;
	$RGB['G'] = $G;
	$RGB['B'] = $B;

	return $RGB;

	}
	
	 
	/**
     * Custom CSS from theme options
     *
     */ 
	public function xarago_custom_css() 
	{
		
		
		global $xarago_opts;
		
		$darkPercent = -7;
		$lightPercent = 3;
		
	   	$generalcolor     = isset($xarago_opts['xarago_color_scheme']) ? $xarago_opts['xarago_color_scheme'] : '';
		
		$bodyfgoogle = (!empty($xarago_opts['xarago_body_font_typo']['google'])) ? $xarago_opts['xarago_body_font_typo']['google'] : "";
		$bodyfont = (!empty($xarago_opts['xarago_body_font_typo']['font-family'])) ? $xarago_opts['xarago_body_font_typo']['font-family'] : "";
		$bodyfcolor = (!empty($xarago_opts['xarago_body_font_typo']['color'])) ? $xarago_opts['xarago_body_font_typo']['color'] : "";
		$bodyfstyle = (!empty($xarago_opts['xarago_body_font_typo']['font-weight'])) ? $xarago_opts['xarago_body_font_typo']['font-weight'] : "";
		$bodyfsize = (!empty($xarago_opts['xarago_body_font_typo']['font-size'])) ? $xarago_opts['xarago_body_font_typo']['font-size'] : "";
		$bodyflh = (!empty($xarago_opts['xarago_body_font_typo']['line-height'])) ? $xarago_opts['xarago_body_font_typo']['line-height'] : "";
		
		$menufgoogle = (!empty($xarago_opts['xarago_menu_typo']['google'])) ? $xarago_opts['xarago_menu_typo']['google'] : "";
		$menufont = (!empty($xarago_opts['xarago_menu_typo']['font-family'])) ? $xarago_opts['xarago_menu_typo']['font-family'] : "";
		$menufcolor = (!empty($xarago_opts['xarago_menu_typo']['color'])) ? $xarago_opts['xarago_menu_typo']['color'] : "";
		$menufstyle = (!empty($xarago_opts['xarago_menu_typo']['font-weight'])) ? $xarago_opts['xarago_menu_typo']['font-weight'] : "";
		$menufsize = (!empty($xarago_opts['xarago_menu_typo']['font-size'])) ? $xarago_opts['xarago_menu_typo']['font-size'] : "";
		$menuflh = (!empty($xarago_opts['xarago_menu_typo']['line-height'])) ? $xarago_opts['xarago_menu_typo']['line-height'] : "";
		
		
		$HeadingTagTypes    = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
		$i=1;
		foreach($HeadingTagTypes as $type){
		  $headingfgoogle[] = (!empty($xarago_opts['xarago_h'.$i.'_typo']['google'])) ? $xarago_opts['xarago_h'.$i.'_typo']['google'] : "";
		  $headingfont[] = (!empty($xarago_opts['xarago_h'.$i.'_typo']['font-family'])) ? $xarago_opts['xarago_h'.$i.'_typo']['font-family'] : "";
		  $headingfcolor[] = (!empty($xarago_opts['xarago_h'.$i.'_typo']['color'])) ? $xarago_opts['xarago_h'.$i.'_typo']['color'] : "";
		  $headingfstyle[] = (!empty($xarago_opts['xarago_h'.$i.'_typo']['font-weight'])) ? $xarago_opts['xarago_h'.$i.'_typo']['font-weight'] : "";
		  $headingfsize[] = (!empty($xarago_opts['xarago_h'.$i.'_typo']['font-size'])) ? $xarago_opts['xarago_h'.$i.'_typo']['font-size'] : "";
		  $headingflh[] = (!empty($xarago_opts['xarago_h'.$i.'_typo']['line-height'])) ? $xarago_opts['xarago_h'.$i.'_typo']['line-height'] : "";
		  $i++;
		}		
		
		$custom_css = '';
		
		// heading
		$custom_css .=  'h1, body.xarago-whmcs-page h1{color:'.$headingfcolor[0].' ; font: '.$headingfsize[0].' "'.$headingfont[0].'";  font-weight: '.$headingfstyle[0].';  line-height: '.$headingflh[0].';}';
		$custom_css .=  'h2, body.xarago-whmcs-page h2{color:'.$headingfcolor[1].' ; font: '.$headingfsize[1].' "'.$headingfont[1].'";  font-weight: '.$headingfstyle[1].';  line-height: '.$headingflh[1].';}';
		$custom_css .=  'h2.title-section{font: '.$headingfsize[0].' "'.$headingfont[0].'";  font-weight: '.$headingfstyle[0].';  line-height: '.$headingflh[0].';}';
		$custom_css .=  'h3, body.xarago-whmcs-page h3{color:'.$headingfcolor[2].' ; font: '.$headingfsize[2].' "'.$headingfont[2].'";  font-weight: '.$headingfstyle[2].';  line-height: '.$headingflh[2].';}';
		$custom_css .=  'h4, body.xarago-whmcs-page h4{color:'.$headingfcolor[3].' ; font: '.$headingfsize[3].' "'.$headingfont[3].'";  font-weight: '.$headingfstyle[3].';  line-height: '.$headingflh[3].';}';
		$custom_css .=  'h5, body.xarago-whmcs-page h5{color:'.$headingfcolor[4].' ; font: '.$headingfsize[4].' "'.$headingfont[4].'";  font-weight: '.$headingfstyle[4].';  line-height: '.$headingflh[4].';}';
		$custom_css .=  'h6, body.xarago-whmcs-page h6{color:'.$headingfcolor[5].' ; font: '.$headingfsize[5].' "'.$headingfont[5].'";  font-weight: '.$headingfstyle[5].';  line-height: '.$headingflh[5].';}';
		
		// content
		if($generalcolor!=""){
			
			$rgb = $this->xarago_hex_color_to_rgb($generalcolor);
			$hovercolor = $this->xarago_color_reator($generalcolor, $lightPercent);
			
			$menubghover = ($generalcolor=="#010101" ? "#212121" : $generalcolor);
			
			$custom_css .='::selection {
                              background-color: '.$generalcolor.'; 
                            }
							::-moz-selection {
                              background-color: '.$generalcolor.'; 
                            }
							a{color: '.$generalcolor.';}
							a:hover{color: '.$hovercolor.';}
							.section-grey { background: '.$generalcolor.';}
                            .idz-tag-cloud a {border-color : '.$generalcolor.';color: '.$hovercolor.';}
                            .idz-tag-cloud a:hover {background: '.$generalcolor.';color: #fff;}
                            .line-accent {border-color: '.$generalcolor.';}
                            .uk-tab > li > a:hover,.uk-tab > li > a:focus,.uk-tab > li.uk-open > a {color: '.$generalcolor.';}
                            .uk-tab.uk-tab-bottom > li > a:hover,.uk-tab.uk-tab-bottom > li > a:focus,.uk-tab.uk-tab-bottom > li.uk-open > a {color: '.$generalcolor.';}
                            .uk-tab.uk-tab-left > li > a:hover,.uk-tab.uk-tab-left > li > a:focus,.uk-tab.uk-tab-left > li.uk-open > a {color: '.$generalcolor.';}
                            .uk-tab.uk-tab-right > li > a:hover,.uk-tab.uk-tab-right > li > a:focus,.uk-tab.uk-tab-right > li.uk-open > a {color: '.$generalcolor.';}
                            #filter li:after {color: '.$generalcolor.';}
                            #filter.uk-subnav-pill > .uk-active > * {color: '.$generalcolor.';}
                            #filter.uk-subnav-pill > * >:hover,#filter.uk-subnav-pill > * >:focus {color: '.$generalcolor.';}
                            #secondary-info {background: '.$generalcolor.';}
                            .idz-header-list ul li:after {color: '.$generalcolor.';}
                            .idz-header-list .idz-mini-info span.uk-icon-button,.idz-header-list .idz-mini-info span.uk-icon-search {background: '.$generalcolor.';}
                            #header-search button.uk-icon-search {color: '.$generalcolor.';}
                            #pagetitle {border-color: '.$generalcolor.';}
                            #breadcrumb-style a:hover,#breadcrumb-style .uk-active span {color: #010101'.$generalcolor.';}
                            .uk-dropdown {background: '.$generalcolor.';}
                            #slideshow-container .uk-slidenav-previous:before {color: '.$generalcolor.';}
                            #slideshow-container .uk-slidenav-next:before {color: '.$generalcolor.';}
                            .blog-slider .uk-slidenav-previous:before {color: '.$generalcolor.';}
                            .blog-slider .uk-slidenav-next:before {color: '.$generalcolor.';}
                            .idz-bottom-line:after {border-color: '.$generalcolor.';}
                            ul.post-info li:after {color: '.$generalcolor.';}
                            .post-share ul.uk-list li a {color: '.$generalcolor.';}
                            .uk-pagination > li > a {border: 1px solid '.$generalcolor.';color: '.$hovercolor.';}
                            .uk-pagination > li > a:hover,.uk-pagination > li > a:focus {background-color: '.$generalcolor.';}
                            .uk-pagination > .uk-active > span {background-color: '.$generalcolor.';border: 1px solid '.$generalcolor.';}
                            #map,.idz-map {border-bottom: 4px solid '.$generalcolor.';}
                            ul.idz-team-widget li h6 {background: '.$generalcolor.';}
                            .idz-popular-widget li a span {color: '.$generalcolor.';}
                            #product-slide .uk-slidenav-previous:before,#category-slide .uk-slidenav-previous:before {color: '.$generalcolor.';}
                            #product-slide .uk-slidenav-next:before,#category-slide .uk-slidenav-next:before {color: '.$generalcolor.';}
                            ul.product-price li {color: '.$generalcolor.';}
                            ul.product-price li .uk-badge {background: '.$generalcolor.';}
                            .product-content figcaption .uk-button {background: '.$generalcolor.';}
                            .product-content h6 {border-top: 4px solid '.$generalcolor.';color: '.$generalcolor.';}
                            ul.idz-product-widget li h6 span {background: '.$generalcolor.';}
                            .idz-front-post h3.idz-right-title a {background: '.$generalcolor.';}
                            .idz-front-post h3.idz-left-title a {background: '.$generalcolor.';}
                            .idz-home3 i {color: '.$generalcolor.';}
                            .idz-product-desc span.product-price {color: '.$generalcolor.';}
                            .idz-product-desc .product-tag span {color: '.$generalcolor.';}
                            .idz-product-desc .product-tag a:hover {color: '.$generalcolor.';}
                            .idz-product-desc .product-wishlist-share i.uk-icon-heart-o {background: '.$generalcolor.';}
                            .order-complete i.uk-icon-shopping-cart {color: '.$generalcolor.';}
                            .sitemap-wrap li a:hover {color: '.$generalcolor.';}
                            footer .uk-list li a:hover {color: '.$generalcolor.';}
                            #footer-newsletter button.uk-icon-envelope-o {color: '.$generalcolor.';}
                            .idz-social ul li .uk-icon-button,footer .idz-ui-widget .uk-icon-button {background: '.$generalcolor.';}
                            footer .idz-ui-widget ul li a:hover {color: '.$generalcolor.';}
                            .to-top {background: '.$generalcolor.';}
                            aside ul.product_list_widget li span.product-title {background: '.$generalcolor.';}
                            aside .tagcloud a {border: 1px solid '.$generalcolor.';color: '.$hovercolor.';}
                            aside .tagcloud a:hover {background: '.$generalcolor.';}
                            .woocommerce .icon-overlay li a i,.icon-overlay li a i {background: '.$generalcolor.';}
                            .woocommerce .comment-text p.meta strong{color: '.$generalcolor.';}
                            .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span {border: 1px solid '.$generalcolor.';color: '.$hovercolor.';}
                            .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current background-color: '.$generalcolor.';border: 1px solid '.$generalcolor.';}
                            .woocommerce p.price span.amount {color: '.$generalcolor.';}
                            .product_meta span.posted_in,.product_meta span.tagged_as{color: '.$generalcolor.';}
                            .single-product .entry-summary span.amount {color: '.$generalcolor.';}
                            .single-product .yith-wcwl-wishlistexistsbrowse.show a i {background: '.$generalcolor.';}
                            .single-product .yith-wcwl-wishlistexistsbrowse.show a span {color: '.$generalcolor.';}
                            .entry-summary a.add_to_wishlist:before {background-color: '.$generalcolor.';}
                            #yith-wcwl-popup-message {background: '.$generalcolor.';}
                            .woocommerce .cart_totals .wc-proceed-to-checkout .checkout-button{color: '.$generalcolor.';}
                            .woocommerce #payment #place_order, .woocommerce-page #payment #place_order {color: '.$generalcolor.';}
                            .woocommerce .woocommerce-info:before {color: '.$generalcolor.';}
                            #product-slide .icon-overlay li a i {background: '.$generalcolor.' !important;}
                            ul.idz-product-widget.idz-product-shortcode li ins span.amount {color: '.$generalcolor.';}
                            .idz-button-white {color: '.$generalcolor.' !important;}
                            .idz-button-white:hover {color: '.$generalcolor.' !important;}
                            .idz-button-outline {color: '.$generalcolor.' !important;}
                            .woocommerce .checkout.woocommerce-checkout.uk-form .idz-panel {background: '.$generalcolor.';}
                            .idz-button-outline:hover {color: '.$generalcolor.' !important;}
                            aside .uk-list-line li a:hover {color: '.$hovercolor.';}
                            .idz-tag-cloud a {border: 1px solid '.$generalcolor.';color: '.$hovercolor.';}
                            .wp-pagenavi .pages, .wp-pagenavi .extend{border: 1px solid '.$generalcolor.' !important;}
                            .wp-pagenavi a, .wp-pagenavi .current{color: '.$hovercolor.' !important;border: 1px solid '.$generalcolor.' !important;}
                            .wp-pagenavi a:hover, .wp-pagenavi .current {border: 1px solid '.$generalcolor.' !important;background-color: '.$generalcolor.';color: #ffffff !important;}
                            .highlight {background: '.$hovercolor.';}
                            .dropcap1,.dropcap2 {background: '.$hovercolor.';}
                            .dropcap3 {color: '.$hovercolor.';}
                            .uk-tab {border-bottom: 2px solid '.$hovercolor.';}
                            .uk-tab > li.uk-active > a {border-color: '.$hovercolor.';background: '.$hovercolor.';}
                            .uk-tab.uk-tab-bottom {border-top: 2px solid '.$hovercolor.';}
                            .uk-tab.uk-tab-bottom > li.uk-active > a {border-color: '.$hovercolor.';background: '.$hovercolor.';}
                            .uk-tab.uk-tab-left {border-right: 2px solid '.$hovercolor.';}
                            .uk-tab.uk-tab-left > li.uk-active > a {border-color: '.$hovercolor.';background: '.$hovercolor.';}
                            .uk-tab.uk-tab-right {border-left: 2px solid '.$hovercolor.';}
                            .uk-tab.uk-tab-right > li.uk-active > a {border-color: '.$hovercolor.';background: '.$hovercolor.';}
                            .uk-tab-center {border-bottom: 2px solid '.$hovercolor.';}
                            h6.uk-accordion-title.uk-active {background: '.$hovercolor.';}
                            .pricing-column .pricing-title i {background: '.$hovercolor.';}
                            .pricing-column .pricing-button {background: '.$hovercolor.';}
                            .idz-team-panel {background: '.$hovercolor.';}
                            .idz-header-list li .uk-dropdown {background: '.$hovercolor.';}
                            .slide-content2 h2 {color: '.$hovercolor.';}
                            .slide-content4 h1 {color: '.$hovercolor.';}
                            .slide-content4 h1 span {border-top: 3px solid '.$hovercolor.';border-bottom: 3px solid '.$hovercolor.';}
                            .slide-content4 h2 {color: '.$hovercolor.';}
                            .slide-content4 h4 {color: '.$hovercolor.';}
                            .uk-pagination > li > a {border: 1px solid '.$generalcolor.';color: '.$hovercolor.';}
                            .idz-product-panel {background: '.$hovercolor.';}
                            .idz-slide-thumb > .uk-active > * img {border: 1px solid '.$hovercolor.';}
                            #contact-form button {background: '.$hovercolor.';}
                            .idz-social ul li .uk-icon-button:hover {background: '.$hovercolor.';}
                            aside .product-categories li a:hover {color: '.$hovercolor.';}
                            aside .tagcloud a {border: 1px solid '.$generalcolor.';color: '.$hovercolor.';
                            .woocommerce div.product .woocommerce-tabs ul.tabs:before{border-bottom: 2px solid '.$hovercolor.';}
                            .woocommerce div.product .woocommerce-tabs ul.tabs li {border-bottom-color:'.$hovercolor.';}
                            .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span {border: 1px solid '.$generalcolor.';color: '.$hovercolor.';}
                            .woocommerce .cart-collaterals .cart_totals, .woocommerce-page .cart-collaterals .cart_totals {background: '.$hovercolor.';}
                            .idz-panel.grey {background: '.$hovercolor.';}
                            .idz-table-grey thead {background: '.$hovercolor.';}
                            aside.widget_categories ul  li a:hover, aside.widget_archive ul  li a:hover {color: '.$hovercolor.' !important;}
                            .idz-header-list li .uk-dropdown li { border-color: '.$hovercolor.' !important;}
                            ';
							
		}
		
		// font
		$custom_css .='body {color:'.$bodyfcolor.' ; font: '.$bodyfsize.' '.$bodyfont.';  font-weight: '.$bodyfstyle.';  line-height: '.$bodyflh.';}';
		$custom_css .='#mainmenu > ul > li > a  {color: '.$menufcolor.';  font-size: '.$menufsize.';  line-height: '.$menuflh.';  font-family: '.$menufont.';}';
		
		// custom css
		if (!empty($xarago_opts['xarago_custom_css'])) {
		  $custom_css .= $xarago_opts['xarago_custom_css'];
		}
		
		if (!empty($xarago_opts['xarago_custom_css_tl'])) {
		  $custom_css .= '@media only screen and (min-width: 769px) and (max-width: 1024px){'.$xarago_opts['xarago_custom_css_tl'].'}';
		}
		
		if (!empty($xarago_opts['xarago_custom_css_tp'])) {
		  $custom_css .= '@media only screen and (min-width: 768px) and (max-width: 959px){'.$xarago_opts['xarago_custom_css_tp'].'}';
		}
		
		if (!empty($xarago_opts['xarago_custom_css_ml'])) {
		  $custom_css .= '@media only screen and (min-width: 480px) and (max-width: 767px){'.$xarago_opts['xarago_custom_css_ml'].'}';
		}
		
		if (!empty($xarago_opts['xarago_custom_css_mp'])) {
		  $custom_css .= '@media only screen and (max-width: 479px){'.$xarago_opts['xarago_custom_css_mp'].'}';
		}
			
		return $custom_css;
	
	}

    /**
     * Register stylesheet
     *
     */
    public function xarago_add_stylesheet()
    {
	 

	   global $xarago_opts, $XaragoTheme;
	   $woo_activated = $XaragoTheme->xaragowoo->xarago_is_woocommerce_activated();
	   
	   wp_enqueue_style( 'xarago-fonts', $this->xarago_google_font(), array(), null );
	   
	   if(!class_exists('IndonezUIShortcodes')) {
		   wp_enqueue_style('xarago-uikit',  get_template_directory_uri().'/css/uikit.css' , '', '', 'screen, all');
	   }
	   
	   wp_register_style('xarago-slideshow',  get_template_directory_uri().'/css/components/slideshow.css' , '', '', 'screen, all');
	   wp_enqueue_style('xarago-slideshow');
	   
	   wp_register_style('xarago-mediaelement',  get_template_directory_uri().'/css/mediaelement.css' , '', '', 'screen, all');
	   wp_enqueue_style('xarago-mediaelement');
	   
	   wp_register_style('xarago-woocommerce',  get_template_directory_uri().'/css/components/woocommerce-theme.css' , '', '', 'screen, all');
	   wp_enqueue_style('xarago-woocommerce');
	   
	   wp_register_style('xarago-stylesheet', get_bloginfo( 'stylesheet_url' ), '', '', 'all');
       wp_enqueue_style('xarago-stylesheet');
	   
	   $responsive = isset($xarago_opts['xarago_responsive_enabled']) ? $xarago_opts['xarago_responsive_enabled'] :1;
	   if($responsive==1){
		 wp_register_style('xarago-responsive',  get_template_directory_uri().'/css/mediaquery.css' , '', '', 'screen, all');
		 wp_enqueue_style('xarago-responsive');  
	   }

	   if ($woo_activated) {
	   		if (is_account_page()) {
		   		wp_register_style('xarago-woo-form-account',  get_template_directory_uri().'/css/components/woocommerce-form-account.css' , '', '', 'screen, all');
			 	wp_enqueue_style('xarago-woo-form-account');  
		 	}
	   }

	   wp_register_style('xarago-style-custom', get_template_directory_uri().'/css/style-custom.css', '', '', 'screen, all');
       wp_enqueue_style('xarago-style-custom');
	   
	   $custom_css = $this->xarago_custom_css();
       wp_add_inline_style( 'xarago-style-custom', $custom_css);
	   
	   
	   
    }
	
	/**
     * Deregister stylesheet
     *
     */
	public function xarago_remove_stylesheet()
	{
        wp_deregister_style('mediaelement');
        wp_deregister_style('wp-mediaelement');
    }
	
} 
endif;