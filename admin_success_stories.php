<?php

require_once('includes/admin_header.php'); 
require_once('includes/view.php'); 
require_once('includes/stories.php');
require_once('includes/story_manager.php');

//checking that a session is under way and user is logged in as admin
if(isset($_SESSION['userid']) == false){ 
	header('Location:login.php');
}

$oUser = new User();
$oUser->load($_SESSION['userid']);
if($oUser->sAdmin == 'no'){

	header('Location:login.php');
}

$aSuccessStories = StoryManager::getSuccessStories();

echo View::renderAdminSuccessStories($aSuccessStories);

require_once('includes/footer.php'); 

?>