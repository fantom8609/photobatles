<?php

class actionPhotobattleDelete extends cmsAction {
	public function run($id=false) {

		
		if(!$id) {cmsCore::error404();}
		if(!cmsUser::isAdmin()) {cmsCore::error404();}

		$battle=$this->model->getBattle($id);
		if(!$battle) {cmsCore::error404();}
    // просим модель удалить битву
		$this->model->deleteBattle('$id');
		//редирект на экшен индекс
		$this->redirectToAction('');
		

		

	}
}
?>