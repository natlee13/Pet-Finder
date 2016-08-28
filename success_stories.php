<?php

require_once('includes/header.php'); 
require_once('includes/view.php'); 
require_once('includes/stories.php');
require_once('includes/story_manager.php');

$aSuccessStories = StoryManager::getSuccessStories();

echo View::renderSuccessStories($aSuccessStories);

require_once('includes/footer.php'); 

?>
