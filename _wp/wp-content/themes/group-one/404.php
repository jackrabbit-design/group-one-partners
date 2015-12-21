<?php get_header(); ?>

<section id="err-banner" style="background-image:url(<?php echo get_bloginfo('url'); ?>/ui/images/404-banner.jpg)">
    	<h2>$#%@!</h2>
    </section>

    <section id="err-pg-content" class="container">
    	<div class="container-inner">
        	<div class="module2-box">
            	<h3>Sorry, it's been a rough day.</h3>
                <p>It looks like we can't find the page you're looking for. Perhaps try a search?</p>
                <div class="search-form">
                	<form action="<?php echo site_url()?>/search-results/" method="post">
                    	<ul>
                        	<li>
                            	<div>
                                	<input type="text" placeholder="Search again" name="search" />
                                </div>
                            </li>
                            <li>
                            	<div>
                                	<button class="blue-btn" type="submit"></button>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>