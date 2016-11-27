<?php
$this->setPageTitle($battle['title']);
$this->addBreadcrumb(LANG_PHOTOBATTLE_CONTROLLER,$this->href_to('')); //ссылка на корнево экшен index
$this->addBreadcrumb($battle['title']);





if (cmsUser::isAdmin()) {
	


	if ($battle['status'] == photobattle::STATUS_OPENED){

		$this->addToolButton(array(
			'class' => 'cancel',
			'title' => LANG_PHOTOBATTLE_STOP,
			'href' => $this->href_to('stop', $battle['id'])
			));			
	}

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
<!--выберите фотографию из двух-->
<h3><?php echo LANG_PHOTOBATTLE_SELECT_VS; ?></h3>

<div class="photobattle-versus">

	<?php $ids = array(array_keys($vote_photos), array_reverse(array_keys($vote_photos))); ?>	
	
	<?php foreach ($vote_photos as $id => $photo) { ?>
	
		<div class="photo">
			<div class="user"><a href="<?php echo href_to('users', $photo['user_id']); ?>"><?php echo $photo['user_nickname']; ?></a></div>
			<a href="<?php echo $this->href_to('vote', array_shift($ids)); ?>"><?php echo html_image($photo['image'], 'normal'); ?></a>
			<div class="zoom">
				<a class="ajax-modal" href="<?php echo html_image_src($photo['image'], 'big', true); ?>"><?php echo LANG_PHOTOBATTLE_ZOOM; ?></a>
			</div>
		</div>
	
	<?php } ?>
	
</div>

