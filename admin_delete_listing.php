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

$iListingId = 1;

if(isset($_GET['listingid']) == true){
	$iListingId = $_GET['listingid'];

	$oListing->load($iListingId); //loads the appropriate listing
	$oListing->sDeleted = 'yes'; //changes sDeleted to yes (from default no)
	$oListing->save(); 

	header('Location: admin_homepage.php');
}

?>