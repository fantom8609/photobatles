<?php

class actionPhotobattleJoin extends cmsAction {
	public function run($battle_id) {

		if(!$battle_id) {cmsCore::error404();}

		$battle=$this->model->getBattle($battle_id);

		//инициализируем объект пользователя дл получения его айди при добавлении им фотографии
		$user=cmsUser::getInstance();
    
    //если не вернуло битву из базы или статус не равен набор участников
		if (!$battle || $battle['status'] != photobattle::STATUS_PENDING) { 
			cmsCore::error404();
		}

		$is_user_in_battle=$this->model->isUserInBattle($user->id,$id);

		if ($is_user_in_battle || !cmsUser::isAdmin()) {
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
			//из формы передается только изображение. Добавим также айди битвы и айди юзера
			//теперь в массиве photo будут содержатьс все 3 необходимых поля
			$photo['battle_id']=$battle_id;
			$photo['user_id']=$user->id;

			//обращаемся для этого к модели. объект model инициализируется автоматически и доступеен в любом экшене и в фронтенде
			$this->model->addPhoto($photo);

			$battle = $this->model->getBattle($battle_id);
				
			if ($battle['users_count'] >= $battle['min_users']){
					//устанавливаем другой статус (модерация)
				$this->model->setBattleStatus($battle_id, photobattle::STATUS_MODERATION);
			}
     //получаем объект компонента messages
			$messenger = cmsCore::getController('messages');
			
			//добавляем получателя сообщения,предавая айди получателя 
			$messenger->addRecipient(1);

			//создаем само уведомление
				$notice = array(
					//текст уведомления. %s в константе заменяется с помощью функции sprintf на название битвы
						'content' => sprintf(LANG_PHOTOBATTLE_MODERATION_NOTICE, $battle['title']), 
					//массив с кнопками
						'actions' => array(
							'view' => array(
								'title' => LANG_SHOW,
								//$this->name это название текущего компонента battle- экшен, $battle_id - параметр для экшена
								'href' => href_to($this->name, 'battle', $battle_id)
							)
						)
					);

				//отправить уведомление,описанное в массиве
				$messenger->sendNoticePM($notice);
					
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