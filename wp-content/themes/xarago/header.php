<?php
/**
 * The Header template
 * @author Indonez
 * @link http://indonez.com
 *
 * Displays all of the <head> section and everything up till
 * and the opening body-tag
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?> class="uk-height-1-1">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?> class="uk-height-1-1">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> class="uk-height-1-1">
<!--<![endif]-->
<head>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
