<?php

class actionPhotobattleBattle extends cmsAction {
	public function run($id = false) {
		if(!$id) {cmsCore::error404();}

		$battle=$this->model->getBattle($id);

    if(!$battle) {cmsCore::error404();}

		$template=cmsTemplate::getInstance();

		$user=cmsUser::getInstance();

		$template->render('battle',array(
			
			'battle' => $battle,
			'is_user_in_battle'=>$this->model->isUserInBattle($user->id,$id)
			));

	}
}
?>