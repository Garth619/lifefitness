<?php
add_action( 'wp_enqueue_scripts', 'newstube_parent_style' );

function newstube_parent_style() {
	wp_enqueue_style( 'newstube-css', get_template_directory_uri() . '/style.css', array('bootstrap', 'mashmenu-css', 'font-awesome', 'swiper'));
}

/* Disable VC auto-update */
function newstube_vc_disable_update() {
    if (function_exists('vc_license') && function_exists('vc_updater') && ! vc_license()->isActivated()) {

        remove_filter( 'upgrader_pre_download', array( vc_updater(), 'preUpgradeFilter' ), 10);
        remove_filter( 'pre_set_site_transient_update_plugins', array(
            vc_updater()->updateManager(),
            'check_update'
        ) );

    }
}
add_action( 'admin_init', 'newstube_vc_disable_update', 9 );
