<?php
/*
 * Template Name: Search Result
 */

get_header();
global $wpdb;
$db_prefix = $wpdb->prefix;

$page_id = get_the_ID();

global $query_string;

$query_args = explode("&", $query_string.($_SERVER['QUERY_STRING']!=''?'&'.$_SERVER['QUERY_STRING']:''));
$search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach

//setup args
//don't change this
$args = array('s' => (isset($search_query['search'])?$search_query['search']:''), 'post_status' => array( 'publish' ), 'post_type' => array( 'post', 'team', 'projects' ), 'posts_per_page' => (isset($search_query['count'])?$search_query['count']:4), 'paged' => (isset($search_query['index'])?$search_query['index']:1));

//or this. it could throw off the query modification.
$args['meta_query'] = array(
		'relation' => 'AND',
		array(
			'key' => 'body_content',
			'value' => (isset($search_query['search'])?$search_query['search']:''),
			'compare' => 'like'
			),
		array(
			'key' => '_wp_page_template',
			'value' => 'general-interior.php',
			'compare' => '='
			)
	);

//organize the query into the proper order for the correct data.
function query_modify( $obj )
{
	global $args;

  global $db_prefix;

	$obj['where'] = " AND ( ( ".$db_prefix."postmeta.meta_key LIKE 'content_areas_%_body_content' AND ".$db_prefix."posts.post_type = 'page' AND CAST(".$db_prefix."postmeta.meta_value AS CHAR) LIKE '%".esc_sql($args['s'])."%' ) AND ( mt1.meta_key = '_wp_page_template' AND CAST(mt1.meta_value AS CHAR) = 'general-interior.php' ) ) OR (((".$db_prefix."posts.post_title LIKE '%".esc_sql($args['s'])."%') OR (".$db_prefix."posts.post_content LIKE '%".esc_sql($args['s'])."%')) AND ".$db_prefix."posts.post_type IN ('post', 'team', 'projects')) AND ((".$db_prefix."posts.post_status = 'publish')) ";

	return $obj;
}
add_filter( 'posts_clauses', 'query_modify' );

//prevent the page from being listed multiple times
function search_distinct() {
    return "DISTINCT";
}
add_filter('posts_distinct', 'search_distinct');

if( count($query_args) )
{
	echo '<div class="" style="display:none;">'.json_encode($search_query).'</div>';
}
?>

<div id="pg-title" style="background-image:url(<?php echo bloginfo('url') ?>/ui/images/pg-banner.png)">
    	<div class="container">
        	<div class="container-inner">
            	<h2><?php the_title(); ?></h2>
            </div>
        </div>
    </div><!--pg-title-->

    <div id="pg-module">
    	<div class="container">
        	<div class="container-inner clearfix">
            	<article id="article" class="search-result pull-left">
            		<?php $search = new WP_Query($args); //if( isset($_GET['output']) ){ print_r($search->request); } //search count ?>

                	<h2><?php echo $search->found_posts; ?> Results found for “<span><?php echo $args['s']; ?></span>”.</h2>

                    <ul class="">
                    	<?php while($search->have_posts()){
                    		$search->the_post();
                    		$href = get_the_permalink();
                    		$excerpt = get_the_excerpt();

                    		//rtrim(substr($value,0,$trim_length))
                    		if( get_post_type() == 'page' && get_field('_wp_page_template') == 'general-interior.php' ) //&& get_field('') )
                    		{
	                    		for( $i = 0; $excerpt = get_field('content_areas_'.$i.'_body_content'); $i++)
	                    		{
		                    		if( !stripos($excerpt, $args['s']) )
		                    		{
			                    		continue;
		                    		}

		                    		$excerpt = strip_tags(rtrim(substr($excerpt,0,200))).'...';

		                    		break;
	                    		}
                    		}
                    	?>
                    	<li>
                        	<h4><a href="<?php echo $href; ?>"><?php echo preg_replace('/\b' . preg_quote($args['s'], "/") . '\b/i', "<span>\$0</span>", get_the_title()); ?></a></h4>
							<p><?php echo preg_replace('/\b' . preg_quote($args['s'], "/") . '\b/i', "<span>\$0</span>", $excerpt); ?></p>
							<a href="<?php echo $href; ?>" class="link blue-link small-link">read more</a>
                        </li>
                    	<?php } ?>
                    </ul>

                    <div class="loading">
                    	<span></span>
                    </div>
                </article>

                <?php

                wp_reset_postdata();
                wp_reset_query();

                remove_filter('posts_clauses', 'query_modify');
                remove_filter('posts_distinct', 'search_distinct');

                //$contact = new WP_Query( $args );
                $contact = new WP_Query( 'page_id='.$page_id );

		    // The Loop
		    if ( $contact->have_posts() ) {
		      while ( $contact->have_posts() ) {
		        $contact->the_post();

				$call = get_field('call_to_action', $contact->id);

				$call_options = array('internal_link' => 'internal_page', 'external_link' => 'external_url', 'download_file' => 'file');

				$call = (isset($call_options[$call])?$call_options[$call]:null);

				$link = get_field($call, $contact->id);

				if( is_array($link) )
				{
					$link = $link['url'];
				}

                ?>
                <aside id="side-bar" class="pull-right">
                	<div class="side-bar-box">
                    	<h2><?php echo get_field('title', $contact->id); ?></h2>
                        <h6><?php echo get_field('text_content', $contact->id); ?></h6>
                        <a href="<?php echo $link; ?>" class="link blue-link small-link"><?php echo get_field('link_text', $contact->id); ?></a>
                    </div>
                </aside>
                <?php

                }
                }

                ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>