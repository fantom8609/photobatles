<?php

class actionPhotobatleAdd extends cmsAction {
	public function run() {
		
		$template=cmsTemplate::getInstance();
		//$template->addOutput('Add batll');
		$template->render('form_batle',array(
			'do'=>'add' //поскольку это шаблон будет использоваться в двух экшенах,заведем спец. праметр do  в который будет передано название того экшена из которого он вызван
			));
	}
}
?>