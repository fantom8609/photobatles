<?php

class actionPhotobattleIndex extends cmsAction {
	public function run () {
		$template=cmsTemplate::getInstance();

		//получим количество битв
		$total=$this->model->getBattlesCount();
	  //получим массив битв
		$battles=$this->model->getBattles();
		//подключаем шаблон и передаем ему данные
		$template->render('index',array(
			'battles'=>$battles,
			'total'=>$total));
	}
}


?>