<?php
/**
 * The default template for displaying content
 *
 * Used for page.
 *
 */
the_content();
wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'xarago'), 'after' => '</div>' ) );
?>           