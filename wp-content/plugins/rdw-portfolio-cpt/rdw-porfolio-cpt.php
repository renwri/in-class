<?php
/*
Plugin Name: RDW Portfolio CPT
Description: Adds the custom post type support for our portfolio pieces (work)
Version: 0.1
Author: Renee Wright
License: GPLv3
*/

//register any needed post types
add_action( 'init', 'rdw_cpt' );
function rdw_cpt(){ 
	register_post_type( 'work', array( //the name you put in the argument will show up in the url
		'public' 		=> true,
		'label' 		=> 'Portfolio',
		'has_archive' 	=> true,
		'menu_position'	=> 5,
		'menu_icon' 	=> 'dashicons-portfolio',
		'show_in_rest'	=> true, //use the block editor
		'supports' 		=> array('title', 'editor', 'thumbnail', 'revisions', 'excerpt', 'custom-fields'),
		'rewrite' 		=> array('slug' => 'portfolio'), //changes the url to end in 'porfolio'
	) );

	register_taxonomy( 'portfolio_category', 'work', array(
		'label' 			=> 'Portfolio Categories',
		'show_in_rest'		=> true, //use the block editor
		'hierarchical'		=> true,
		'show_admin_column' => 'true',
	) );
}

//Fix 404 errors when this plugin activates
register_activation_hook( __FILE__, 'rdw_fix_permalinks' );
function rdw_fix_permalinks(){
	rdw_cpt(); //call the function that runs on init first
	flush_rewrite_rules();
}




//no close php