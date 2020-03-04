<footer id="footer">
    	<div class="container">
        	<div class="container-inner">
            	<div class="f-row-one clearfix">
                	<div class="box-one pull-left">
                    	<p><?php echo get_field('one_line_address','options'); ?></p>
                        <ul>
                          <?php if (get_field('main_phone_number','options')): ?>
                        	<li><p><strong>P</strong>  <?php echo get_field('main_phone_number','options'); ?></p></li>
                          <?php endif; ?>
                          <?php if (get_field('main_fax_number','options')): ?>
                        	<li><p> <strong>F</strong> <?php echo get_field('main_fax_number','options'); ?></p></li>
                          <?php endif; ?>
                        </ul>
                    </div>

                    <div class="box-two pull-right">
                      <?php if (get_field('linkedin_url','options')): ?>
                    	<a href="<?php echo get_field('linkedin_url','options'); ?>" target="_blank"><i class="social-linkedin"></i></a>
                      <?php endif; ?>
                      <?php if (get_field('facebook_url','options')): ?>
                      	<a href="<?php echo get_field('facebook_url','options'); ?>" target="_blank"><i class="social-facebook"></i></a>
                      <?php endif; ?>
                      <?php if (get_field('twitter_url','options')): ?>
                      	<a href="<?php echo get_field('twitter_url','options'); ?>" target="_blank"><i class="social-twitter"></i></a>
                      <?php endif; ?>
                      <?php if (get_field('instagram_url','options')): ?>
                      	<a href="<?php echo get_field('instagram_url','options'); ?>" target="_blank"><i class="social-instagram"></i></a>
                      <?php endif; ?>
                    </div>
                </div><!--f-row-one-->

                <div class="f-copy-right">
                	<p> &copy; <?php echo date("Y"); ?>, Group One Partners, Inc. All rights reserved </p>
                </div>

                <div class="jrd">
                	<span class="jackrabbit"><a href="http://www.jumpingjackrabbit.com" title="Website Design by Jackrabbit" target="_blank">Website Design</a> by <a href="http://www.jumpingjackrabbit.com" title="Website Design by Jackrabbit" target="_blank">Jackrabbit</a></span>
                </div>
            </div>
        </div>
    </footer>


    <?php wp_footer(); ?>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-18325848-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>