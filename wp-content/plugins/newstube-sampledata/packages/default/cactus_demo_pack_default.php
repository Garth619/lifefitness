<?php

class cactus_demo_pack_default extends cactus_demo_content{

	function __construct($base_uri, $base_dir){
		parent::__construct($base_uri, $base_dir);
		
		$this->name = 'default';
		$this->home_page = 'complex-homepage';
		$this->heading = esc_html__('Main Demo', 'cactus');
	}
	
	public function do_import($step = 0, $index = 0, $option_only = 0){
		$progress = parent::do_import($step, $index, $option_only);
		
		return $progress;
	}
	
	// override
	function do_others($step, $index){
		if($step == 25){
			// done importing posts, now do importing WooCommerce Products
			$data =	$this->base_dir . 'packages/default/data/woocommerce-data.php';
			include $data;
			//echo $index;exit;
			if($index < count($products)){
				$this->import_products($products, $index);
				
				return $index;
			} else {
				return -1;
			}
		}
		
		return -1;
	}
	
	// override
	public function count_other_steps($step){
		if($step == 25){
			$data =	$this->base_dir . 'packages/default/data/woocommerce-data.php';
			include $data;

			return count($products);
		}
		
		return 0;
	}
}
