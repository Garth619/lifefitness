<?php do_action( 'cactus_before_nav' ); ?>

<?php
    global $navigation_style;

    $page_on_front = get_option('page_on_front');
    $navigation_style = ot_get_option('navigation_style', 'style_1');

    if((is_front_page() && $page_on_front != 0) || is_page_template('page-templates/front-page.php'))
    {
        $navigation_style = get_post_meta(get_the_ID(),'front_page_navigation_style',true) == '' ? ot_get_option('navigation_style', 'style_1') : get_post_meta(get_the_ID(),'front_page_navigation_style',true);
    }

    if($navigation_style == 'style_1')
        $navigation_style_class = '';
    else if($navigation_style == 'style_2')
        $navigation_style_class = 'style-2';
    else if($navigation_style == 'style_3')
        $navigation_style_class = 'style-3';
    else if($navigation_style == 'style_4')
        $navigation_style_class = 'style-4';
?>
<!--Navigation style-->
<div class="cactus-nav <?php echo $navigation_style_class;?>">

    <!--Top NAV-->
    <?php get_template_part( 'html/header/header', 'navigation-top' ); ?>
    <!--Top NAV-->

    <!--Branding-->
    <?php get_template_part( 'html/header/header', 'navigation-branding' ); ?>
    <!--Branding-->

    <!--Primary menu-->
    <?php get_template_part( 'html/header/header', 'navigation-primary' ); ?>
    <!--Primary menu-->

</div>
<!--Navigation style-->
<?php do_action( 'cactus_after_nav' ); ?>
