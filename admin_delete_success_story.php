<?php

session_start();
require_once('includes/connection.php');
require_once('includes/stories.php');
require_once('includes/user.php');

if(isset($_SESSION['userid']) == false){ 
    header('Location:login.php');
}

$oUser = new User();
$oUser->load($_SESSION['userid']);
if($oUser->sAdmin == 'no'){

	header('Location:login.php');
}

// print_r($_SESSION);
$oStory = new Success_Story();

$iStoryId = 1;

if(isset($_GET['storyid']) == true){
	$iStoryId = $_GET['storyid']; //gets the relevant storyid

	$oStory->load($iStoryId); //loads the story
	$oStory->sDeleted = 'yes'; //changes sDeleted to yes (from default no)
	$oStory->save();

	header('Location: admin_success_stories.php');

}

?>