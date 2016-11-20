<?php 
class modelPhotobattle extends cmsModel {
	//добавляем битву в таблицу $battle - массив из формы
	public function addBattle($battle) {
		//добавление в таблицу photobattles одной простой строчкой
		//в запросах в модели префикс не используется
		//insert добавляет содержимое массива в таблицу
		//ключи массива - это название полей, а элементы - их содержание
		//insert возвращает айди вставленной записи если в таблице есть поле айди(т.е мы будем возвращать айди новой добавленнойй битвы)
		return $this->insert('photobattles',$battle);
	}
// update метод треебует айди битвы и сами данные
	public function updateBattle($id,$battle) {
		return $this->update('photobattles',$id,$battle);

	}
	public function getBattle($id) {
		//вытаскиваем битву из таблицы photobattles по айди
		return $this->getItemById('photobattles',$id);

	}
	public function deleteBattle($id) {

		//чтобы чистить массив нам нужно зннать путь к папке загрузок. Путь к папке загрузок находится в конфиге.
		//получаем объект класса конфиг
		$config=cmsConfig::getInstance();

		//перед удалением из базы нужно удалить битву на нашеем диске
		//получим битву
		$this->getBattle($id);
		//изображение содержит несколько путей, которые нам нужно удалить, поэтому преобразовываем в массив. small: 000/u1/000/00de61a5.jpg - соответственно ключ и элемент массива. Значение массива как мы видим не содержит корнегого пути.они считается что в папке upload,поэтому нам еще нужно приклеить к ним путь к папке upload,чтобы удалить
		$logos=self::yamlToArray($battle['logo']);
		//если $logos является массивом, то очищаем его
		if(is_array($logos)) {
			//берем каждый путь и приклеиваем к нему путь к папке upload и полученый файл удаяем
			// По идее здесь надо проверять существует ли файл,чтобы его удалять. Но мы вместо проверки поставим @ 
			foreach($logos as $path) {
				@unlink($config->upload_path . $path);
			}
		}//теперь логотипы будут удаляться вместе с битвой
		
		return $this->delete('photobattles',$id);
	}

//вывести список всех битв (возвращает все строки в таблице),т.е массив каждый каждый элемент которого вляется массивом,представляющем одну запись в таблице
	public function getBattles() {
		return $this->get('photobattles');
	}

	//возвращает число строк в таблице
	public function getBattlesCount() {
		return $this->getCount('photobattles');
	}

	public function addPhoto($photo) {

		$photo_id=$this->insert('photobattles_photos',$photo);
	  //увеличиваем а единицу количество участников
		$this->increment('photobattles_photos','count_users');

		return $photo_id;

	}




}