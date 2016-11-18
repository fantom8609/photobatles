<?php 
$this->setPageTitle(LANG_PHOTOBATTLE_CONTROLLER);
$this->addBreadcrumb(LANG_PHOTOBATTLE_CONTROLLER);
if(cmsUser::isAdmin()) { //если текущий пользователь администратор
	$this->addToolButton(array(
		'class'=>'add',
		'title'=> LANG_PHOTOBATTLE_ADD,
    'href'=> $this->href_to('add')//возвращает ссылку на экшн текущего компонента
//'/photobatle/add' можно и так написать,но могут быть динные вложения
//href_to('catalog','add') если мы хотим сделать ссылку на экшн другого контроллера
));
}
?>

<h1> <?php echo LANG_PHOTOBATTLE_CONTROLLER; ?> </h1>



<?php if (!$battles) { ?>
<p> <?php echo LANG_PHOTOBATTLE_NONE ?> </p>
<?php return; ?>
<?php } ?>