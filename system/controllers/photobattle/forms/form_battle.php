<?php

class formPhotobattleBattle extends cmsForm {
	public function init() {
		return array(
			array(
				'type'=>'fieldset',
				'childs'=>array(
					//создаем текстовое поле. title как в базе
					new fieldString('title',array( 
						'title'=>LANG_PHOTOBATTLE_TITLE,
					//правила заполнения полей
						'rules'=>array( 
					//обязательо для заполнения
							array('required'),
					//максимальная длина 100 символов как в базе
							array('max_length',100),
							array('min_length',10)
						)
					)),
					new fieldImage ('logo',array(
						'title'=>LANG_PHOTOBATTLE_LOGO,
						//загружаемая фотография сжимается до размера-пресета small
						'options'=>array(
							'sizes'=>array('small')
						)
					)),
				//содержит минимальное количество участников для битвы
				new fieldNumber('min_users',array(
					'title'=>LANG_PHOTOBATTLE_MIN_USERS,
					'default'=>10
					)),
				//выпадающий список выбора статуса битвы из 4 дотупных для админа
				new fieldList('status',array(
					'title'=>LANG_PHOTOBATTLE_STATUS,
					'items'=>array(
						0=>LANG_PHOTOBATTLE_STATUS_PENDING,
						1=>LANG_PHOTOBATTLE_STATUS_MODERATION,
						2=>LANG_PHOTOBATTLE_STATUS_OPEN,
						3=>LANG_PHOTOBATTLE_STATUS_CLOSED
						)
					)),
				new fieldDate ('date_end',array(
					'title'=>LANG_PHOTOBATTLE_DATE_END,
					'rules'=>array(
						array('required')
						)
					))
			)
		);
	}
}
