<?php
    global $navigation_style;
?>
<div id="main-nav" class="nav-branding">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">

            <!--Logo-->
            <div class="navbar-header">
                <!--logo-->
                <a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>">
                    <div class="primary-logo">
                        <?php $logo = ot_get_option('logo_image','') == '' ? esc_url(get_template_directory_uri()) . '/images/logo.png' : ot_get_option('logo_image',''); ?>
                        <img src="<?php echo $logo; ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    </div>
                </a><!--logo-->
            </div><!--Logo-->
            <?php if($navigation_style != 'style_4'):?>
                <ul class="nav navbar-nav navbar-right rps-hidden cactus-header-ads">
                    <li><?php cactus_display_ads('ads_top_nav');?></li>
                </ul>
            <?php endif;?>

        </div>
    </nav>
</div>
