<?php 

require_once('includes/admin_header.php'); 
require_once('includes/searchManager.php'); 

//test 1 - checking a session is underway
if(isset($_SESSION['userid']) == false){ 
	header('Location:login.php');
}

//test 2 - checking user logged in is admin
$oUser = new User();
$oUser->load($_SESSION['userid']);
if($oUser->sAdmin == 'no'){//if user is not admin, redirects to login

	header('Location:login.php');
}

$sKeyword = 'red';

if(isset($_POST['keyword'])){
	$sKeyword = $_POST['keyword'];
}

$aListings = SearchManager::searchListings($sKeyword );
echo View::renderSearchResults($aListings);  

?>