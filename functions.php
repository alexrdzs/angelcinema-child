<?php

/*** Child Theme Function  ***/

function cortex_mikado_child_theme_enqueue_scripts() {
	$parent_style = 'cortex_mikado_default_style';

	wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');

	wp_enqueue_style('cortex_mikado_child_style',
		get_stylesheet_directory_uri() . '/style.css',
		array($parent_style),
		wp_get_theme()->get('Version')
	);
}

add_action( 'wp_enqueue_scripts', 'cortex_mikado_child_theme_enqueue_scripts' );