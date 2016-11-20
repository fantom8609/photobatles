<?php

class actionPhotobattleJoin extends cmsAction {
	public function run($battle_id) {

		if(!$battle_id) {cmsCore::error404();}

		$battle=$this->model->getBattle($id);
    
    //если не вернуло битву из базы или статус не равен набор участников
		if (!$battle || $battle['status'] != photobattle::STATUS_PENDING) { 
			cmsCore::error404();
		}
	
		$errors=false;

			//получаем форму //batle - вторая часть названия файла формы form_batle.php
		$form=$this->getForm('join'); 

		//есть ли в пост запросе поле с названием submit. has возвращает либо true либо false в зависимости от наличия переменной submit в запросе
		$is_submitted = $this->request->has('submit');

		//маассив с данными,полученными из формы(в данном случае это фотграфия)
		//объект $this->request содержит данные введеные пользователем. is_submitted - была ли форма уже отправлена (true,false)
		$photo = $form->parse($this->request, $is_submitted);


		if($is_submitted) {
			$errors=$form->validate($this,$photo);
		
		if(!$errors) {
			//обращаемся для этого к модели. объект model инициализируется автоматически и доступеен в любом экшене и в фронтенде
			$this->model->getPhoto($photo);
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
		$template->render('form_join',array(
			'form' => $form,
			'errors' => $errors,
			'photo' => $photo,
			'battle'=>$battle
			));

	}
}
?>