<?php

session_start();

/* ========================================================================= */
/* !WORDPRESS EXTERNAL FILES     */
/* ========================================================================= */
include_once 'functions/functions-post-types.php';


/* ========================================================================= */
/* !WORDPRESS SECURITY */
/* ========================================================================= */

remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version

/* Prevent Login Errors for Security */
// add_filter('login_errors',create_function('$a', "return null;"));


/* ========================================================================= */
/* !WORDPRESS CUSTOMIZATION & SETUP */
/* ========================================================================= */
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 64, 64, true );
/*------ Project thumbnail sizes --------*/
add_image_size('large-project-thumbnail', 542, 542, true );
add_image_size('medium-project-thumbnail', 365, 365, true );
add_image_size('medium-project-thumbnail-horizontal', 542, 267, true );
add_image_size('medium-project-thumbnail-vertical', 267, 542, true );
add_image_size('small-project-thumbnail', 267, 267, true );
/*------ Project detail sizes --------*/
add_image_size('main-project-banner', 1500, 760, true );
add_image_size('large-project-detail-row', 752, 381, true );
add_image_size('small-project-detail-row', 353, 235, true );
/*------ Our Team Landing sizes --------*/
add_image_size('team-thumbnail', 270, 220, true );
/*------ Our Team Bio sizes --------*/
add_image_size('team-bio-primary', 661, 402, true );
add_image_size('team-bio-secondary', 456, 402, true );
add_image_size('my-interests-thumbnail', 365, 248, true );
/*------ Insights sizes --------*/
add_image_size('insights-thumbnail', 353, 235, true );
add_image_size('insights-featured', 376, 250, true );
/*------ General Interior sizes --------*/
add_image_size('interior-news-thumb', 388, 258, true );

/* Declare Nav Menu Areas */
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
               'main-menu' => 'Main Menu',
               'footer-menu' => 'Footer Menu'
		)
	);
}

/*-------Show only appropriate styling options in WYSIWYG editor-------*/
function customformatTinyMCE($init) {
	// Add block format elements you want to show in dropdown
  $init['block_formats'] = 'Paragraph=p; Main Heading (h3)=h3;';

	return $init;
}
// Modify Tiny_MCE init
add_filter('tiny_mce_before_init', 'customformatTinyMCE' );

/* Globally Hide Admin Meta Boxes */
function hide_meta_boxes() {
     remove_meta_box('postcustom','post','normal'); // custom fields post
     remove_meta_box('postcustom','page','normal'); // custom fields page

     //remove_meta_box('commentstatusdiv','post','normal'); // discussion post
     remove_meta_box('commentstatusdiv','page','normal'); // discussion page

     //remove_meta_box('commentsdiv','post','normal'); // comments post
     //remove_meta_box('commentsdiv','page','normal'); // comments page

     //remove_meta_box('authordiv','post','normal'); // author post
     remove_meta_box('authordiv','page','normal'); // author page

     //remove_meta_box('revisionsdiv','post','normal'); // revisions post
     //remove_meta_box('revisionsdiv','page','normal'); // revisions page

     //remove_meta_box('postimagediv','post','normal'); // featured image post
     remove_meta_box('postimagediv','page','normal'); // featured image page

     //remove_meta_box('pageparentdiv','page','normal'); // page attributes

     //remove_meta_box('tagsdiv-post-tag','post','normal'); // post tags
     //remove_meta_box('categorydiv','post','normal'); // post categories
     //remove_meta_box('postexcerpt','post','normal'); // post excerpt
     remove_meta_box('trackbacksdiv','post','normal'); // track backs
}
add_action('admin_init', 'hide_meta_boxes');

/*------ Hide editor for appropriate pages & templates ---------*/
function hide_editor() {
  // Get the Post ID.
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;
  // Hide the editor on the page titled 'Home'
  $homepgname = get_the_title($post_id);
  if($homepgname == 'Home'){
    remove_post_type_support('page', 'editor');
  }
  // Hide the editor for General Interior pages
  $template_file = get_post_meta($post_id, '_wp_page_template', true);

  if( $template_file == 'general-interior.php'
        || $template_file == 'media.php'
        || $template_file == 'category-post.php'
        || $template_file == 'team-page.php'
        || $template_file == 'search-result.php'){ // edit the template name
    remove_post_type_support('page', 'editor');
  }
}
add_action( 'admin_init', 'hide_editor' );


/* Hide Wordpress Default Dashboard Widgets */
function remove_dashboard_widgets() {

	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);

	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );


/* ========================================================================= */
/* !CUSTOM LOGIN STYLES */
/* ========================================================================= */

function my_login_stylesheet() {
   wp_enqueue_style( 'custom-login', home_url() . '/ui/css/login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

function jrd_login() {
    echo '<a href="http://www.jumpingjackrabbit.com/" target="_blank">';
    echo '<div id="jrd-login"></div>';
    echo '</a>';
}
add_action( 'login_footer', 'jrd_login' );


/* ========================================================================= */
/* !ENQUEUE & REGISTER SCRIPTS */
/* ========================================================================= */

function enqueue_scripts() {
    wp_deregister_script( 'jquery' );
    wp_enqueue_script('modernizr', get_bloginfo('url').'/ui/js/modernizr.js', array(), null);
    wp_enqueue_script('jquery', get_bloginfo('url').'/ui/js/jquery.js', array(), null);
    wp_enqueue_script('plugins', get_bloginfo('url').'/ui/js/jquery.plugins.js', array('jquery'), null, true);
    wp_enqueue_script('init', get_bloginfo('url').'/ui/js/jquery.init.js', array('jquery', 'plugins'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

/* ========================================================================= */
/* !ENQUEUE & REGISTER STYLES */
/* ========================================================================= */

function enqueue_styles() {
    wp_enqueue_style('style', get_bloginfo('url').'/ui/css/style.css', array(), null);
}
add_action('wp_enqueue_scripts', 'enqueue_styles');

/*-- Custom Excerpt --*/
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');


/* ========================================================================= */
/* !GRAVITY FORM CUSTOMIZATIONS */
/* ========================================================================= */

add_filter("gform_submit_button", "form_submit_button", 10, 2);
function form_submit_button($button, $form){
    $button_array = $form["button"];
    $button_text = $button_array["text"];
    return "<button type='submit' class='submit blue-btn' id='gform_submit_button_{" . $form["id"] . "}'><span>$button_text</span></button>";
}

/* ========================================================================= */
/* !REMOVE ADMIN TOOLBAR */
/* ========================================================================= */

show_admin_bar( false );
function my_function_admin_bar(){
  return false;
}
add_filter('show_admin_bar' , 'my_function_admin_bar');
add_theme_support('admin-bar', array('callback' => '__return_false'));

/* ========================================================================= */
/*  Browser detection body_class() output */
/* ========================================================================= */

function alx_browser_body_class( $classes ) {
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

    if($is_lynx) $classes[] = 'lynx';
    elseif($is_gecko) $classes[] = 'gecko';
    elseif($is_opera) $classes[] = 'opera';
    elseif($is_NS4) $classes[] = 'ns4';
    elseif($is_safari) $classes[] = 'safari';
    elseif($is_chrome) $classes[] = 'chrome';
    elseif($is_IE) {
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $browser = substr( "$browser", 25, 8);
        if ($browser == "MSIE 7.0"  ) {
            $classes[] = 'ie7';
            $classes[] = 'ie';
        } elseif ($browser == "MSIE 6.0" ) {
            $classes[] = 'ie6';
            $classes[] = 'ie';
        } elseif ($browser == "MSIE 8.0" ) {
            $classes[] = 'ie8';
            $classes[] = 'ie';
        } elseif ($browser == "MSIE 9.0" ) {
            $classes[] = 'ie9';
            $classes[] = 'ie';
        } else {
            $classes[] = 'ie';
        }
    }
    else $classes[] = 'unknown';

    if( $is_iphone ) $classes[] = 'iphone';

    return $classes;
}
add_filter( 'body_class', 'alx_browser_body_class' );

/* ========================================================================= */
/* !WORDPRESS SUBPAGE SIDEBAR MENU */
/* ========================================================================= */

function jrd_tertiary_menu( $args ){
	include_once 'functions/class-walker-tertiary-menu.php';
	$uri_parts = explode('/', $_SERVER['REQUEST_URI']);
	$args['ancestor'] = get_page_by_path($uri_parts[1]);
	$args['echo'] = false;
	$args['walker'] = new Walker_Tertiary_Menu();
	return wp_nav_menu($args);
}


function check_is_subpage() {
    global $post;                                 // load details about this page
    if ( is_page() && $post->post_parent ) {      // test to see if the page has a parent
           return $post->post_parent;             // return the ID of the parent post
    } else {                                      // there is no parent so...
           return false;                          // ...the answer to the question is false
    }
}


/* HOW TO USE
   Plug this code below into your submenu sidebar and set the theme location to use the menu you want to reference. This code checks whether the page is a subpage.
   If page is a subpage it echos the children menu items of it. If page is not it then echos the top level pages of the menu.

<?php if(check_is_subpage() == false){ ?>
    <h3><?php bloginfo('name'); ?></h3>
    <div class="submenu-widget">
        <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container' => '', 'menu_class' => 'menu', 'menu_id' => '', 'depth' => 2)); ?>
    </div>
<?php } else { ?>
    <h3><?php $anc = get_ancestors(get_the_ID(),'page'); $count = count($anc); if($count > 0){ $anc_pg = get_post($anc[($count - 1)]); echo $anc_pg->post_title; } else the_title(); ?></h3>
    <div class="submenu-widget">
        <?php echo jrd_tertiary_menu(array('theme_location' => 'main-menu', 'container' => '', 'menu_class' => 'menu', 'menu_id' => '', 'depth' => 3)); ?>
    </div>
<?php } ?>
*/

/* ========================================================================= */
/*  Get Post Slug */
/* ========================================================================= */

function the_slug($echo=true){
    $slug = basename(get_permalink());
    do_action('before_slug', $slug);
    $slug = apply_filters('slug_filter', $slug);
    if( $echo ) echo $slug;
    do_action('after_slug', $slug);
    return $slug;
}

/* ========================================================================= */
/* !REMOVE <P> WRAPPER WHEN ONLY <IMG /> IS CONTAINED WITHIN */
/* ========================================================================= */

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');


/* ========================================================================= */
/* !ADD OPTION TO FILTER PDF IN MEDIA LIBRARY */
/* ========================================================================= */

function modify_post_mime_types($post_mime_types) {
    $post_mime_types['application/pdf'] = array(__( 'PDFs' ), __('Manage PDF'), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>'));
    return $post_mime_types;
}
add_filter('post_mime_types', 'modify_post_mime_types');


/* ========================================================================= */
/* !EASY PRINTR() */
/* ========================================================================= */

function printr($var){ echo '<pre>'; print_r($var); echo '</pre>'; };

/* ========================================================================= */
/* !ADD ACF5 OPTIONS PAGE - more args available at http://www.advancedcustomfields.com/resources/acf_add_options_page/  */
/* ========================================================================= */

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
	    'page_title' => 'Options',
	    'menu_slug' => 'options'
	));
}




/* ========================================================================= */
/* !YOAST ANALYZE CUSTOM FIELDS - Make Yoast Scan Our Custom Fields */
/* ========================================================================= */

if ( is_admin() ) {
    function add_custom_to_yoast( $content ) {
        global $post;
        $pid = $post->ID;
        $custom = get_post_custom($pid);
        unset($custom['_yoast_wpseo_focuskw']);
        foreach( $custom as $key => $value ) {
            if( substr( $key, 0, 1 ) != '_' && substr( $value[0], -1) != '}' && !is_array($value[0]) && !empty($value[0])) {
                 $custom_content .= $value[0] . ' ';
            }
        }
        $content = $content . ' ' . $custom_content;
        return $content;
        remove_filter('wpseo_pre_analysis_post_content', 'add_custom_to_yoast'); // don't let WP execute this twice
    }
    add_filter('wpseo_pre_analysis_post_content', 'add_custom_to_yoast');
}

/* ========================================================================= */
/* !WORDPRESS PAGINATION SCRIPT */
/* ========================================================================= */

/*
function jrd_paginate() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	$pagination = array(
		'base' => @add_query_arg('page','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => false,
		'mid_size' => 1,
		'end_size' => 3,
		'type' => 'plain',
		'next_text' => '',
		'prev_text' => ''
		);

	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => urlencode(get_query_var( 's' )) );

	if($wp_query->query_vars['posts_per_page'] < $wp_query->found_posts){

	    echo '<div id="search-nav">';
        echo paginate_links( $pagination );
        echo '</div>';

	}
}
*/


/* ========================================================================= */
/* !SHORTCUT CODES */
/* ========================================================================= */
/*
function morelink($atts, $content = null) {
    extract(shortcode_atts(array(
        "link" => '',
        "target" => ''
    ), $atts));
    return '<a href="'.$link.'" class="button btn-read-more" target="'.$target.'">'.$content.'</a>';
}
add_shortcode('button', 'morelink');
*/




/* ========================================================================= */
/* !TINYMCE SELECT DROPDOWN CLASS SETUP CODES */
/* ========================================================================= */

/*
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );

function my_mce_before_init( $settings ) {

    $style_formats = array(
    	array(
    		'title' => 'Gray Box Button',
    		'selector' => 'a',
    		'classes' => 'box-link'
        )
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}
*/


/* ========================================================================= */
/* !WORDPERSS CUSTOM THEME FUNCTIONS */
/* ========================================================================= */

/* ----- SHOW FUTURE POSTS FOR EVENT CUSTOM POST TYPES ----- */
/*
function show_future_posts($posts) {
   global $wp_query, $wpdb;
   if(is_single() && $wp_query->post_count == 0)
   {
      $posts = $wpdb->get_results($wp_query->request);
   }
   return $posts;
}
add_filter('the_posts', 'show_future_posts');
*/

/* ----- Get File Extension (ex: PDF, DOC) ----- */
/*
function jrd_get_file_ext($file_url){
	return pathinfo($file_url, PATHINFO_EXTENSION);
}
*/
?>