<?
get_header();
the_post();
?>
<div id="pg-title" style="background-image:url(<?php echo bloginfo('url') ?>/ui/images/pg-banner.png)">
  <div class="container">
      <div class="container-inner">
          <h2>Our Team</h2>
        </div>
    </div>
</div><!--pg-title-->


    <div id="pg-module">
    	<div class="container">
        	<div class="container-inner">
            	<div id="bio-top" class="clearfix">
                	<div class="member-pic pull-left">
                      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'team-bio-primary' ); ?>
                    	<img src="<?php echo $image[0]; ?>" width="658" height="400" alt="" />
                    </div>
                    <div class="photos pull-right" style="background-image:url(<?php $image = get_field('secondary_image'); echo $image['sizes']['team-bio-secondary']; ?>)"></div>
                </div>

                <div class="bio-content clearfix">
                	<div class="top-row" class="pull-left">
                    	<h3><?php echo the_title()?></h3>
                        <ul>
                          <?php if( get_field('title') ){ ?>
                        	<li><?php echo strtoupper(get_field('title'));?></li>
                          <?php } ?>
                          <?php if (get_field('email_address')){ ?>
                            <?php
                              $name = get_the_title();
                              $name_parts = explode(" ",$name);
                            ?>
                            <li><a href="mailto:<?php echo get_field('email_address')?>" class="mail">EMAIL <?php echo strtoupper($name_parts[0]);?></a></li>
                          <?php } ?>
                        </ul>
                    </div>
                    <article id="bio-article" class="pull-left">
                        <?php echo get_field('bio'); ?>

                        <div class="mobile-bottom-image">
                        	<img src="<?php $image = get_field('secondary_image'); echo $image['sizes']['team-bio-secondary']; ?>" alt="" />
                        </div>
                    </article>

                    <?php if (have_rows('quotes')){ ?>
                    <aside id="bio-side-bar" class="pull-right">
                      <?php while (have_rows('quotes')) : the_row(); ?>
                    	<blockquote>
                        	<p><?php echo get_sub_field('quote'); ?></p>
                          <? if (get_sub_field('attribution')){ ?>
                            <span><?php echo strtoupper(get_sub_field('attribution')); ?></span>
                          <? } ?>
                        </blockquote>
                      <?php endwhile; ?>
                    </aside>
                    <?php } ?>
                </div><!--bio-content-->
            </div>
        </div>

        <?php
          if (have_rows('interests')){
        ?>
        <div class="module container">
            <div class="container-inner">
                <h3>My Interests</h3>
                <ul class="interests col-three">
                  <?php while (have_rows('interests')) : the_row(); ?>
                	<li>
                    	<a href="javascript://">
                        	<img src="<?php $image = get_sub_field('image'); echo $image['sizes']['my-interests-thumbnail']; ?>" alt="" />
                            <div class="hover-box">
                            	<h4><?php echo get_sub_field('name');?></h4>
                            </div>
                        </a>
                    </li>
                  <?php endwhile; ?>
                </ul>
            </div>
         </div>
        <?php } // any interests? ?>
     </div>
    <?php get_footer(); ?>