<?php

class actionPhotobattleIndex extends cmsAction {
	public function run () {

		$page = $this->request->get('page', 1);		
		$perpage = 2;

		$template=cmsTemplate::getInstance();

		//получим количество битв
		$total=$this->model->getBattlesCount();

		$this->model->limitPage($page, $perpage);

	  //получим массив битв
		$battles=$this->model->getBattles();
		//подключаем шаблон и передаем ему данные
		$template->render('index',array(
			'battles'=>$battles,
			'total'=>$total,
			'page'=>$page,
			'perpage'=>$perpage
			));
	}
}


?>