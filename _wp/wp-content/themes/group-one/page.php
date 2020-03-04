<?php
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
                <article id="article" class="pull-left main-content">
                <?php
                  if (have_rows('content_areas')){
                    while (have_rows('content_areas')) : the_row();
                      if (get_sub_field('content_type')=='featured'){
                        ?><blockquote><?php echo get_sub_field('body_content')?></blockquote><?php
                      }else{
                        echo get_sub_field('body_content');
                      }
                    endwhile;
                  }

                  $args = array (
                      'post_type'              => array( 'services' ),
                      'post_status'            => array( 'publish' ),
                      'posts_per_page' => 1
                    );

                ?>
              </article>

                <aside id="side-bar" class="pull-right">
                    <div id="latest-news-wrap">
                        <div class="top-row clearfix">
                            <h3 class="pull-left">Latest News</h3> <a href="<?php bloginfo('url')?>/insights" class="link blue-link pull-right small-link">VIEW ALL NEWS</a>
                        </div>
                        <?php
                          if (have_rows('news_articles')){
                            // Show the article(s) selected on this specific page, if selected
                            $post_in = array();
                            while(have_rows('news_articles')) : the_row();
                              $article = get_sub_field('article');
                              array_push($post_in,$article->ID);
                            endwhile;
                            $args = array("post_type"=>"post","post__in"=>$post_in,"posts_per_page"=>-1);
                          }else{
                            $args = array("post_type"=>"post","posts_per_page"=>1);
                          }
                          $news = new WP_Query($args);
                          if ( $news->have_posts() ) {
                        ?>
                        <ul id="latest-news">
                          <?php
                            foreach($news->posts as $article){
                          ?>
                            <li>
                              <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $article->ID ), 'interior-news-thumb' ); ?>
                                <a href="<?php echo get_permalink($article->ID)?>"><img src="<?php echo $image[0] ?>" width="388" height="258" alt="" /></a>
                                <h6><?php echo date("m/d/Y",strtotime($article->post_date)) ?></h6>
                                <h4><?php echo $article->post_title; ?></h4>
                                <p><?php echo wp_trim_words($article->post_content,20); ?></p>
                                <a href="<?php echo get_permalink($article->ID)?>" class="link blue-link small-link">READ MORE</a>
                            </li>
                            <?php } ?>
                        </ul>
                          <?php } ?>
                    </div><!--latest-news-->
                </aside>
            </div>
        </div>
    </div>



<?php

get_template_part( 'featured', 'post' );

get_footer();
?>