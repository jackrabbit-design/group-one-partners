<?php

get_header();
the_post();


// Retrieve random home page header (assumes at least 1 header in the system)
$rows = get_field('headers');
$header_index = mt_rand(0,count($rows)-1);
$header = $rows[$header_index];
?>
<div id="hm-slider">
	<ul>
    	<li>
        	<div class="banner-bg" style="background-image:url(<?php echo $header['header_image']['sizes']['main-project-banner']; ?>)">
            	<div class="banner-text">
                	<div class="container">
                    	<div class="container-inner">
                          <?
                          if ($header['header_call_to_action'] != 'none'){
                            if ($header['header_call_to_action']=='internal_link'){
                              $url = $header['header_internal_page'];
                              $target = "";
                            }else{
                              $url = $header['header_external_url'];
                              $target = " target='_blank'";
                            }
                          ?>
                            <a href="<?php echo $url?>"<?php echo $target?>>
                            	<div><?php echo $header['header_label']?> <span>|</span></div> <?php echo $header['header_link_label']?>
                            </a>
                          <?php } ?>
                      </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>

<div class="container" id="home-box-wrapper">
	<div class="container-inner">
        <div id="hm-box-one">
            <h2><?php echo get_field('leading_paragraph')?></h2>
            <div class='secondary'><?php echo get_field('secondary_paragraph')?></div>
            <?php if (get_field('main_call_to_action') != 'none'){ ?>
            <?php
              if (get_field('main_call_to_action')=='internal_link'){
                $url = get_field('main_internal_url');
                $target = "";
              }else{
                $url = get_field('main_external_url');
                $target = " target='_blank'";
              }

            ?>
            <a href="<?php echo $url?>"<?php echo $target?> class="link blue-link"><?php echo get_field('main_call_to_action_label');?></a>
            <?php } ?>
        </div>
    </div>
</div>

<?php
if (get_field('show_featured_content')){
  include("featured-post.php");
}
?>


<?php get_footer(); ?>