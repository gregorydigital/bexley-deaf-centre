<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<meta name="referrer" content="no-referrer-when-downgrade">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
		#  Load header nav template file
	 	get_template_part('template-parts/global/header'); 
	?>
	
	<main id="primary">