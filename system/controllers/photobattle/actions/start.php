<?php

class actionPhotobattleStart extends cmsAction {
	public function run($id=false) {

		
		if(!$id) {cmsCore::error404();}
		if(!cmsUser::isAdmin()) {cmsCore::error404();}

		$battle=$this->model->getBattle($id);
		if(!$battle) {cmsCore::error404();}
    
    //меняем статус битвы на photobattle::STATUS_OPENED
    $this->model->setBattleStatus($id,photobattle::STATUS_OPENED);
		//редирект на экшен индекс
		$this->redirectToAction('battle',array($id));


		
		
	}
}
?>