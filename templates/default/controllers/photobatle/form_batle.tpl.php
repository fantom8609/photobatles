<?php
if($do=='add') {$page_title=LANG_PHOTOBATLE_ADD;}
if($do=='edit') {$page_title=LANG_PHOTOBATLE_EDIT;}
$this->setPageTitle($page_title);
$this->addBreadcrumb(LANG_PHOTOBATLE_CONTROLLER,$this->href_to('')); //ссылка на корнево экшен index
$this->addBreadcrumb($page_title);
?>
<h1><?php echo $page_title;?></h1>