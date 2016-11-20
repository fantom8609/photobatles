<?php

class actionPhotobattleEdit extends cmsAction {
	public function run($id=false) {

		if(!$id) {cmsCore::error404();}
		if(!cmsUser::isAdmin()) {cmsCore::error404();}
		//получаем битву из базы (в этом методе )
		$battle=$this->model->getBattle($id);

		if(!$battle) {cmsCore::error404();}
		
		$errors=false;
			//получаем форму //batle - вторая часть названия файла формы form_batle.php
		$form=$this->getForm('battle'); 
		//есть ли в пост запросе поле с названием submit. has возвращает либо true либо false в зависимости от наличия переменной submit в запросе
		$is_submitted = $this->request->has('submit');
		//маассив с данными,полученными из формы
		//объект $this->request содержит данные введеные пользователем. is_submitted - была ли форма уже отправлена (true,false)
   
		$battle = $form->parse($this->request, $is_submitted);

		if($is_submitted) {
	  // в этом методе данные из формы получаем только если форма отправлена. Если она еще не была отправлена,то мы используем те данные которые у нас в базе  $battle=$this->model->getBattle($id);-- этой строчкой,которая выше
		//маассив с данными,полученными из формы
		//объект $this->request содержит данные введеные пользователем. is_submitted - была ли форма уже отправлена (true,false)
		  $battle = $form->parse($this->request, $is_submitted);
			$errors=$form->validate($this,$battle);
		
		if(!$errors) {
	
			$this->model->updateBattle($id,$battle);
			//после того как мы узнали айди битвы,мы может перенаправить пользователя на страницу текущей битвы
			//редирект на /photobattle/просмотр битвы(экшен)/ID
			$this->redirectToAction('battle',array($id));

		}
		if($errors) {
			//error - css класс который будет добавлен к сообщениюоб ошибке
			cmsUser::addSessionMessage(LANG_FORM_ERRORS,'error'); 
		}
	}
		$template=cmsTemplate::getInstance();
	
		$template->render('form_battle',array(
			'do'=>'edit', //поскольку это шаблон будет использоваться в двух экшенах,заведем спец. праметр do  в который будет передано название того экшена из которого он вызван
			'form' => $form,
			'errors' => $errors,
			'battle' => $battle
			));

	}
}
?>