<?php

class cactus_demo_pack_fashion extends cactus_demo_content{
	function __construct($base_uri, $base_dir){
		parent::__construct($base_uri, $base_dir);
		
		$this->name = 'fashion';
		$this->home_page = 'v4-fashion';
		$this->heading = esc_html__('Fashion', 'cactus');
	}
	
	public function do_import($step = 0, $index = 0, $option_only = 0){
		$progress = parent::do_import($step, $index, $option_only);
		
		return $progress;
	}
}
