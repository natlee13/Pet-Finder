<?php

session_start();
require_once('includes/connection.php');
require_once('includes/listings.php');

if(isset($_SESSION['userid']) == false){ 
    header('Location:login.php');
}

$oUser = new User();
$oUser->load($_SESSION['userid']);

if($oUser->sAdmin == 'no'){
	header('Location:login.php');
}

$oListing = new Listing();

$oListingId = 1;

if(isset($_GET['listingid']) == true){
	$iListingId = $_GET['listingid'];

	$oListing->load($iListingId);
	$oListing->sDeleted = 'no';
	$oListing->save();

	header('Location: admin_homepage.php');
}

?>