<?php

require_once('includes/connection.php');
require_once('includes/listings.php');

$oListing = new Listing();

$iListingId = 1;

if(isset($_GET['listingid']) == true){
	$iListingId = $_GET['listingid']; //getting the listing id of the listing to delete

	$oListing->load($iListingId); 
	$oListing->sDeleted = 'yes'; 
	$oListing->save();

	header('Location: user_view_listings.php');
}

?>