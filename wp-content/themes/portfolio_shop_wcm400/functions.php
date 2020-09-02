<?php  
//max width of auto-embeds (YT, IG, FB, etc)
if( ! isset( $content_width ) ) $content_width = 500;

add_theme_support( 'custom-background' );

//add SEO-friendly titles
//dev note: remove the <title> from header.php
add_theme_support( 'title-tag' );

//upgrade to HTML5
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

//add "featured image" to each post & page
add_theme_support( 'post-thumbnails' );

//custom header
//dev note: display header_image() somewhere in header. php
$args = array(
	'width' 		=> 1300,
	'height' 		=> 800,
	'flex-width' 	=> true,
	'flex-height' 	=> true,
);
add_theme_support( 'custom-header', $args );

//custom logo uploader
$args = array(
	'width' => 300,
	'height' => 300,
	'flex-width' 	=> true,
	'flex-height' 	=> false, //you can not flex the height if you want to ensure it is at least 300
	'header-text' => array( 'site-title', 'site-description' ),
);
add_theme_support( 'custom-logo', $args );

//improve RSS feed links - usefor for blogs and news outlets
add_theme_support( 'automatic-feed-links' );

//post formats let you style different kinds of posts (see post-formats in CODEX for array possibilities)
add_theme_support( 'post-formats', array(
	'gallery',
	'image',
	'video'
) );


//custom image size
//add_image_size( $name, $width = 0, $height = 0, $crop = false )
add_image_size( 'banner', 1300, 300, true );




//simple hook example - change the length of the default excerpt using a built-in filter
function rdw_excerpt_length(){
	return 20;
}
add_filter('excerpt_length', 'rdw_excerpt_length');

//change the [...] in the excerpt
function rdw_excerpt_more(){
	return '<a class="readmore" href="'. get_permalink() . '">...Read More</a>';
}

add_filter( 'excerpt_more', 'rdw_excerpt_more' ); 



//simple hook example - use a default action 
function rdw_footer_text(){
	echo 'Hello this is the footer action hook. You look gorgeous today, darling.';
}

add_action( 'admin_footer_text', 'rdw_footer_text' );

//example using simply show hooks
function rdw_breadcrumb(){
	echo 'These are breadcrumbs (not!)';
}

//add_action( 'loop_start', 'rdw_breadcrumb');

//better comment form UX
function rdw_commentreply(){
	wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'rdw_commentreply' );


//Activate all menu areas for the site
add_action( 'init', 'rdw_menu_areas' );
function rdw_menu_areas(){
	register_nav_menus( array(
		'main_menu' => 'Main Menu',
		'social_icons' => 'Social Media Icons',
	) );
}


//Register any widget areas we will need
add_action( 'widgets_init', 'rdw_widget_areas' );
function rdw_widget_areas(){
	register_sidebar( array(
		'name' => 'Blog Sidebar',
		'id' => 'blog_sidebar',
		//use before widget and after widget to change the html structure (default is <li>)
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after' => '</section>',
		//use these to affect the titles with css and keep them synonymous
		'before_title' => '<h3 class-"widget-title">',
		'after_title' => '</h3>',
	) );
		register_sidebar( array(
		'name' => 'Footer Area',
		'id' => 'footer_area',
		'description' => 'Appears at the bottom of every screen',
		//use before widget and after widget to change the html structure (default is <li>)
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after' => '</section>',
		//use these to affect the titles with css and keep them synonymous
		'before_title' => '<h3 class-"widget-title">',
		'after_title' => '</h3>',
	) );
		register_sidebar( array(
		'name' => 'Home Page Area',
		'id' => 'home_area',
		'description' => 'An area to feature 3 highlights on the front page',
		//use before widget and after widget to change the html structure (default is <li>)
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after' => '</section>',
		//use these to affect the titles with css and keep them synonymous
		'before_title' => '<h3 class-"widget-title">',
		'after_title' => '</h3>',
	) );
		register_sidebar( array(
		'name' => 'Shop Sidebar',
		'id' => 'shop-sidebar',
		'description' => 'Appears next to the shop products page',
		//use before widget and after widget to change the html structure (default is <li>)
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after' => '</section>',
		//use these to affect the titles with css and keep them synonymous
		'before_title' => '<h3 class-"widget-title">',
		'after_title' => '</h3>',
	) );
}





//Count all real comments on a post
add_filter( 'get_comments_number', 'sc_comments_count' );
function sc_comments_count(){
    //post id
    global $id;
    $comments = get_approved_comments( $id );
    $count = 0;
    
    //go through the comments array, counting each real comment
    foreach( $comments AS $comment ){
        if( $comment->comment_type == 'comment' ){
            $count ++;
        }
    }
    return $count;
}

//Count all the trackbacks and pingbacks on a post


function sc_pings_count(){
    //post id
    global $id;
    $comments = get_approved_comments( $id );
    $count = 0;

    //go through the comments array, counting each real comment
    foreach( $comments AS $comment ){
        if( $comment->comment_type != 'comment' ){
            $count ++;
        }
    }

    return $count;
}

//WOOCommerce support
add_action( 'after_setup_theme', 'rdw_woo' );
function rdw_woo(){
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-slider' );
}


//replace the <main> content wrapper from WOOCommerce with our own
//https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<main class="content">';
}

function my_theme_wrapper_end() {
  echo '</main>';
}



//Show cart contents / total Ajax
//https://docs.woocommerce.com/document/show-cart-contents-total/
 
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}



//no close php