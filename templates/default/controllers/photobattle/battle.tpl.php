<?php
$this->setPageTitle($battle['title']);
$this->addBreadcrumb(LANG_PHOTOBATTLE_CONTROLLER,$this->href_to('')); //ссылка на корнево экшен index
$this->addBreadcrumb($battle['title']);

if (cmsUser::isAdmin()) {
	$this->addToolButton(array(
		'class'=>'edit',
		'title'=>LANG_PHOTOBATTLE_EDIT,
		//ссылка на экшен edit, которому будет передаваться айди битвы
		'href'=>$this->href_to('edit',$battle['id'])
		));

	$this->addToolButton(array(
		'class'=>'delete',
		'title'=>LANG_PHOTOBATTLE_DELETE,
		//ссылка на экшен delete, которому будет передаваться айди битвы
		'href'=>$this->href_to('delete',$battle['id'])
		));
}

?>



<h1> <?php html($battle['title']);?> </h1> 