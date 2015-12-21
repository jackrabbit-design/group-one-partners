<?php
/*
 * Template Name: Work Landing
 */
get_header();
the_post();
?>

<div id="pg-title" style="background-image:url(<?php echo bloginfo('url'); ?>/ui/images/pg-banner.png)">
    	<div class="container">
        	<div class="container-inner">
            	<h2><?php the_title(); ?></h2>
            </div>
        </div>
    </div><!--pg-title-->

    <div id="work-langing-top">
    	<div class="container">
        	<div class="container-inner main-content">
                <?php echo the_content(); ?>
            </div>
        </div>
    </div>

    <?php
    $args_projects = array ('post_type' =>'projects','order'=>'DESC', 'posts_per_page' => -1 );
    $projects = new WP_Query( $args_projects );
    ?>

    <?php if (empty($projects)){ ?>
    No projects have been added.
    <?php }else{ ?>
    <div id="grid-wrapper">
    	<div class="container">
        	<div class="container-inner">
            <div id="works-grid">
              <?php foreach( $projects->posts as $project ) { ?>
                <?php $project_scope = get_field('project_scope',$project->ID); ?>

                <?php if ($project_scope == 'large'){ ?>
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $project->ID ), 'large-project-thumbnail' ); ?>
                    <span class="box size22" style="background-image:url(<?php echo $image[0] ?>)">
                    	<h5><?php echo $project->post_title ?></h5>
                        <a href="<?php echo get_permalink($project->ID); ?>" class="hover-box">
                        	<div class="inner-wrap">
                            	<h3><?php echo $project->post_title ?></h3>
                                <h6><?php echo get_field('location',$project->ID);?></h6>
                                <p><?php echo get_field('short_description',$project->ID)?></p>
                                <span class="btn white-outline">view <span>project</span></span>
                            </div>
                        </a>
                    </span>
                <?php }elseif ($project_scope == 'medium'){ ?>
                  <?
                  // orientation
                  if (get_field('image_orientation',$project->ID)=='horizontal'){
                    $size_class = "size21"; // horizontal
                    $thumb_size = "medium-project-thumbnail-horizontal";
                  }else{
                    $size_class = "size12"; // vertical
                    $thumb_size = "medium-project-thumbnail-vertical";
                  }
                  ?>
                  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $project->ID ), $thumb_size ); ?>
                  <span class="box <?php echo $size_class; ?>" style="background-image:url(<?php echo $image[0]; ?>)">
                    <a href="<?php echo get_permalink($project->ID); ?>" class="hover-box">
                        <div class="inner-wrap">
                            <h4><?php echo $project->post_title ?></h4>
                              <span class="btn white-outline">view <span>project</span></span>
                          </div>
                      </a>
                  </span>
                <?php }else{ // small ?>
                  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $project->ID ), 'small-project-thumbnail' ); ?>
                  <span class="box size11" style="background-image:url(<?php echo $image[0]; ?>)">
                    <a href="<?php echo get_permalink($project->ID); ?>" class="hover-box">
                        <div class="inner-wrap">
                            <h4><?php echo $project->post_title ?></h4>
                              <span class="btn white-outline">view <span>project</span></span>
                          </div>
                      </a>
                  </span>
                <?php } ?>
              <?php } ?>
            </div>
          </div>
      </div>
      <div class="loading">

       </div>
    </div>


    <?php } ?>

<?php get_footer(); ?>