<?php

/*------Project post type----*/
function project_taxonomy() {
 $labels = array(
  'name'               => _x( 'Projects', 'post type general name' ),
  'singular_name'      => _x( 'Project', 'post type singular name' ),
  'add_new'            => _x( 'Add New', 'Project' ),
  'add_new_item'       => __( 'Add New Project' ),
  'edit_item'          => __( 'Edit Project' ),
  'new_item'           => __( 'New Project' ),
  'all_items'          => __( 'All Projects' ),
  'view_item'          => __( 'View Projects' ),
  'search_items'       => __( 'Search Projects' ),
  'not_found'          => __( 'No Projects found' ),
  'not_found_in_trash' => __( 'No Projects found in the Trash' ),
  'parent_item_colon'  => '',
  'menu_name'          => 'Projects'
 );
 $args = array(
  'labels'        => $labels,
  'description'   => 'Projects',
  'public'        => true,
  'menu_position' => 2,
  'supports'      => array( 'title','thumbnail'),
  'has_archive'   => true,
  'menu_icon'     => 'dashicons-clipboard'
 );
 register_post_type( 'projects', $args );
}
add_action( 'init', 'project_taxonomy' );


/*------Team post type----*/
function team_taxonomy() {
 $labels = array(
  'name'               => _x( 'Team', 'post type general name' ),
  'singular_name'      => _x( 'Team Member', 'post type singular name' ),
  'add_new'            => _x( 'Add New', 'Team' ),
  'add_new_item'       => __( 'Add New Team Member' ),
  'edit_item'          => __( 'Edit Team Member' ),
  'new_item'           => __( 'New Team Member' ),
  'all_items'          => __( 'All Team Members' ),
  'view_item'          => __( 'View Team Members' ),
  'search_items'       => __( 'Search Team Members' ),
  'not_found'          => __( 'No Team Members found' ),
  'not_found_in_trash' => __( 'No Team Members found in the Trash' ),
  'parent_item_colon'  => '',
  'menu_name'          => 'Team'
 );
 $args = array(
  'labels'        => $labels,
  'description'   => 'Team Members',
  'public'        => true,
  'menu_position' => 3,
  'supports'      => array( 'title','thumbnail'),
  'has_archive'   => true,
  'menu_icon'     => 'dashicons-businessman'
 );
 register_post_type( 'team', $args );
}
add_action( 'init', 'team_taxonomy' );

?>
