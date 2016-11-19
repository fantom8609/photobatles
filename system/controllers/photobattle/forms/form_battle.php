<?php

class formPhotobattleBattle extends cmsForm {
	
	public function init(){
	
		return array(
		
			array(
				'type' => 'fieldset',
				'childs' => array(
					
					new fieldString('title', array(
						'title' => LANG_PHOTOBATTLE_TITLE,
						'rules' => array(
							array('required'),
							array('max_length', 100),
							array('min_length', 10)
						)
					)),
					
					new fieldImage('logo', array(
						'title' => LANG_PHOTOBATTLE_LOGO,
						'options' => array(
							'sizes' => array('small')
						)
					)),
					
					new fieldNumber('min_users', array(
						'title' => LANG_PHOTOBATTLE_MIN_USERS,
						'default' => 10
					)),
					
					new fieldList('status', array(
						'title' => LANG_PHOTOBATTLE_STATUS,
						'items' => array(
							0 => LANG_PHOTOBATTLE_STATUS_PENDING,
							1 => LANG_PHOTOBATTLE_STATUS_MODERATION,
							2 => LANG_PHOTOBATTLE_STATUS_OPENED,
							3 => LANG_PHOTOBATTLE_STATUS_CLOSED,
						)
					)),
					
					new fieldDate('date_end', array(
						'title' => LANG_PHOTOBATTLE_DATE_END,
						'rules' => array(
							array('required')
						)
					))
 					
				)
				
			)
			
		);		
		
	}	
	
}
?>