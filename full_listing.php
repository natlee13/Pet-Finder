<?php 

require_once('includes/header.php');
require_once('includes/view.php');
require_once('includes/listings.php');
require_once('includes/categories.php');

$iListingId = 2;

if(isset($_GET['listingid']) == true){
	$iListingId = $_GET['listingid'];
}

$oListing = new Listing();
$oListing->load($iListingId); 

echo View::renderFullListing($oListing);

require_once('includes/footer.php');

?>
