<?php
/*
 * Template Name: Media Overview
 */

get_header();

/*--- Yearly Archive ----*/
$yearly_archive = @$_SESSION['yearly_archive'];
if (isset($_POST['yearly_archive'])){ // Website Form
  $_SESSION['yearly_archive'] = $yearly_archive = $_POST['yearly_archive'];
}elseif (isset($_GET['yearly_archive'])){ // Mobile Links
  $_SESSION['yearly_archive'] = $yearly_archive = $_GET['yearly_archive'];
}


$args = array (
  'post_status'            => array( 'publish' ),
  'posts_per_page' => -1
); // These $args are used again below to query for posts

/*----- Determine which years we have posts for UI ---*/
$available_years = array();
$query = new WP_Query($args);
if (!empty($query)){
  foreach($query->posts as $insights_post){
    $year = date("Y",strtotime($insights_post->post_date));
    if (!in_array($year,$available_years)) array_push($available_years,$year);
  }
  sort($available_years);
}
/*----- End years ---*/

if( count($args) )
{
	echo '<div class="" style="display:none;">'.json_encode($args).'</div>';
}

?>
	<div id="pg-title" style="background-image:url(<?php echo bloginfo('url'); ?>/ui/images/pg-banner.png)">
    	<div class="container">
        	<div class="container-inner">
            	<h2><?php
                  // We want to display the title of the blog page (without subtitles) so we need to retrieve that page title manually
                  // if( get_option('page_for_posts') ) {
                  //   $blog_page_id = get_option('page_for_posts');
                  //   echo get_page($blog_page_id)->post_title;
                  // }
                the_title();
                ?></h2>
            </div>
        </div>
    </div><!--pg-title-->

    <div id="media-filter">
    	<div class="container">
        	<div class="container-inner clearfix">
            	<div class="desktop-filter hidden-s">
                    <div class="pull-left">
                        <h5>SORT BY</h5>
                        <ul>
                    	<?php
                    		$permalink = get_permalink($post->post_parent);

                        	$cat_list = array('All', 'News', 'Awards', 'Publications');

                        	$active = ' class="active"';

                        	for( $i = 0; isset($cat_list[$i]); $i++)
                        	{
	                        	echo '<li'.(isset($category_page)?($category_page==strtolower($cat_list[$i])?$active:''):($i==0?$active:'')).'><a href="'.$permalink.($i>0?strtolower($cat_list[$i]).'/':'').'">'.$cat_list[$i].'</a></li>';
                        	}
                    	?>
                        </ul>
                    </div>

                    <div class="pull-right">
                        <h5>YEARLY ARCHIVE</h5>
                        <div class="select-wrap">
                          <form method='post'>
                            <select name='yearly_archive' class='yearly_archive_select'>
                                <option value=''>Show All</option>
                                <?php for($i=count($available_years)-1;$i>=0;$i--){ ?>
                                <option value='<?php echo $available_years[$i]?>'<?php echo @$yearly_archive==$available_years[$i]?' selected':''?>><?php echo $available_years[$i]?></option>
                                <?php } ?>
                            </select>
                          </form>
                        </div>
                    </div>
                </div><!--desktop filter-->

                <div class="mobile-filter visible-s">
                	<nav class="toggle-nav">
                    	<div class="dropdown"><span>Filter</span></div>

                        <ul>
                        	<li class="dropdown-section">
                            	Sort By
                                <?php
		                        	$cat_list = array('All', 'News', 'Awards', 'Publications');

		                        	for( $i = 0; isset($cat_list[$i]); $i++)
		                        	{
			                        	echo '<li'.(isset($category_page)?($category_page==strtolower($cat_list[$i])?$active:''):($i==0?$active:'')).'><a href="'.$permalink.($i>0?strtolower($cat_list[$i]).'/':'').'">'.$cat_list[$i].'</a></li>';
		                        	}
		                    	?>
                            </li>
                            <li class="dropdown-section">YEARLY ARCHIVE</li>
                                	<li><a href="<?php echo $permalink?>?yearly_archive=">Show All</a></li>
                                  <?php for($i=count($available_years)-1;$i>=0;$i--){ ?>
                                  <li><a href="<?php echo $permalink?>?yearly_archive=<?php echo $available_years[$i]?>"><?php echo $available_years[$i]?></a></li>
                                  <?php } ?>
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div id="pg-module">
    	<div class="container">
        	<div class="container-inner clearfix">
            	<ul id="media" class="">

            	<?php


				    $section_3_title = get_post_meta( get_the_ID(), 'wpcf-section-3-title', true );
				    $section_3_text = get_post_meta( get_the_ID(), 'wpcf-section-3-text', true );

				    // WP_Query arguments

            if (!empty($yearly_archive)){
              $args['year'] = $yearly_archive;
            }

					//$args['posts_per_page'] = (isset($_GET['count'])?$_GET['count']:6); //6
          $args['posts_per_page'] = -1; // unlimited scroll
					$args['paged'] = (isset($_GET['index'])?$_GET['index']:1);

				    if( isset($category_page) )
				    {
					    $args['category_name'] = $category_page;
              $category_object = get_category_by_slug($category_page);
              $category_name = @$category_object->name;
				    }
				    // The Query
				    $query = new WP_Query( $args );
				    //echo $query->request; die();
				    // The Loop
				    if ( $query->have_posts() ) {
				      while ( $query->have_posts() ) {
				        $query->the_post();

                $category = get_the_category();

				        $url = ''; //prevent issues if it doesn't exist

				  	  if( has_post_thumbnail(get_the_ID()) )
				  	  {
				  	  	$img = get_post_thumbnail_id( get_the_ID() );
				  	  	$url = wp_get_attachment_url($img);//wp_get_attachment_image_src( $img, 'full' );

				  	  	$alt_text = get_post_meta($img , '_wp_attachment_image_alt', true);

				  	  }



			    ?>
			    	<li class="mix <?php echo strtolower($category[0]->cat_name); ?>">
                <div class="img-wrap">
                    <?php the_post_thumbnail('insights-thumbnail'); ?>
                    <a href="<?php echo the_permalink(); ?>" class="hover-box">
                      <span class="lrg-btn white-outline">read more</span>
                    </a>
                </div>

                <h5><?php echo get_the_date(); ?>  |  <?php echo $category[0]->cat_name; ?></h5>
                <h4><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h4>
                <p><?php echo get_field('overview_sentence') ?></p>
                <a href="<?php echo the_permalink(); ?>" class="link blue-link small-link">READ MORE</a>
            </li>

				<?php }
				    } else {
              // create error message
              $message = "No posts were found";
              if (!empty($category_name)){
                $message .= " within the " . $category_name . " category";
              }
              if (!empty($yearly_archive)){
                $message .= " during ".$yearly_archive;
              }
              $message .= ".";
				      ?>
              <h4><?php echo $message; ?></h4>
              <?php
				    }

				    // Restore original Post Data
				    wp_reset_postdata();
            ?>
              <li class='gap'></li>
              <li class='gap'></li>
              <li class='gap'></li>
              <li class='gap'></li>
              </ul>

                <div class="loading">
					<span></span>
                </div>
            </div>
        </div>
     </div>

	<?php /**
     *  Auto-Submit Yearly Archive form(s) when user selects a value
     *	Moved to jquery.init.js - Amber
     */ ?>
<?php get_footer(); ?>