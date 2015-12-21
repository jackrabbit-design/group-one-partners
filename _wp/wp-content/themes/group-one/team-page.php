<?php
/*
 * Template Name: Team Landing
 */

get_header();
the_post();
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
            	<ul id="team-members">
                  <?php
                    $args_team = array ('post_type' =>'team','orderby'=>'rand', 'posts_per_page' => -1 );
                    $team_members = new WP_Query( $args_team );
                  ?>
                  <?php if (!empty($team_members)){ ?>
                    <?php foreach( $team_members->posts as $team_member ) { ?>
                      <li>
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $team_member->ID ), 'team-thumbnail' ); ?>
                        <span class="active img-box" data-count="2" data-num="1" style="background-image:url(<?php echo $image[0] ?>)"></span>

                        <span class="text-box-container" data-count="2" data-num="2">
                        	<div class="text-box">
                                <div class="inner-wrap">
                                    <h6><?php echo get_field("fun_fact",$team_member->ID);?></h6>
                                </div>
                            </div>
                        </span>

                        <a href="<?php echo get_permalink($team_member->ID); ?>" class="hover-box">
                        	<div class="inner-wrap">
                            	<h4><?php echo $team_member->post_title?></h4>
                                <?
                                $title_role = get_field('title',$team_member->ID);
                                ?>
                                  <h5><?php echo @strtoupper($title_role)?></h5>
                                <span class="btn white-outline">view bio</span>
                            </div>
                        </a>

                        <img src="<?php echo bloginfo('url'); ?>/ui/images/our-team-ratio.png" width="270" height="220" alt=""/>
                    </li>
                    <?php } ?>
                  <?php } ?>

                </ul>

                <div class="loading">
                </div>
            </div>
        </div>
     </div>



<?php get_footer(); ?>