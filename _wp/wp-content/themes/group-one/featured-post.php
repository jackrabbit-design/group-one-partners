<?php

    /**
     * Featured Posts appear on pages with the General Interior Template and Insights Posts
     *
     * If "Show Custom Featured Content" is flagged for the page or post, its own content will be shown.
     * If the above flag is not checked, the Featured Content from the Home Page will be shown.
     */

    // Determine whether we show featured content by the current page or the home page.
    if (get_field('show_featured_content')){
      $args = get_post_type()."_id=".get_the_ID(); // Set up the WP query var to query by page/post
    }else{
      // Load the Home Page Featured Post info
      $frontpage_id = get_option('page_on_front');
      $args = 'page_id='.$frontpage_id; // Load home page content by default
    }

    // The Query
    $featured_query = new WP_Query( $args );

    // The Loop
    if ( $featured_query->have_posts() ) {
      $featured_query->the_post();

      // Set up URL values based on call to action type
      $call_to_action_type = get_field('call_to_action', $featured->ID);
      $call_to_action_target = $call_to_action_type=='external_link' ? " target='_blank'" : ""; // External links to to _blank, internal links do not

      // Map the value to the proper field based on the call to action type
      $call_options = array('internal_link' => 'internal_page', 'external_link' => 'external_url', 'download_file' => 'file');
      $call_to_action_value_field = (isset($call_options[$call_to_action_type])?$call_options[$call_to_action_type]:null);
      $call_to_action_url = get_field($call_to_action_value_field);

      // When linking to a downloadable file, WP passes an array. Convert to string if needed.
      if(is_array($call_to_action_url)){
        $call_to_action_url = $call_to_action_url['url'];
      }

      // Get the image for the featured post
      $featured_img = get_field('image');

?>

<div id="home-featured" style="background-image:url(<?php echo bloginfo('url'); ?>/ui/images/feature-bg.jpg)">
	<div class="container">
    	<div class="container-inner">
        	<div class="box-wrapper clearfix">

                <div class="pull-right box box-one" style="background-image:url('<?php echo (isset($featured_img['sizes']['team-bio-primary'])?$featured_img['sizes']['team-bio-primary']:'') ?>')">
                </div>

                <div class="box-two box pull-left">
                    <?php if (get_field('call_to_action') != "none"){ ?>
                    <h3><a href="<?php echo $call_to_action_url; ?>"<?php echo $target?>><?php echo get_field('title'); ?></a></h3>
                    <?php }else{ // No call to action. Display text instead of hyperlink ?>
                    <h3><?php echo get_field('title'); ?></h3>
                    <?php } ?>
                    <?php echo get_field('text_content'); ?>
                    <?php if (get_field('call_to_action') != "none"){ ?>
                    <a href="<?php echo $call_to_action_url; ?>"<?php echo $call_to_action_target?> class="link blue-link"><?php echo get_field('link_text'); ?></a>
                    <?php } ?>
                </div>
             </div>
        </div>
    </div>
</div>

<?php
} // did we find a featured post?

    // Restore original Post Data
    wp_reset_postdata();
?>