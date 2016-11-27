<?php
$this->setPageTitle($battle['title']);
$this->addBreadcrumb(LANG_PHOTOBATTLE_CONTROLLER,$this->href_to('')); //ссылка на корнево экшен index
$this->addBreadcrumb($battle['title']);

//если битва не запущена
if($battle['status']==photobattle::STATUS_PENDING) {

	if (!$is_user_in_battle || cmsUser::isAdmin()) {

	$this->addToolButton(array(
		'class'=>'user_add',
		'title'=>LANG_PHOTOBATTLE_JOIN,
		//ссылка на экшен edit, которому будет передаваться айди битвы
		'href'=>$this->href_to('join',$battle['id'])
		));
  }
}



if (cmsUser::isAdmin()) {
	
	if ($battle['status'] != photobattle::STATUS_OPENED){

		$this->addToolButton(array(
			'class' => 'accept',
			'title' => LANG_PHOTOBATTLE_START,
			'href' => $this->href_to('start', $battle['id'])
			));			
	}

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

$statuses_text = array(
		0 => LANG_PHOTOBATTLE_STATUS_PENDING,
		1 => LANG_PHOTOBATTLE_STATUS_MODERATION,
		2 => LANG_PHOTOBATTLE_STATUS_OPENED,
		3 => LANG_PHOTOBATTLE_STATUS_CLOSED,		
	);	

?>



<h1> <?php html($battle['title']);?> </h1> 

<div class="photobattle-status">
	<strong><?php echo LANG_PHOTOBATTLE_STATUS; ?>:</strong>
	<?php echo $statuses_text[ $battle['status'] ]; ?> 

</div>


<?php if ($battle['photos']) { ?>

	<div class="photobattle-images">
		<ul>
			<?php foreach($battle['photos'] as $photo) { ?>
				<li>
					<a class="image" href="<?php echo html_image_src($photo['image'], 'big', true); ?>" title="<?php echo $photo['user_nickname'];  ?>">
						<?php echo html_image($photo['image'], 'small'); ?>
					</a>
					<div class="details">
						
							<a class="user" href="<?php echo href_to('users', $photo['user_id']); ?>"><?php echo $photo['user_nickname']; ?></a> 
							<!-- мы можем удалить фотографию,зная ее айди-->
							<a class="delete" title="<?php echo LANG_PHOTOBATTLE_PHOTO_DELETE;?>"
							href="<?php echo $this->href_to('delete_photo', $photo['id']); ?>">X</a> 

					</div>
				</li>
			<?php } ?>
		</ul>
		<script>
			$(document).ready(function(){
				icms.modal.bindGallery('.photobattle-images .image');
			})
		</script>
	</div>
<?php } ?>

