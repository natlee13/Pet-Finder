<?php 

require_once('includes/admin_header.php');
require_once('includes/categories.php');
require_once('includes/listings.php');

//checks x2, a session is underway and admin is logged in
if(isset($_SESSION['userid']) == false){ 
	header('Location:login.php');
}

$oUser = new User();
$oUser->load($_SESSION['userid']);
if($oUser->sAdmin == 'no'){

	header('Location:login.php');
}

$oCategory = new Category();
$oCategory->loadByDeleted();

echo View::renderDeletedListings($oCategory);

require_once('includes/footer.php');
?>