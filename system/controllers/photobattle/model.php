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
		$battle=$this->getItemById('photobattles',$id);

    //в массиве $battle['photos'] будут находиться только те фотографии,которые отностся к текуще битве(фильтруем)
    //отфильтровываем те строки, которые не относятся к айди,который мы передали для получения битвы
		$this->filterEqual('battle_id',$id);
   //указываем поле и сортируем по убывающей
		$this->orderBy('score', 'desc');
   // объединение айдишников из таблиц users и photobattles_photos(из которой будет происходить запрос)
		$this->join('{users}', 'u', 'u.id = i.user_id');
   // из приджоенной таблицы вытаскиваем поле nickname и в результирующий массив засовываем его как user_nickname
		$this->select('u.nickname', 'user_nickname');

		$battle['photos'] = $this->get('photobattles_photos');

		return $battle;



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

    // вставляем в таблицу те данные которые нам переданы из формы и получаем айди вставленной фоотографии
		$photo_id=$this->insert('photobattles_photos',$photo);
    
    //Фильтр. Поле будет увеличено только у тех строк, у которых айди равно айди нашей битвы.
    $this->filterEqual('id',$photo['battle_id']);

	  //увеличиваем на единицу количество участников
		$this->increment('photobattles','users_count');

		return $photo_id;

	}

//учавствует ли пользователь уже в битве
	public function isUserInBattle($user_id,$battle_id) {
    
    //фильтруем,что айди нашей переменной в запросе должен равняться переданной переменной
    $this->filterEqual('user_id',$user_id);

    $this->filterEqual('battle_id',$battle_id);

		//узнаем количество строк в таблице
		//пиведение к типу булеан
		$result=(bool)$this->getCount('photobattles_photos');

		//запрос,который узнает количество строк не збрасывает фильтры
		//иначе следующий запрос будет выполнен с применением этих же фильтров
		$this->resetFilters();
		return $result;
	}

	public function setBattleStatus($battle_id, $status){
		//$status - новый статус
		return $this->update('photobattles', $battle_id, array(
			'status' => $status
		));
	}
	


}