<?php 

require_once('connection.php');
require_once('stories.php');

class StoryManager{

	static public function getSuccessStories(){

		$aSuccessStories = [];

		$oConnection = new Connection();

		$sSQL = 'SELECT id FROM success_stories';

		$oResultSet = $oConnection->query($sSQL);

		while($aRow = $oConnection->fetch($oResultSet)){

			$iSuccessStoryId = $aRow['id'];

			$oSuccessStory = new Success_Story();
			$oSuccessStory->load($iSuccessStoryId);

			$aSuccessStories[] = $oSuccessStory;
		}

		return $aSuccessStories;
	}
}
//testing

// echo '<pre>';
// print_r(StoryManager::getSuccessStories());
// echo '</pre>';
?>