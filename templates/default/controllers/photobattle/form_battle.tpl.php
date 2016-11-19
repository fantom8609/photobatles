<?php
if($do=='add') {$page_title=LANG_PHOTOBATTLE_ADD;}
if($do=='edit') {$page_title=LANG_PHOTOBATTLE_EDIT;}
$this->setPageTitle($page_title);
$this->addBreadcrumb(LANG_PHOTOBATTLE_CONTROLLER,$this->href_to('')); //ссылка на корнево экшен index
$this->addBreadcrumb($page_title);
?>
<h1><?php echo $page_title;?></h1>

<?php
//вывод формы: form- обьект формы(сама форма),batle - массив с данныи которые ранее были введены в форму. Он нужен на случай если форма выыводится повторно. Например если заполнены не все поля мы выводим повторно форму с уже заполненными ранее полями array - массив настроек. Последний массив это сообщения об ошибках
 $this->renderForm($form,$battle,array(
 	//ссылка на страницу отправки формы
	'action'=>'',
	'method'=>'post',
	//нужно ли показывать кнопки сохранить и отменить
	'toolbar'=>false),
 $errors)
?>