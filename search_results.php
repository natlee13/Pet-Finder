<?php 

require_once('includes/header.php'); 
require_once('includes/searchManager.php'); 

$sKeyword = 'red';

if(isset($_POST['keyword'])){
	$sKeyword = $_POST['keyword'];
}

$aListings = SearchManager::searchListings($sKeyword );
echo View::renderSearchResults($aListings);  

?>