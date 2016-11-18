<?php

class actionPhotobattleAdd extends cmsAction {
	public function run() {

		if(!cmsUser::isAdmin()) {cmsCore::error404();}
		$errors=false;
		//маассив с данными,полученными из формы
		$battle=array();
		//получаем форму 
		$form=$this->getForm('battle'); //batle - вторая часть названия файла формы form_batle.php
		$template=cmsTemplate::getInstance();
		//$template->addOutput('Add batll');
		$template->render('form_battle',array(
			'do'=>'add' //поскольку это шаблон будет использоваться в двух экшенах,заведем спец. праметр do  в который будет передано название того экшена из которого он вызван
			'form'=>$form,
			'errors'=>$errors,
			'battle'=>$battle
			));
	}
}
?>