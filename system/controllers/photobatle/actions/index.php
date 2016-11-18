<?php

class actionPhotobatleIndex extends cmsAction {
	public function run () {
		$template=cmsTemplate::getInstance();
		//$template->addOutput('Hello world');
		$battles=array();
		$template->render('index');
	}
}


?>