<?php 

/*
Plugin Name: RDW High Bar
Description: Displays an announcement bar across the top of the website
Version: 0.1
Author: Renee Wright
License: GPLv3
*/

//HTML Output
add_action( 'wp_footer', 'rdw_highbar_html' );
function rdw_highbar_html(){
	//get the custom options for the content
	$values = get_option('high_bar');
	?>
	<div id="high-bar">
		<span class="high-message"><?php echo stripslashes($values['bar_text']); ?></span>
		<a class="high-button" href="<?php echo stripslashes($values['button_url']); ?>">
			<?php echo stripslashes($values['button_text']); ?>
			</a>

		<a class="high-dismiss" href="javascript:;">&times;</a>
	</div>

	<?php
}

//Attach CSS & JS
add_action( 'wp_enqueue_scripts', 'rdw_high_scripts' );
function rdw_high_scripts(){
	//get the url of the stylesheet
	$css_url = plugins_url( 'css/highbar.css', __FILE__ );
	//register it & put it on the page
	wp_enqueue_style( 'highbar_style', $css_url );

	//attach jquery (it's already built into WP)
	wp_enqueue_script( 'jquery' );
	$js_url = plugins_url( 'scripts/highbar.js', __FILE__ );
	//register it and put it on the page
	wp_enqueue_script( 'highbar_script', $js_url );
}

//add a page to the admin panel
add_action( 'admin_menu', 'rdw_high_admin_page' );
function rdw_high_admin_page(){
	add_options_page( 'High Bar Settings', 'High Bar', 'manage_options', 'high-bar-settings', 'rdw_high_admin_content' );
}

function rdw_high_admin_content(){
	require( plugin_dir_path( __FILE__ ) . 'rdw-high-bar-settings-page.php' );
}

//register the settings we need (allows them into the db)
add_action( 'admin_init', 'rdw_high_setting' );
function rdw_high_setting(){
	register_setting( 'high_bar_setting_group', 'high_bar', array(
		'sanitize_callback' => 'rdw_high_bar_sanitize',
		'type' => 'array',
	) );
}


//sanitize all fields
function rdw_high_bar_sanitize($input){
	//kses ('kisses') built into wp to sanitize; stands for "strips evil scripts"
	//clean each field. $input is an array containing all dirty fields
	$input['bar_text'] = wp_filter_nohtml_kses( $input['bar_text'] );
	$input['button_text'] = wp_filter_nohtml_kses( $input['button_text'] );
	$input['button_url'] = wp_filter_nohtml_kses( $input['button_url'] );

	//$input is now an array containing the cleaned fields!

	return $input;
}













//no close php