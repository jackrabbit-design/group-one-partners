<?php
 /*
 * Template Name: Category Post
 */

	//get_template_part( 'content', 'none' );
	set_query_var( 'category_page', array_pop(explode('/', trim($_SERVER['REQUEST_URI'], '/'))) );
	get_template_part( 'media' );
	/*if ( $media = locate_template( 'media.php' ) ) {
		load_template( $media );
	} else {
		load_template( dirname( __FILE__ ) . '/group-one/media.php' );
	}*/
?>