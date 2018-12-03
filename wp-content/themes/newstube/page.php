<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package cactus
 */

get_header();

$sidebar = get_post_meta(get_the_ID(),'page_sidebar',true);
if(!$sidebar){
	$sidebar = ot_get_option('page_sidebar','right');
}
if($sidebar == 'hidden') $sidebar = 'full';
?>

    <div id="cactus-body-container"> <!--Add class cactus-body-container for single page-->
        <div class="cactus-single-page cactus-sidebar-control <?php if($sidebar!='full'){ echo "sb-".$sidebar; } ?>">
            <div class="container">
                <div class="row">

                    <div class="main-content-col col-md-12 cactus-config-single">

                    <?php if(is_active_sidebar('content-top-sidebar')){
                        echo '<div class="content-top-sidebar-wrap">';
						dynamic_sidebar( 'content-top-sidebar' );
						echo '</div>';
                    } ?>

                    <?php while ( have_posts() ) : the_post(); ?>
                        <!--breadcrumb-->
                        <?php if(function_exists('ct_breadcrumbs')){ ct_breadcrumbs(); } ?>
                        <!--breadcrumb-->

                        <div class="cactus-listing-heading"><h1><?php the_title();?></h1></div>

                        <?php get_template_part( 'html/single/content', 'page' ); ?>

                    <?php endwhile; // end of the loop. ?>

                    <?php $disable_comments =ot_get_option('disable_comments', 'off');?>
                    <?php if($disable_comments != 'on'):?>
                        <div class="comment-form-fix">
                            <?php
                                if ( comments_open() || '0' != get_comments_number() )
                                    comments_template();
                            ?>
                        </div>
                    <?php endif;?>

                    <?php if(is_active_sidebar('content-bottom-sidebar')){
                        echo '<div class="content-bottom-sidebar-wrap">';
                        dynamic_sidebar( 'content-bottom-sidebar' );
                        echo '</div>';
                    } ?>

                    </div>


                    <?php if($sidebar!='full'){ get_sidebar(); } ?>

                </div><!--.row-->
            </div><!--.container-->
        </div><!--#cactus-single-page-->
    </div><!--#cactus-body-container-->

<?php get_footer(); ?>
