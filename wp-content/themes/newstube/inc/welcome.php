<?php
/**
 * cactus theme sample theme options file. This file is generated from Export feature in Option Tree.
 *
 * @package cactus
 */

//hook and redirect
function cactus_activation($oldname, $oldtheme=false) {
	//header( 'Location: '.admin_url().'admin.php?page=cactus-welcome');
	wp_redirect(admin_url().'admin.php?page=cactus-welcome');
}
add_action('after_switch_theme', 'cactus_activation', 10 ,  2); 

//welcome menu
add_action('admin_menu', 'cactus_welcome_menu');
function cactus_welcome_menu() {
	add_menu_page(esc_html__('Welcome','cactus'), esc_html__('CactusThemes Welcome','cactus'), 'edit_theme_options', 'cactus-welcome', 'cactus_welcome_function', 'dashicons-megaphone', '2.5');
}

//welcome page
function cactus_welcome_function(){
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/fonts/css/font-awesome.min.css', array(), '4.3.0');
    $tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'welcome';
    ?>
    <div class="wrap">
        <?php
		cactus_welcome_tabs();
		cactus_welcome_tab_content( $tab );
		?>
    </div>
    <?php
}

//tabs
function cactus_welcome_tabs() {
    $current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'welcome';
	$cactus_welcome_tabs = array(
		'welcome' => '<span class="dashicons dashicons-smiley"></span> '.esc_html__('Welcome','cactus'),
		'document' => '<span class="dashicons dashicons-format-aside"></span> '.esc_html__('Document','cactus'),
		'sample' => '<span class="dashicons dashicons-download"></span> '.esc_html__('Sample Data','cactus'),
		'support' => '<span class="dashicons dashicons-businessman"></span> '.esc_html__('Support','cactus'),
	);
	
	echo '<h1></h1>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach ( $cactus_welcome_tabs as $tab_key => $tab_caption ) {
        $active = $current_tab == $tab_key ? 'nav-tab-active' : '';
        echo '<a class="nav-tab ' . $active . '" href="?page=cactus-welcome&tab=' . $tab_key . '">' . $tab_caption . '</a>';
    }
    echo '</h2>';
}
function cactus_welcome_tab_content( $tab ){
	if($tab=='document'){ ?>
    	<p>You could view <a class="button button-primary button-large" href="http://newstube.cactusthemes.com/doc/" target="_blank">Full Document</a> in new window</p>
		<iframe src="http://newstube.cactusthemes.com/doc/" width="100%" height="700" style="background:#fff;"></iframe>
        
    <?php } elseif($tab == 'sample'){ 
				if(!is_plugin_active('newstube-sampledata/newstube-sampledata.php')){
					?>
					<p style="color:#FF0000"> <?php echo esc_html__('Please install NewsTube-SampleData plugin to use this feature','newstube');?> </p>
					<?php
				} else {
					do_action('newstube_import_data_tab'); 
				}
		  } elseif($tab == 'support'){ ?> 
    	<p>You could open <a class="button button-primary button-large" href="http://ticket.cactusthemes.com/" target="_blank">Support Ticket</a> in new window</p>
    	<iframe src="http://ticket.cactusthemes.com/" width="100%" height="700" style="background:#fff;"></iframe>
        
	<?php }else{ ?>
		<div class="cactus-welcome-message">
			<h2 class="cactus-welcome-title"><?php esc_html_e('Welcome to NewsTube','cactus');?></h2>
            <div class="cactus-welcome-inner">
            	<a class="cactus-welcome-item" href="http://newstube.cactusthemes/document/quickstart.html" target="_blank">
                	<i class="fa fa-file-text"></i>
                    <h3><?php echo esc_html('Quick Start Guide','cactus'); ?></h3>
                    <p><?php echo esc_html('Save your time with NewsTube quick start document','cactus'); ?></p>
                </a>
                <a class="cactus-welcome-item" href="?page=cactus-welcome&tab=document">
                	<i class="fa fa-book"></i>
                    <h3><?php echo esc_html('Full Document','cactus'); ?></h3>
                    <p><?php echo esc_html('See the full user guide for all NewsTube functions','cactus'); ?></p>
                </a>
                <br />
                <a class="cactus-welcome-item" href="?page=cactus-welcome&tab=sample">
                	<i class="fa fa-download"></i>
                    <h3><?php echo esc_html('Sample Data','cactus'); ?></h3>
                    <p><?php echo esc_html('Import sample data to have homepage like our live DEMO','cactus'); ?></p>
                </a>
                <a class="cactus-welcome-item" href="?page=cactus-welcome&tab=support">
                	<i class="fa fa-user"></i>
                    <h3><?php echo esc_html('Support','cactus'); ?></h3>
                    <p><?php echo esc_html('Need support using the theme? We are here for you.','cactus'); ?></p>
                </a>
                <div class="cactus-welcome-item cactus-welcome-item-wide cactus-welcome-changelog">
                	<iframe src="http://newstube.cactusthemes.com/release_log.html" width="780px" height="500px"></iframe>
                </div>
            </div>
		</div>
	<?php }
}


//old import sample data
add_action( 'admin_notices', 'print_current_version_msg' );
function print_current_version_msg()
{
	$current_theme = wp_get_theme();
	$current_version =  $current_theme->get('Version');
	echo '<div style="display:none" id="current_version">' . $current_version . '</div>';
}

add_action( 'admin_footer', 'import_sample_data_comfirm' );
function import_sample_data_comfirm()
{
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#ct_support_forum').parent().attr('target','_blank');
        $('#ct_documentaion').parent().attr('target','_blank');
        $('#option-tree-sub-header').append('<span class="option-tree-ui-button left image"></span><span class="option-tree-ui-button left vesion ">ver. ' + $('#current_version').text() + '</span>');
    });
    </script>
    <?php
}

/*
 * build radio image select
 */
function cactus_welcome_image_radio($option,$array){
?>

<?php
}
