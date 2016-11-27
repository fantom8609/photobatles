<?php

class actionPhotobattleBattle extends cmsAction {
	public function run($id = false) {
		if(!$id) {cmsCore::error404();}

		$battle=$this->model->getBattle($id);

    if(!$battle) {cmsCore::error404();}

		$template=cmsTemplate::getInstance();

		$user=cmsUser::getInstance();

		$template_file='battle';
    
    //переменная для хранения двух фотографий 
		$vote_photos=false;

   //если битва запущена,то попросим модель вернуть нам фотографии для голосования
		if ($battle['status'] == photobattle::STATUS_OPENED){
			
			$vote_photos = $this->model->getPhotosForVoting($id, $user->id);
		// если действительно нашлись такие фотографии и их количество равно 2
			if ($vote_photos && count($vote_photos)==2){
		//то мы используем шаблон  versus
				$template_file = 'versus';
			}
		}

		$template->render($template_file,array(
			
			'battle' => $battle,
			'is_user_in_battle'=>$this->model->isUserInBattle($user->id,$id),
			'vote_photos'=>$vote_photos
			));

	}
}
?>