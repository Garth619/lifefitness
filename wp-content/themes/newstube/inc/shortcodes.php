<?php
if(!shortcode_exists('c_cats')){
	add_shortcode('c_cats','newstube_cats_listing_shortcode');
	function newstube_cats_listing_shortcode($atts, $content){
		$term = isset($atts['tax']) ? $atts['tax'] : 'category';
		
		$alphas = array_merge(array('0-9'), range('A', 'Z'));
		$alphas = apply_filters('newstube_c_cats_characters', $alphas);
		
		$html = '';
		foreach($alphas as $alpha){
			$cats = newstube_get_terms_by_first_letter($alpha, $term);
			
			if(count($cats) > 0){
				/**
				 * filter heading of listing
				 */
				$html .= apply_filters('newstube_c_cats_heading', '<h3>' . $alpha . '</h3>', $alpha);

				/**
				 * filter before listing
				 */
				$html .= apply_filters('newstube_c_cats_before_listing', '<ul class="cat-listing ' . $term . '-listing">', $term);
				foreach($cats as $cat){
					$item = '<li><a href="' . get_term_link($cat) . '" title="' . $cat->name  . '">' . $cat->name . ' (' . $cat->count . ')</a></li>';
					
					/**
					 * filter heading of listing item
					 */
					$html .= apply_filters('newstube_c_cats_item',$item, $term, $cat);
				}
				
				/**
				 * filter after listing
				 */
				$html .= apply_filters('newstube_c_cats_after_listing', '</ul>', $term);
			}
		}
		
		return $html;
	}
}
