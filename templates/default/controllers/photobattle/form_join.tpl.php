<?php

	$this->addBreadcrumb(LANG_PHOTOBATTLE_CONTROLLER, $this->href_to(''));
	$this->addBreadcrumb($battle['title'], $this->href_to('battle', $battle['id']));
	$this->addBreadcrumb(LANG_PHOTOBATTLE_JOIN);
	
	$this->setPageTitle(LANG_PHOTOBATTLE_JOIN);

?>

<h1><?php echo LANG_PHOTOBATTLE_JOIN; ?></h1> 

<?php
	$this->renderForm($form, $photo, array(
		'action' => '',
		'method' => 'post',
		'toolbar' => false
	), $errors); 