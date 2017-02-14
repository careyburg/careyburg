<?php
if ( ! class_exists( 'XaragoUikitMenuCustomField' ) ) :
class XaragoUikitMenuCustomField {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
		
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'Xarago_add_custom_nav_fields' ) );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'Xarago_update_custom_nav_fields'), 10, 3 );
		
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'Xarago_edit_walker'), 10, 2 );

	} // end constructor
	
	
	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	*/
	function Xarago_add_custom_nav_fields( $menu_item ) {
	
	    $menu_item->bgmenu = get_post_meta( $menu_item->ID, '_menu_item_bgmenu', true );
	    return $menu_item;
	    
	}
	
	/**
	 * Save menu custom fields

	*/
	function Xarago_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	
	    // Check if element is properly sent
	    if ( is_array( $_REQUEST['menu-item-bgmenu']) ) {
	        $bgmenu_value = esc_attr($_REQUEST['menu-item-bgmenu'][$menu_item_db_id]);
	        update_post_meta( $menu_item_db_id, '_menu_item_bgmenu', $bgmenu_value );
	    }
	    
	}
	
	/**
	 * Define new Walker edit

	*/
	function Xarago_edit_walker($walker,$menu_id) {
	
	    return 'Xarago_Walker_Nav_Menu_Edit_Custom';
	    
	}

}
// instantiate class
$GLOBALS['Xarago_custom_menu'] = new XaragoUikitMenuCustomField();

include_once( 'XaragoUikitMenuWalkerNavEdit.php' );

endif;