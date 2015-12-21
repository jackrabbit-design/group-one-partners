<?php

get_header();
the_post();
?>
<ul class="rslides">
  <?
    if (have_rows('banner_images')){
      while (have_rows('banner_images')) : the_row();
      $image = get_sub_field("image");
      ?>
        <li><div id="work-detail-banner" style="background-image:url(<?php echo $image['sizes']['main-project-banner']; ?>)">
        <?php echo (get_sub_field('photo_credit_slide') ? '<div class="container"><span class="photo-credit">' . get_sub_field('photo_credit_slide') . '</span></div>' : ''); ?>
    </div></li>
        <?
      endwhile;
    }
  ?>
</ul>
<script>
  $(function() {
    $(".rslides").responsiveSlides({
      auto: true,             // Boolean: Animate automatically, true or false
      speed: 500,            // Integer: Speed of the transition, in milliseconds
      timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
      pager: true,           // Boolean: Show pager, true or false
      nav: true,             // Boolean: Show navigation, true or false
      random: false,          // Boolean: Randomize the order of the slides, true or false
      pause: false,           // Boolean: Pause on hover, true or false
      namespace: "transparent-btns"   // String: Change the default namespace used
    });
  });
</script>


    <div id="work-title" style="background-image:url(<?php echo get_bloginfo('url');?>/ui/images/pg-banner.png)">
    	<div class="container">
        	<div class="container-inner">
            	<h2><?php the_title();?></h2>
              <h5><?php $id=get_the_ID(); echo the_field('location',$id); ?></h5>
            </div>
        </div>
    </div>


<section id="work-detail">
    	<div class="container">
        	<div class="container-inner">
            	<ul id="work-detail-box">
                	<li>


  <?
    if (have_rows('content_rows')){
      while (have_rows('content_rows')) : the_row();
      $layout = get_sub_field('row_layout');
      switch($layout){
        case 'text_image':
          ?>
          <div class="work-content clearfix module3">
              <div class="box-one pull-left main-content">
                  <?php echo get_sub_field('text'); ?>
              </div>
             <?php $image = get_sub_field('image_1'); ?>
              <div class="pull-right image-box">

                    <span class="lightbox-img">
                        <?php echo (get_sub_field('photo_credit') ? '<span class="photo-credit">' . get_sub_field('photo_credit') . '</span>' : ''); ?>
                        <img src="<?php echo $image['sizes']['large-project-detail-row']; ?>" alt="" />
                          <a href="<?php echo $image['sizes']['large'];?>" class="hover-box">
                            <div class="btn white-outline">view <span>image</span></div>
                          </a>
                      </span>
                  
              </div>
          </div>
          <?
          break;
        case 'images':
          ?>
          <div class="bottom-box module3">
            <ul>
                <li>
                  <?php $image = get_sub_field('image_1'); ?>
                    <span class="lightbox-img" style="background-image:url(<?php echo $image['sizes']['medium-project-thumbnail']; ?>)">
                          <a href="<?php echo $image['sizes']['large']; ?>" class="hover-box">
                            <div class="btn white-outline">view <span>image</span></div>
                          </a>
                      </span>
                  </li>
                  <?php $image = get_sub_field('image_2'); ?>
                  <li>
                    <span class="lightbox-img" style="background-image:url(<?php echo $image['sizes']['medium-project-thumbnail']; ?>)">
                          <a href="<?php echo $image['sizes']['large']; ?>" class="hover-box">
                            <div class="btn white-outline">view <span>image</span></div>
                          </a>
                      </span>
                  </li>
                  <?php $image = get_sub_field('image_3'); ?>
                  <li>
                    <span class="lightbox-img" style="background-image:url(<?php echo $image['sizes']['medium-project-thumbnail']; ?>)">
                          <a href="<?php echo $image['sizes']['large']; ?>"  class="hover-box">
                            <div class="btn white-outline">view <span>image</span></div>
                          </a>
                      </span>
                  </li>
              </ul>
          </div>
          <?
          break;
        case 'image_text':
          ?>
          <div class="work-content clearfix module3">
                <?php $image = get_sub_field('image_1'); ?>
                <div class="box-one pull-left image-box">

                    <span class="lightbox-img">
                        <?php echo (get_sub_field('photo_credit') ? '<span class="photo-credit">' . get_sub_field('photo_credit') . '</span>' : ''); ?>
                        <img src="<?php echo $image['sizes']['large-project-detail-row']; ?>" alt="" />
                          <a href="<?php echo $image['sizes']['large']; ?>"  class="hover-box">
                            <div class="btn white-outline">view <span>image</span></div>
                          </a>
                      </span>

                </div>
                <div class="pull-right main-content box-one">
                  <?php echo get_sub_field('text'); ?>
                </div>
           </div><!--work-content-->
          <?
          break;
      }
      ?>

        <?
      endwhile;
    }
  ?>

                    </li>
                </ul>
            </div>
        </div>
    </section>

<?php get_footer(); ?>