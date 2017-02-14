<?php 
$xarago_opts = xarago_opts();
$blogtitle = (isset($xarago_opts['xarago_blog_title'])) ? $xarago_opts['xarago_blog_title'] :"";
$headerbreadcrumb = (isset($xarago_opts['xarago_header_breadcrumb'])) ? $xarago_opts['xarago_header_breadcrumb'] :"";
$headersearch = (isset($xarago_opts['xarago_header_search'])) ? $xarago_opts['xarago_header_search'] :"";
?>
<section>
    <div class="uk-container uk-container-center">
        <div id="pagetitle">
            <div class="uk-grid">
                <!-- page title headline begin -->
                <div class="uk-width-5-10">
                    <?php 
					if(is_singular('indonez_portfolio') || is_singular('indonez_team') || is_singular('indonez_client')  || is_singular('indonez_testimonial')) {
						echo '<h2>'.get_the_title().'</h2>'; 
					} elseif (is_attachment()) {
						echo '<h2>'.get_the_title().'</h2>';
					}elseif (xarago_theme()->xaragowoo->xarago_is_true_woocommerce() || is_singular('product') ) {
                        echo '<h2>'.woocommerce_page_title($echo = false).'</h2>';
                    } elseif (is_single() || is_home()) {
						echo '<h2>'.esc_html($blogtitle).'</h2>';
					}elseif (is_archive()) {
						echo '<h2>';
						if ( is_day() ) {
							printf( esc_attr( '%s' ), get_the_date() );
						} elseif ( is_month() ) {
							printf( esc_attr( '%s' ), get_the_date('F Y') );
						} elseif ( is_year() ) {
							printf( esc_attr( '%s'), get_the_date('Y') );
						} elseif ( is_author()) {
							printf( esc_html__( 'Archives %s', 'xarago' ),  get_the_author());   
						} elseif ( is_search()) {
							printf( esc_html__( 'Search', 'xarago' ), '' );
						} else {
							printf( esc_attr( '%s'), single_cat_title( '', false ));    
						}
						echo '</h2>';
					} elseif(is_search()) {
						echo ' <h2>';
							printf( esc_html__( 'Search: %s', 'xarago' ), get_search_query() );
						echo '</h2>';
					} elseif(is_404()) {
						echo '<h2>'.esc_html__( 'ERROR 404', 'xarago' ).'</h2>';
					} else { 
							echo '<h2>'.get_the_title().'</h2>';
					}
				?>
                </div>
                <!-- page title headline end -->
                <!-- breadcrumb begin -->
                <div class="uk-width-5-10">
                    <?php
					if($headerbreadcrumb==1){
						if(function_exists('bcn_display')){
							echo '<ul id="breadcrumb-style" class="uk-breadcrumb uk-align-right">';
							bcn_display_list();
							echo '</ul>';
						}
					}
					?>
                </div>
                <!-- breadcrumb end -->
            </div>
        </div>
    </div>
</section> 		