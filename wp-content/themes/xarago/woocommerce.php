<?php
/**
 * woocommerce template file
 * @author Indonez
 * @link http://indonez.com
 */

get_header();

?>

<section id="main-container">

<?php
get_template_part('elements/base/header');

get_template_part('elements/base/precontent');

woocommerce_content();

get_template_part('elements/base/postcontent');

?>

</section>

<?php
get_template_part('elements/base/footer');

get_footer();