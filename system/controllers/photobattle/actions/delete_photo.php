<?php

class actionPhotobattleDeletePhoto extends cmsAction {
	
	public function run($photo_id=false) {

		
	  if(!$photo_id) {cmsCore::error404();}
		if(!cmsUser::isAdmin()) {cmsCore::error404();}

		$photo=$this->model->getPhoto($photo_id);

    // просим модель удалить photo
		$this->model->deletePhoto($photo_id);

		//редирект на экшен индекс
		$this->redirectToAction('battle',array($photo['battle_id']));
		

	}
}
?>