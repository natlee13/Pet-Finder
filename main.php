<?php 
require_once('includes/header.php');
require_once('includes/categories.php');
require_once('includes/listings.php');
require_once('includes/view.php'); 

$iCategoryId = 1;
$sStatus = 'found';

//get catid and status
if(isset( $_GET['categoryid'])==true){
	$iCategoryId = $_GET['categoryid'];
}

if(isset( $_GET['status'])==true){
	$sStatus = $_GET['status'];
}

//load category

$oCategory = new Category();
$oCategory->load($iCategoryId);

echo View::renderListings($oCategory,$sStatus);

require_once('includes/footer.php');
?>