<?php

class actionPhotobattleBattle extends cmsAction {
	public function run() {

		$template=cmsTemplate::getInstance();
		$template->render('battle',array(
			'battle' => $battle
			));

	}
}
?>