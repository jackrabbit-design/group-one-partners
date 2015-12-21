<?php
/*
 * Template Name: Contact
 */

get_header();

?>

<div id="pg-title" style="background-image:url(<?php echo bloginfo('url'); ?>/ui/images/pg-banner.png)">
	<div class="container">
    	<div class="container-inner">
        	<h2><?php the_title(); ?></h2>
        </div>
    </div>
</div><!--pg-title-->

<div id="map">
    <a href="<?php the_field('google_maps_link', 'options'); ?>" target="_blank"></a>
</div>

<div id="contact-form-wrap" class="container">
	<div class="container-inner">
    	<div class="module2-box" id="contact-form">
        	<h3><?php echo get_field('main_office_title','options'); ?></h3>

            <div class="sec-row clearfix">
            	<div class="address pull-left">
                    <?php the_content(); ?>
                	<p><?php the_field('two_line_address','options'); ?><br />
                    <a href="<?php the_field('google_maps_link', 'options'); ?>" target="_blank">Get Directions</a></p>

					<p>
                    	<strong>P</strong>  <?php echo get_field('main_phone_number','options'); ?><br/>
						<strong>F</strong> <?php echo get_field('main_fax_number','options'); ?>
                    </p>

                    <div class="contact-social">
                      <?php if (get_field('linkedin_url','options')): ?>
                    	<a href="<?php echo get_field('linkedin_url','options'); ?>" target="_blank"><i class="social-linkedin"></i></a>
                      <?php endif; ?>
                      <?php if (get_field('facebook_url','options')): ?>
                      <a href="<?php echo get_field('facebook_url','options'); ?>" target="_blank"><i class="social-facebook"></i></a>
                      <?php endif; ?>
                      <?php if (get_field('twitter_url','options')): ?>
                      <a href="<?php echo get_field('twitter_url','options'); ?>" target="_blank"><i class="social-twitter"></i></a>
                      <?php endif; ?>
                    </div>
                </div>

                <div class="contact-form pull-right">
                <?php
                	gravity_form( 1, false, false, false, '', true, 0 ); //display the contact form
                ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>