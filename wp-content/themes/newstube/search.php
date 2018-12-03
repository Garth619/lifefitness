<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package cactus
 */

get_header(); ?>

	<div id="cactus-body-container"> <!--Add class cactus-body-container for single page-->

		<!--Listing-->
	    <div class="cactus-listing-wrap cactus-sidebar-control sb-right">
	        <!--Config-->
	        <div class="cactus-listing-config style-1 style-6 search-style"> <!--addClass: style-1 + (style-2 -> style-n)-->

	            <div class="container">
	                <div class="row">

	                    <div class="col-md-12 cactus-listing-content main-content-col"> <!--ajax div-->
                        	<?php if(is_active_sidebar('content-top-sidebar')){
								echo '<div class="content-top-sidebar-wrap">';
								dynamic_sidebar( 'content-top-sidebar' );
								echo '</div>';
							} ?>
	                    	<!--breadcrumb-->
	                        <?php if(function_exists('ct_breadcrumbs')){ ct_breadcrumbs(); } ?>
	                        <!--breadcrumb-->
							
							<?php if ( have_posts() ) : ?>
	                        <!--Search form-->
	                        <div class="cactus-elements-search">
	                        	<h2 class="h4 title-search-page"><?php echo esc_html__( 'Search Results for:', 'cactus' )." <span>" . get_search_query() . '</span>'; ?></h2>
	                            <span class="search-excerpt"><?php echo esc_html_e('If you didn\'t find what you were looking for, try a new search!','cactus');?></span>
	                            <div class="cactus-search-input">
	                            	<form action="<?php echo esc_url(home_url());?>" method="get">
	                            		<input type="hidden" name="post_type" value="post">
	                                	<input type="text" placeholder="<?php echo esc_html_e('Search...','cactus');?>" name="s" value="<?php echo esc_attr(get_search_query());?>">
	                                    <i class="fa fa-search"></i>
	                                    <input type="submit" value="<?php echo esc_html_e('search','cactus');?>">
	                                </form>
	                            </div>

	                        </div>
	                        <!--Search form-->
	                       	<?php endif;?>

	                        <div class="cactus-sub-wrap">

								<?php if ( have_posts() ) : ?>

									<?php /* Start the Loop */ ?>
									<?php while ( have_posts() ) : the_post(); ?>

										<?php
										/**
										 * Run the loop for the search to output the results.
										 * If you want to overload this in a child theme then include a file
										 * called content-search.php and that will be used instead.
										 */
										get_template_part( 'html/loop/content', 'search' );
										?>

									<?php endwhile; ?>

								<?php else : ?>

									<?php get_template_part( 'html/loop/content', 'none' ); ?>

								<?php endif; ?>
	                        </div>
                			<div class="page-navigation"><?php cactus_paging_nav('.cactus-listing-config .main-content-col .cactus-sub-wrap','html/loop/content-search'); ?></div>
                            <?php if(is_active_sidebar('content-bottom-sidebar')){
								echo '<div class="content-bottom-sidebar-wrap">';
								dynamic_sidebar( 'content-bottom-sidebar' );
								echo '</div>';
							} ?>
	                    </div>

	                    <?php get_sidebar(); ?>
	                </div>
	            </div>

	        </div><!--Config-->
	    </div><!--Listing-->

	</div>

		
		
		
<?php get_footer(); ?>
