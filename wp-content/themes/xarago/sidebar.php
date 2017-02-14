<?php
/**
 * Default template for sidebar
 * @author Indonez
 * @link http://indonez.com
 */
?>

<aside class="idz-ui-sidebar">
<?php
if (function_exists('get_field')) {
	
	if(xarago_theme()->xaragowoo->xarago_is_true_woocommerce()){
		$theid = woocommerce_get_page_id( 'shop' );
	}else{
		$theid = get_the_ID();
	}
	
    $page_sidebar_widget = get_field('sidebar_widget', $theid);
}
if(is_search()){
	if ( is_active_sidebar('idz-ui-sidebar-main' ) ) { 
		dynamic_sidebar( 'idz-ui-sidebar-main' ); 
	}	
}elseif(!empty($page_sidebar_widget)) { 
		dynamic_sidebar( $page_sidebar_widget);
}else{
	if ( is_active_sidebar('idz-ui-sidebar-main' ) ) { 
		dynamic_sidebar( 'idz-ui-sidebar-main' ); 
	}		
}
?>
</aside>