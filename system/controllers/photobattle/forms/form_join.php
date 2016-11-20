<?php

class formPhotobattleJoin extends cmsForm {
	
	public function init(){
	
		return array(
		
			array(
				'type' => 'fieldset',
				'childs' => array(
									
					new fieldImage('image', array(
						'title' => LANG_PHOTOBATTLE_JOIN_PHOTO,
						'options' => array(
							'sizes' => array('small', 'normal', 'big')
						),
						'rules' => array(
							array('required')
						)
					)),
 					
				)
				
			)
			
		);		
		
	}	
	
}