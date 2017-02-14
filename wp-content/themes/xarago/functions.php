<?php
require get_template_directory().'/inc/Theme.php';



/**
 * Theme setup function
 * @author Indonez
 * @link http://indonez.com
 */
if (!function_exists('xarago_wp_setup')) {
	add_action('after_setup_theme', 'xarago_wp_setup');
    function xarago_wp_setup()
    {
        global $XaragoTheme;
        $XaragoTheme = new XaragoTheme();
		
		// make theme available for translation
		load_theme_textdomain( 'xarago', get_template_directory() . '/languages' );
		
    }
   
}


/**
 * Global Xarago Theme Variable.
 */
if (!function_exists('xarago_theme')) {
	function xarago_theme(){
		global $XaragoTheme;
		return $XaragoTheme;
	}
}

/**
 * Global Theme Options Variable.
 */
if (!function_exists('xarago_opts')) {
	function xarago_opts(){
		 global $xarago_opts;
		 return $xarago_opts; 
	}
}


/**
 * Register the required plugins for this theme.
 */
add_action( 'tgmpa_register', 'xarago_register_required_plugins' );
function xarago_register_required_plugins() {
	$plugins = array(
        array(
			'name'     				=> esc_html__('Advanced Custom Fields Pro','xarago'), // The plugin name
			'slug'     				=> 'advanced-custom-fields-pro', // The plugin slug (typically the folder name)
			'source'   				=> esc_url('http://indonez.com/xarago-plugins/advanced-custom-fields-pro.zip'), // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.4.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
        array(
			'name'     				=> esc_html__('Indonez Ui Shortcodes','xarago'), // The plugin name
			'slug'     				=> 'indonez-ui-shortcodes', // The plugin slug (typically the folder name)
			'source'   				=> esc_url('http://indonez.com/xarago-plugins/indonez-ui-shortcodes.zip'), // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> esc_html__('Redux Framework','xarago'), // The plugin name
			'slug'     				=> 'redux-framework', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
		),
        array(
			'name'     				=> esc_html__('ACF: Sidebar Selector','xarago'), // The plugin name
			'slug'     				=> 'acf-sidebar-selector-field', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__('Contact Form 7','xarago'), // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__('WooCommerce','xarago'), // The plugin name
			'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
		),
        array(
			'name'     				=> esc_html__('YITH WooCommerce Wishlist','xarago'), // The plugin name
			'slug'     				=> 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__('WP Pagenavi','xarago'), // The plugin name
			'slug'     				=> 'wp-pagenavi', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__('Breadcrumb Navxt','xarago'), // The plugin name
			'slug'     				=> 'breadcrumb-navxt', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__('Envato WordPress Toolkit','xarago'), // The plugin name
			'slug'     				=> 'envato-wordpress-toolkit', // The plugin slug (typically the folder name)
			'source'   				=> esc_url('http://indonez.com/xarago-plugins/envato-wordpress-toolkit.zip'), // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
	);
    
	$config = array(
		'id'           => 'xarago',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'xarago' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'xarago' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'xarago' ),
			'updating'                        => esc_html__( 'Updating Plugin: %s', 'xarago' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'xarago' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'xarago'
			),
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'xarago'
			),
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'xarago'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'xarago'
			),
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'xarago'
			),
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'xarago'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'xarago'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'xarago'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'xarago'
			),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'xarago' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'xarago' ),
			'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'xarago' ),
			'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'xarago' ),
			'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'xarago' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'xarago' ),
			'dismiss'                         => esc_html__( 'Dismiss this notice', 'xarago' ),
			'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'xarago' ),
			'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'xarago' ),
			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
	);
	tgmpa( $plugins, $config );
}

/*-----------------------------------------------------------------------------------
  Custom Comments Display
-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'indonez_comment' ) ) {
    function indonez_comment($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
       <li <?php esc_attr(comment_class()); ?> id="comment-<?php esc_attr(comment_ID()); ?>">
          <div class="avatar"><?php echo get_avatar( $comment, 64, 64 ); ?></div>
          <div class="comment-text" >
          <?php
    		$name = get_comment_author();
    		$wordarray = explode(' ', $name); 
    		if (count($wordarray) > 1 ) { 
    		$wordarray[count($wordarray)-2] = ''.($wordarray[count($wordarray)-2]).''; 
    		$name = implode(' ', $wordarray);  
    		}
    		?>
          <h4 class="heading-name"><?php echo esc_attr($name); ?></h4>
          <small><?php printf(esc_attr('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></small>
          <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    
          <?php if ($comment->comment_approved == '0') : ?>
          <em><?php esc_attr__('Your comment is awaiting moderation.', 'xarago');?></em>
          <div class="clear"></div>
          <?php endif; ?>
          <?php comment_text()?>
          <small>
          <?php edit_comment_link(esc_attr__('Edit',  'xarago'),'  ','') ?>
          </small>
          </div>
    <?php
    }    
}

/*-----------------------------------------------------------------------------------
  Output the styling for the seperated pings
-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'indonez_list_pings' ) ) {
    function indonez_list_pings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
        <li id="comment-<?php esc_attr(comment_ID()); ?>"><?php comment_author_link(); ?></li>
    <?php }   
}