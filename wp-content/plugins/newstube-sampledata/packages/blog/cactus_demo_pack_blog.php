<?php

class cactus_demo_pack_blog extends cactus_demo_content{
	function __construct($base_uri, $base_dir){
		parent::__construct($base_uri, $base_dir);
		
		$this->name = 'blog';
		$this->home_page = 'demo-blog-style-1';
		$this->heading = esc_html__('Blog', 'cactus');
	}
	
	public function do_import($step = 0, $index = 0, $option_only = 0){
		$progress = parent::do_import($step, $index, $option_only);
		
		return $progress;
	}
	
	function do_others($step, $index){
		// additional configuration
		if($step == 90){
			update_option('show_on_front', 'posts');
			return -1;
		}
		
		return $index;
	}
}
