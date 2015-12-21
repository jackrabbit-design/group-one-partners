<?php
get_header();

    // The Query
    //$the_id = 23;
    $frontpage_id = get_option('page_on_front');
    $featured = new WP_Query( 'page_id='.$frontpage_id );

    // The Loop
    if ( $featured->have_posts() ) {
      while ( $featured->have_posts() ) {
        $featured->the_post();

        if( has_post_thumbnail($featured->id) )
        {
            $img = get_post_thumbnail_id( $featured->id );
            $url = wp_get_attachment_url($img);//wp_get_attachment_image_src( $img, 'full' );

            $alt_text = get_post_meta($img , '_wp_attachment_image_alt', true);

            //echo '<img src="'.$url[0].'" alt="'.$alt_text.'" height="220" />';
        }
    }

    }

    wp_reset_postdata();

?>
    <div id="pg-title" style="background-image:url('<?php echo (isset($url)?$url:'') ?>')">
        <div class="container">
            <div class="container-inner">
                <h2>Insights</h2>
            </div>
        </div>
    </div><!--pg-title-->

    <?php
        while ( have_posts() ) { the_post(); };

        if( has_post_thumbnail(get_the_ID()) )
        {
            $img = get_post_thumbnail_id( get_the_ID() );
            $url = wp_get_attachment_url($img);//wp_get_attachment_image_src( $img, 'full' );

            $alt_text = get_post_meta($img , '_wp_attachment_image_alt', true);

            //echo '<img src="'.$url[0].'" alt="'.$alt_text.'" height="220" />';
        }

        $category = get_the_category();
    ?>

    <div id="pg-module">
        <div class="container">
            <div class="container-inner clearfix">
                <div id="article" class="pull-left main-content">
                    <h5><?php echo the_date(); ?>  |  <?php echo $category[0]->cat_name; ?></h5>
                    <h3><?php echo the_title(); ?></h3>
                 </div>

                 <div id="side-bar" class="pull-right">
                    <div class="side-bar-box media-detail-side">
                        <img src="<?php echo (isset($url)?$url:'') ?>" width="388" height="258" alt="<?php echo (isset($alt_text)?$alt_text:'') ?>" />
                        <h6><?php echo get_field('featured_image_blurb'); ?></h6>
                    </div>
                </div>

                 <article id="article" class="pull-left main-content">
                    <?php echo the_content(); ?>
                </article>

            </div>
        </div>
    </div>

    <?php 
        get_template_part( 'featured', 'post' );
    ?>
<?php get_footer(); ?>