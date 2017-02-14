<?php

/**
 * Works in Wordpress 4.0 and above
 * 
 * @author  Indonez
 */
 
if ( ! class_exists( 'XaragoUikitMenuWalker' ) ) :
class XaragoUikitMenuWalker extends Walker_Nav_Menu
{

    private $_type;

    /**
     * @param  string $type
     *                 Type of the Navigation. Possible values 'navbar', 'offcanvas'
     */
    public function __construct($type = 'navbar')
    {
        $this->_type = $type;
    }

    /**
     * @see Walker_Nav_Menu::start_el()
     *
     * @param string $output
     *                Passed by reference. Used to append additional content.
     * @param object $item
     *                Menu item data object.
     * @param int $depth
     *                Depth of menu item. Used for padding.
     * @param array $args
     *                An array of arguments. @see wp_nav_menu()
     * @param int $id
     *                Current item ID.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) 
    {
        $indent = str_repeat("\t", $depth);
		

        // prepare ID-attribute content for li
        $li_id = 'menu-item-' . $item->ID;
        
        // prepare class-attribute content for li
        $li_classes = empty($item->classes) ? array() : array_filter((array)$item->classes);

        // prepare additional attributes for li
        $li_attributes = array();

        // prepare additional attributes for link
        $link_attributes   = array();
		if ($this->has_children && $depth == 0) {
			if ($this->_type == 'offcanvas') {
				$link_attributes[] = sprintf('href="%s"', '#');
			}else{
				$link_attributes[] = sprintf('href="%s"', esc_attr($item->url));	
			}
		}else{
		 $link_attributes[] = sprintf('href="%s"', esc_attr($item->url));	
		}
		
		if ($this->_type == 'navbar') {
        $link_attributes[] = sprintf('id="menu-item-link-%s"', esc_attr($item->ID));
		}
		
        if (!empty($item->attr_title)) $link_attributes[] = sprintf('title="%s"', esc_attr($item->attr_title));
        
        // if this is the current active link
        if ($item->current) {
            $li_classes[] = 'uk-active';
        }
		

        // if this element has children
        if ($this->has_children && $depth == 0) {
            $li_classes[] = 'uk-parent';
			if ( in_array( 'idz-megamenu', $item->classes ) ) {
			if ($this->_type == 'navbar') $li_attributes[] = 'data-uk-dropdown="{justify:\'#mainmenu\'}"';
			}else{
            if ($this->_type == 'navbar') $li_attributes[] = 'data-uk-dropdown=""';
			}
        }

        // apply filters
		if ($this->_type == 'navbar') {
        $li_id = apply_filters('nav_menu_item_id', $li_id, $item, $args);
        $li_attributes[] = sprintf('id="%s"', esc_attr($li_id));
		}

        $li_classes = apply_filters('nav_menu_css_class', $li_classes, $item, $args);
        $li_attributes[] = sprintf('class="%s"', esc_attr(implode(" ", $li_classes)));
		
		// prepare title/content for link
        $link_title = $item->title;
        $link_title = apply_filters('the_title', $link_title, $item->ID);
		
		
		if($link_title=="Nolabel"){
			$get_title = str_replace( 'Nolabel', '', $link_title );
			
		}else{
			$get_title = $link_title;
		}


        // render link
        $link  = $args->before;
        $link .= sprintf('<a %s>', implode(" ", $link_attributes));
        $link .= $args->link_before;
        $link .= wp_kses($get_title, array('i'=>array('class'=>array(), 'style'=>array())));
        $link .= $args->link_after;
        $link .= "</a>";
        $link .= $args->after;
		if(! empty( $item->description )){
		$link .= '<div class="desc-menu">' . wp_kses_post($item->description) . '</div>';
		}


        // render li with link
        $output .= $indent . '<li ' . implode(" ", $li_attributes) . '>' . $link . "\n";

        if ($this->has_children && $depth == 0) {
            if ($this->_type == 'navbar') {
                $output .= $indent . '<div class="uk-dropdown uk-dropdown-navbar">' . "\n";
            }
        }
    }

    /**
     * @see Walker_Nav_Menu::end_el()
     *
     * @param string $output
     *                Passed by reference. Used to append additional content.
     * @param object $item  
     *                Page data object. Not used.
     * @param int $depth
     *                Depth of page. Not Used.
     * @param array $args
     *                An array of arguments. @see wp_nav_menu()
     */
    function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
		
		$getbgimage = $item->bgmenu;
		
		$bgimage = ($getbgimage!="" ? '<img class="megamenubgimg" src="'.esc_url($getbgimage).'" alt="">' : '');
			
        if ($item->classes != '' && in_array('menu-item-has-children', $item->classes) && $depth == 0) {

            if ($this->_type == 'navbar') {
                $output .= $indent . '</div>' . "\n";
            }
        }

        $output .= $indent . $bgimage .'</li>' . "\n";
    }

    /**
     * @see Walker_Nav_Menu::start_lvl()
     *
     * @param string $output
     *                Passed by reference. Used to append additional content.
     * @param int $depth
     *                Depth of menu item. Used for padding.
     * @param array $args
     *                An array of arguments. @see wp_nav_menu()
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);

        if ($this->_type == 'navbar') {

            $output .= $indent . '<ul class="uk-nav uk-nav-navbar">' . "\n";
        }
        else if ($this->_type == 'offcanvas') {
            $output .= $indent . '<ul class="uk-nav-sub">' . "\n";
        }
        else {
            $output .= $indent . '<ul>' . "\n";
        }
    }

    /**
     * @see Walker_Nav_Menu::end_lvl()
     *
     * @param string $output
     *                Passed by reference. Used to append additional content.
     * @param int $depth
     *                Depth of menu item. Used for padding.
     * @param array $args
     *                An array of arguments. @see wp_nav_menu()
     */
    public function end_lvl(&$output, $depth = 0, $args = array()) 
    {
        $indent = str_repeat("\t", $depth);

        if ($this->_type == 'navbar') {
            $output .= $indent . '</ul>' . "\n";
        }
        else if ($this->_type == 'offcanvas') {
            $output .= $indent . '</ul>' . "\n";
        }
        else {
            $output .= $indent . '</ul>' . "\n";
        }
    }
}
endif;