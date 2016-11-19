<?php

class actionPhotobattleAdd extends cmsAction {
	public function run() {
		if(!cmsUser::isAdmin()) {cmsCore::error404();}
		$errors=false;
			//получаем форму //batle - вторая часть названия файла формы form_batle.php
		$form=$this->getForm('battle'); 
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
			//если ошибок нет то мы узнаем айди битвы после того как добавляем ее
			//обращаемся для этого к модели. объект model инициализируется автоматически и доступеен в любом экшене и в фронтенде
			$battle_id=$this->model->addBattle($battle);
			//после того как мы узнали айди битвы,мы может перенаправить пользователя на страницу текущей битвы
			//редирект на /photobattle/просмотр битвы(экшен)/ID
			$this->redirectToAction('battle',array($battle_id));

		}
		if($errors) {
			//error - css класс который будет добавлен к сообщениюоб ошибке
			cmsUser::addSessionMessage(LANG_FORM_ERRORS,'error'); 
		}
	}
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