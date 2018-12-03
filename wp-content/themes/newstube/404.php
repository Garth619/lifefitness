<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package cactus
 */

get_header(); ?>

	<div id="cactus-body-container"> <!--Add class cactus-body-container for single page-->
		<div class="cactus-single-page cactus-sidebar-control">
	    	<div class="container">
	        	<div class="row">

	            	<div class="col-md-12 cactus-config-single main-content-col"> <!--ajax div-->



	                    <!--breadcrumb-->
	                     <?php if(function_exists('ct_breadcrumbs')){ ct_breadcrumbs(); } ?>
	                    <!--breadcrumb-->

	                	<div class="single-page-content"><!--Single Page Content-->

	                        <article class="cactus-single-content" >
	                            <h1 class="title-404"><?php echo ot_get_option('page_title', '404');?></h1>
	                            <h2 class="infor-404"><?php echo ot_get_option('page_description', 'page not found');?></h2>
	                            <h3 class="content-404"><?php echo ot_get_option('page_content', 'Sorry! The page you are looking for can not be found');?></h3>
	                            <div class="gotohome-404"><a href="<?php echo esc_url(home_url());?>" class="btn btn-default"><?php esc_html_e('GO TO HOMEPAGE', 'cactus');?></a></div>
	                        </article>

	                    </div>
	                </div>

	            </div>
	        </div>
	    </div>
	</div>

<?php get_footer(); ?>
