<?php

class actionPhotobattleAdd extends cmsAction {
	public function run() {
		if(!cmsUser::isAdmin()) {cmsCore::error404();}
		$errors=false;
		//есть ли в пост запросе поле с названием submit. has возвращает либо true либо false в зависимости от наличия переменной submit в запросе
		$is_submitted = $this->request->has('submit');
		//маассив с данными,полученными из формы
		//объект $this->request содержит данные введеные пользователем. is_submitted - была ли форма уже отправлена (true,false)
   
		$battle = $form->parse($this->request, $is_submitted);
		/*//маассив с данными,полученными из формы
		//$battle=array();*/

		if($is_submitted) {
			$errors=$form->validate($this,$battle);
		
		if(!$errors) {

		}
		if($errors) {
			//error - css класс который будет добавлен к сообщениюоб ошибке
			cmsUser::addSessionMessage(LANG_FORM_ERRORS,'error'); 
		}
	}

		//получаем форму 
		$form=$this->getForm('battle'); //batle - вторая часть названия файла формы form_batle.php
		
		$template=cmsTemplate::getInstance();
		//$template->addOutput('Add batll');
		$template->render('form_battle',array(
			'do'=>'add', //поскольку это шаблон будет использоваться в двух экшенах,заведем спец. праметр do  в который будет передано название того экшена из которого он вызван
			'form' => $form,
			'errors' => $errors,
			'battle' => $battle
			));

	}
}
?>