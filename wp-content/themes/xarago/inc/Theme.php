<?php
// Content Width
if ( ! isset( $content_width ) ) {
	$content_width = '669';
}
// Load Theme Options
require get_template_directory().'/admin/options.php';

// Include Function
require get_template_directory().'/inc/TGMActivation.php';
require get_template_directory().'/inc/ThemeAcf.php';
require get_template_directory().'/inc/ThemeFilters.php';
require get_template_directory().'/inc/ThemeHelpers.php';
require get_template_directory().'/inc/ThemeHooks.php';
require get_template_directory().'/inc/ThemeMenus.php';
require get_template_directory().'/inc/ThemeScripts.php';
require get_template_directory().'/inc/ThemeSidebars.php';
require get_template_directory().'/inc/ThemeStyles.php';
require get_template_directory().'/inc/ThemeSupport.php';
require get_template_directory().'/inc/ThemeWoocommerce.php';
require get_template_directory().'/inc/walker/XaragoUikitCommentsWalker.php';
require get_template_directory().'/inc/walker/XaragoUikitMenuWalker.php';
require get_template_directory().'/inc/walker/XaragoUikitMenuCustomField.php';

/**
 * This class is responsible for setting up all theme-specific stuff.
 */

if ( ! class_exists( 'XaragoTheme' ) ) :
class XaragoTheme
{

    /**
     * @var ThemeFilters
     */
    public $filters;

    /**
     * @var ThemeHelpers
     */
    public $helpers;
	
	/**
     * @var ThemeHooks
     */
    public $hooks;

    /**
     * @var ThemeMenus
     */
    public $menus;
	
	/**
     * @var ThemeScripts
     */
    public $scripts;

    /**
     * @var ThemeShortcodes
     */
    public $shortcodes;
	
	/**
     * @var ThemeStyles
     */
    public $styles;

    /**
     * @var ThemeSupport
     */
    public $support;
	

    /**
     * @var ThemeSidebars
     */
    public $sidebars;
	
	/**
     * @var ThemeWoocommerce
     */
    public $xaragowoo;

    /**
     * @var Theme
     */
   private static $instance;


    public function __construct()
    {
        $this->filters = new XaragoThemeFilters();
        $this->helpers = new XaragoThemeHelpers();
		$this->hooks = new XaragoThemeHooks();
        $this->menus = new XaragoThemeMenus();
		$this->scripts = new XaragoThemeScripts();
		$this->styles = new XaragoThemeStyles();
        $this->support = new XaragoThemeSupport();
		$this->xaragowoo = new XaragoThemeWoocommerce();
        $this->sidebars = new XaragoThemeSidebars();
    }

    /**
     * @return Theme
     */
    public static function get_instance()
    {
        if (static::$instance === null) {
            static::$instance = new XaragoTheme();
        }

        return static::$instance;
    }
}
endif;