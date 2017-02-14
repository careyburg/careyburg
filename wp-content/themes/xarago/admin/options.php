<?php
    /**
     * ReduxFramework Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */
    
    if ( ! class_exists( 'Redux_Framework_Init' ) ) {

        class Redux_Framework_Init {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }

            }

            public function initSettings() {

                // Just for demo purposes. Not needed per say.
                $this->theme = wp_get_theme();

                // Set the default arguments
                $this->setArguments();

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }


                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }
            
            public function setSections() {

                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
				$sample_patterns_path = get_stylesheet_directory(). '/images/bg/';
                $sample_patterns_url  = get_stylesheet_directory_uri() . '/images/bg/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;
                
                // ACTUAL DECLARATION OF SECTIONS
                $this->sections[] = array(
                    'icon'   => 'el-icon-cogs',
                    'title'  => esc_html__( 'General', 'xarago' ),
                    'fields' => array(
						array(
							'id'        => 'xarago_responsive_enabled',
							'type'      => 'switch',
							'title'     => esc_html__('Responsive Layout', 'xarago'),
							'subtitle'  => esc_html__('Activate the responsive layout. If enabled, the website will change its shape for mobile devices.', 'xarago'),
							'default'   => 1
						),
						array(
							'id'        => 'xarago_custom_favicon',
							'type'      => 'media',
							'url'       => true,
							'readonly' => false,
							'title'     => esc_html__('Custom Favicon', 'xarago'),
							'subtitle'  => esc_html__('Upload a 16px x 16px PNG/GIF image that will represent your website`s favicon.', 'xarago')
						),
						array(
							'id'        => 'xarago_custom_apple_icon',
							'type'      => 'media',
							'url'       => true,
							'readonly' => false,
							'title'     => esc_html__('Apple touch icon precomposed 144x144 px', 'xarago'),
							'subtitle'  => esc_html__('Upload a PNG image for third generation iPad with high resolution Retina display.', 'xarago')
						),
						array(
							'id'        => 'xarago_custom_logo',
							'type'      => 'media',
							'url'       => true,
							'readonly' => false,
							'title'     => esc_html__('Custom Logo', 'xarago'),
							'subtitle'  => esc_html__('Upload an image that will represent your website`s logo.', 'xarago')
						),
						 array(
                            'id'       => 'xarago_404_text',
                            'type'     => 'textarea',
                            'title'    => esc_html__( '404 Text', 'xarago' ),
                            'subtitle' => esc_html__( 'Place here your text 404 page not found message.', 'xarago' )
                        )
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-website',
                    'title'  => esc_html__( 'Header', 'xarago' ),
                    'fields' => array(
						array(
							'id'        => 'xarago_header_cart_button',
							'type'      => 'switch',
							'title'     => esc_html__('Header Cart Button', 'xarago'),
							'subtitle'  => esc_html__('Enable or disable cart button in header section', 'xarago'),
							'default'   => 0
						),
                        array(
                            'id'        => 'xarago_header_top_menu',
                            'type'      => 'switch',
                            'title'     => esc_html__('Header Top Menu', 'xarago'),
                            'subtitle'  => esc_html__('Enable or disable top menu in header section', 'xarago'),
                            'default'   => 0
                        ),
						array(
							'id'        => 'xarago_header_breadcrumb',
							'type'      => 'switch',
							'title'     => esc_html__('Page Header BreadCrumb', 'xarago'),
							'subtitle'  => esc_html__('Enable or disable breadcrumb navigation in header section', 'xarago'),
							'default'   => 1
						),
						array(
							'id'        => 'xarago_header_search',
							'type'      => 'switch',
							'title'     => esc_html__('Page Header Search', 'xarago'),
							'subtitle'  => esc_html__('Enable or disable search form in header section', 'xarago'),
							'default'   => 1
						)
                    )
                );
				
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-website-alt',
                    'title'  => esc_html__( 'Footer', 'xarago' ),
                    'fields' => array(
                        array(
                            'id'        => 'xarago_top_footer_section',
                            'type'      => 'switch',
                            'title'     => esc_html__('Top Foooter Section', 'xarago'),
                            'subtitle'  => esc_html__('Enable or disable top footer content section', 'xarago'),
                            'default'   => 1
                        ),
						array(
                            'id'       => 'xarago_footer_text',
                            'type'     => 'editor',
                            'title'    => esc_html__( 'Footer Text', 'xarago' ),
                            'subtitle' => esc_html__( 'Place here your copyright line.', 'xarago' ),
                            'default'  => '&copy; 2015 All rights reserved | Designed by Indonez.',
                        ),
						
                    )
                );
				
			
				$this->sections[] = array(
                    'icon'   => 'el-icon-pencil',
                    'title'  => esc_html__( 'Posts', 'xarago' ),
                    'fields' => array(
						array(
							'id'        => 'xarago_post_sidebar',
							'type'      => 'image_select',
							'title'     => esc_html__('Post Sidebar Layout', 'xarago'),
							'subtitle'  => esc_html__('Select post sidebar position. It will be applied to single posts, index page, archive and search pages.', 'xarago'),
							'options'   => array(
								'sidebar-right' => array('alt' => 'Sidebar Right',  'img' => get_template_directory_uri() . '/admin/assets/img/2cr.png'),
								'sidebar-left' => array('alt' => 'Sidebar Left',  'img' => get_template_directory_uri() . '/admin/assets/img/2cl.png'),
								'no-sidebar' => array('alt' => 'No Sidebar',  'img' => get_template_directory_uri() . '/admin/assets/img/1col.png')
							),
							'default'   => 'sidebar-right'
						),
						array(
							'id'        => 'xarago_blog_title',
							'type'      => 'text',
							'title'     => esc_html__('Blog Title', 'xarago'),
							'subtitle'  => esc_html__('Enter Blog Title.', 'xarago'),
							'default'   => '',
						), 
                        array(
                            'id'        => 'xarago_readmore_text_opt',
                            'type'      => 'switch',
                            'title'     => esc_html__('Readmore', 'xarago'),
                            'subtitle'  => esc_html__('If the option is on, the name of author will be displayed on post.', 'xarago'),
                            'default'   => 1
                        ), 
						array(
							'id'        => 'xarago_readmore_text',
							'type'      => 'text',
							'title'     => esc_html__('Readmore text', 'xarago'),
							'subtitle'  => esc_html__('Replace read more text in blog posts.', 'xarago'),
							'default'   => '',
						), 
                        array(
                            'id'    => 'xarago_author_meta_info',
                            'type'  => 'info',
                            'title' => esc_html__('Post Meta info', 'xarago'),
                            'style' => 'warning',
                            'desc'  => esc_html__('Some settings for post meta info', 'xarago')
                        ),
						array(
							'id'        => 'xarago_author_meta',
							'type'      => 'switch',
							'title'     => esc_html__('Author Name', 'xarago'),
							'subtitle'  => esc_html__('If the option is on, the name of author will be displayed on post.', 'xarago'),
							'default'   => 1
						), 
						array(
							'id'        => 'xarago_comment_meta',
							'type'      => 'switch',
							'title'     => esc_html__('Comment Count', 'xarago'),
							'subtitle'  => esc_html__('If the option is on, the comment count will be displayed on post.', 'xarago'),
							'default'   => 1
						),
						array(
							'id'        => 'xarago_postdate_meta',
							'type'      => 'switch',
							'title'     => esc_html__('Post Date', 'xarago'),
							'subtitle'  => esc_html__('If the option is on, the post date will be displayed on post.', 'xarago'),
							'default'   => 1
						),
						array(
							'id'        => 'xarago_postcat_meta',
							'type'      => 'switch',
							'title'     => esc_html__('Post Category', 'xarago'),
							'subtitle'  => esc_html__('If the option is on, the post category will be displayed on post.', 'xarago'),
							'default'   => 1
						),
                        array(
							'id'        => 'xarago_social_share',
							'type'      => 'switch',
							'title'     => esc_html__('Social Share', 'xarago'),
							'subtitle'  => esc_html__('If the option is on, the social share will be display in meta post section.', 'xarago'),
							'default'   => 1
						)
                    )
                );
				
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-shopping-cart',
                    'title'  => esc_html__( 'Shop', 'xarago' ),
                    'fields' => array(
						array(
							'id'		=>'xarago_product_column',
							'type'		=> 'radio',
							'title' 	=> esc_html__('Product Column', 'xarago'),
							'subtitle' 	=> esc_html__('Select product column layout, will be used for product category page.', 'xarago'),
							'options'  	=> array(
								'2' => esc_html__('2 Column','xarago'),
								'3' =>  esc_html__('3 Column','xarago'),
								'4' =>  esc_html__('4 Column','xarago')
							),
							'default'  => '4'
						),
						array(
                            'id'       	=> 'xarago_products_items',
                            'type'     	=> 'text',
                            'title'    	=> esc_html__( 'Product Items Per Page', 'xarago' ),
                            'subtitle' 	=> esc_html__( 'Insert the number of posts to display per page.', 'xarago' ),
							'default'   => '8' 
                        ),
						array(
							'id'        => 'xarago_saletext',
							'type'      => 'text',
							'title'     => esc_html__('Sale Label', 'xarago'),
							'default'   => esc_html__('Sale', 'xarago'),
						),
						array(
							'id'        => 'xarago_outofstocktext',
							'type'      => 'text',
							'title'     => esc_html__('Out of Stock Label', 'xarago'),
							'default'   => esc_html__('No Stock', 'xarago'),
						)
					)
                );
				
				$this->sections[] = array (
					'icon' => 'el-icon-file-new',
					'title' => esc_html__('Sidebars', 'xarago'),
					'fields' => array (
						array(
							'id'=>'xarago_sidebars',
							'type'=> 'multi_text',
							'title' => esc_html__('Generate a new sidebar', 'xarago'),
							'subtitle' => esc_html__('Type the name of the new sidebar widget area', 'xarago'),
						)			
					)
				);
				
				
				$this->sections[] = array(
                    'icon'   => 'el-icon-fontsize',
                    'title'  => esc_html__( 'Typography', 'xarago' ),
                    'fields' => array(
						array(
							'id'        => 'xarago_body_font_typo',
							'type'      => 'typography',
							'output'    => array('html body'),
							'title'     => esc_html__('Body Font Options', 'xarago'),
							'subtitle'  => esc_html__('Select font options for the body', 'xarago'),
							'google'    => true,
							'text-align'=> false,
							'subsets'   => true,
							'font-weight' => false,
							'default'   => array(
								'google'      => true,
								'color'         => '#919191',
								'font-size'     => '16px',
								'font-family'   => 'Roboto',
								'line-height'   => '26px',
								'font-weight'   => '300',
							),
						),
						
						array(
							'id'        => 'xarago_menu_typo',
							'type'      => 'typography',
							'output'    => array('html ul#menu li a'),
							'title'     => esc_html__('Menu Font Options', 'xarago'),
							'subtitle'  => esc_html__('Select font options for the main menu.', 'xarago'),
							'google'    => true,
							'text-align'=> false,
							'subsets'   => true,
							'font-weight' => false,
							'default'   => array(
								'google'      => true,
								'color'         => '#e4e4e4',
								'font-size'     => '13px',
								'font-family'   => 'Montserrat',
								'line-height'   => '32px',
								'font-weight'   => '700',
							),
						),
						
						 array(
							'id'        => 'xarago_h1_typo',
							'type'      => 'typography',
							'output'    => array('html h1'),
							'title'     => esc_html__('H1 Font Options', 'xarago'),
							'subtitle'  => esc_html__('Select font options for Heading 1.', 'xarago'),
							'google'    => true,
							'text-align'=> false,
							'subsets'   => true,
							'font-weight' => false,
							'default'   => array(
								'google'      => true,
								'color'         => '#010101',
								'font-size'     => '36px',
								'font-family'   => 'Montserrat',
								'line-height'   => '42px',
								'font-weight'   => '700',
							),
						),  

						array(
							'id'        => 'xarago_h2_typo',
							'type'      => 'typography',
							'output'    => array('html h2'),
							'title'     => esc_html__('H2 Font Options', 'xarago'),
							'subtitle'  => esc_html__('Select font options for Heading 2.', 'xarago'),
							'google'    => true,
							'text-align'=> false,
							'subsets'   => true,
							'font-weight' => false,
							'default'   => array(
								'google'      => true,
								'color'         => '#010101',
								'font-size'     => '28px',
								'font-family'   => 'Montserrat',
								'line-height'   => '30px',
								'font-weight'   => '700',
							),
						),  

						array(
							'id'        => 'xarago_h3_typo',
							'type'      => 'typography',
							'output'    => array('html h3'),
							'title'     => esc_html__('H3 Font Options', 'xarago'),
							'subtitle'  => esc_html__('Select font options for Heading 3.', 'xarago'),
							'google'    => true,
							'text-align'=> false,
							'subsets'   => true,
							'font-weight' => false,
							'default'   => array(
								'google'      => true,
								'color'         => '#010101',
								'font-size'     => '22px',
								'font-family'   => 'Montserrat',
								'line-height'   => '24px',
								'font-weight'   => '700',
							),
						),  

						array(
							'id'        => 'xarago_h4_typo',
							'type'      => 'typography',
							'output'    => array('html h4'),
							'title'     => esc_html__('H4 Font Options', 'xarago'),
							'subtitle'  => esc_html__('Select font options for Heading 4.', 'xarago'),
							'google'    => true,
							'text-align'=> false,
							'subsets'   => true,
							'font-weight' => false,
							'default'   => array(
								'google'      => true,
								'color'         => '#010101',
								'font-size'     => '18px',
								'font-family'   => 'Montserrat',
								'line-height'   => '22px',
								'font-weight'   => '700',
							),
						),      

						array(
							'id'        => 'xarago_h5_typo',
							'type'      => 'typography',
							'output'    => array('html h5'),
							'title'     => esc_html__('H5 Font Options', 'xarago'),
							'subtitle'  => esc_html__('Select font options for Heading 5.', 'xarago'),
							'google'    => true,
							'text-align'=> false,
							'subsets'   => true,
							'font-weight' => false,
							'default'   => array(
								'google'      => true,
								'color'         => '#010101',
								'font-size'     => '15px',
								'font-family'   => 'Montserrat',
								'line-height'   => '20px',
								'font-weight'   => '700',
							),
						),       

						array(
							'id'        => 'xarago_h6_typo',
							'type'      => 'typography',
							'output'    => array('html h6'),
							'title'     => esc_html__('H6 Font Options', 'xarago'),
							'subtitle'  => esc_html__('Select font options for Heading 6.', 'xarago'),
							'google'    => true,
							'text-align'=> false,
							'subsets'   => true,
							'font-weight' => false,
							'default'   => array(
								'google'      => true,
								'color'         => '#010101',
								'font-size'     => '13px',
								'font-family'   => 'Montserrat',
								'line-height'   => '18px',
								'font-weight'   => '700',
							),
						)
                    )
                );

                $this->sections[] = array(
                    'icon'       => 'el-icon-brush',
                    'title'      => esc_html__( 'Styling', 'xarago' ),
                    'subsection' => false,
                    'fields'     => array(
						array(
							'id'        => 'xarago_color_scheme',
							'type'      => 'color',
							'title'     => esc_html__('Color', 'xarago'),
							'subtitle'  => esc_html__('Main color accents.', 'xarago'),
							'default'   => '#010101',
							'transparent' => false,
							'validate'  => 'color',
						),
						array(
                            'id'       => 'xarago_custom_css',
                            'type'     => 'textarea',
                            'title'    => esc_html__( 'Custom CSS', 'xarago' ),
                            'subtitle' => esc_html__( 'Quickly add some CSS to your theme by adding it to this block.', 'xarago' ),
                            'validate' => 'css',
                        ),
						array(
                            'id'       => 'xarago_custom_css_tl',
                            'type'     => 'textarea',
                            'title'    => esc_html__( 'Custom CSS for Tablet Landscape', 'xarago' ),
							'subtitle' => esc_html__( 'Only screen max-width: 1024px', 'xarago' ),
                            'validate' => 'css',
                        ),
						array(
                            'id'       => 'xarago_custom_css_tp',
                            'type'     => 'textarea',
                            'title'    => esc_html__( 'Custom CSS for Tablet Portrait', 'xarago' ),
							'subtitle' => esc_html__( 'Only min-width: 768px and max-width: 959px', 'xarago' ),
                            'validate' => 'css',
                        ),
						array(
                            'id'       => 'xarago_custom_css_ml',
                            'type'     => 'textarea',
                            'title'    => esc_html__( 'Custom CSS for Mobile Landscape', 'xarago' ),
							'subtitle' => esc_html__( 'Only min-width: 480px and max-width: 767px', 'xarago' ),
                            'validate' => 'css',
                        ),
						array(
                            'id'       => 'xarago_custom_css_mp',
                            'type'     => 'textarea',
                            'title'    => esc_html__( 'Custom CSS for Mobile Portrait', 'xarago' ),
							'subtitle' => esc_html__( 'Only screen and max-width: 479px', 'xarago' ),
                            'validate' => 'css',
                        )
					
                    )
                );

               
                $this->sections[] = array(
                    'title'  => esc_html__( 'Import / Export', 'xarago' ),
                    'desc'   => esc_html__( 'Import and Export your Redux Framework settings from file, text or URL.', 'xarago' ),
                    'icon'   => 'el-icon-refresh',
                    'fields' => array(
                        array(
                            'id'         => 'opt-import-export',
                            'type'       => 'import_export',
                            'title'      => 'Import Export',
                            'subtitle'   => esc_html__('Save and restore your Redux options','xarago'),
                            'full_width' => false,
                        ),
                    ),
                );
                
            }
                        
            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'xarago_opts',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'submenu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => esc_html__( 'Theme Options', 'xarago' ),
                    'page_title'           => esc_html__( 'Theme Options', 'xarago' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => 'AIzaSyAFAJBfjFbGr1nYIPu7nyLQXUJ-fZ3BcBc',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => false,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => false,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => '',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => 'xarago_theme_options',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => false,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => false,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE
                    'show_options_object' => false,
                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );

                
                $this->args['share_icons'][] = array(
                    'url'   => 'https://twitter.com/indoneztheme',
                    'title' => esc_html__('Follow us on Twitter','xarago'),
                    'icon'  => 'el-icon-twitter'
                );
         
                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                } else {
                }

                // Add content after the form.
                $this->args['footer_text'] =  wp_kses(__('<p>WordPress Theme by <strong>Indonez</strong></p>', 'xarago'),array('p' => array(),'strong' => array()));
            }
        }

        global $reduxConfig;
        $reduxConfig = new Redux_Framework_Init();
    } else {
        echo esc_html__("The class named Redux_Framework_sample_config has already been called. Developers, you need to prefix this class with your company name or you'll run into problems!",'xarago');
    }