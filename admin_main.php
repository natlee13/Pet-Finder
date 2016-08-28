<?php 
require_once('includes/admin_header.php');
require_once('includes/categories.php');
require_once('includes/listings.php');
require_once('includes/view.php'); 

if(isset($_SESSION['userid']) == false){ 
	header('Location:login.php');
}

$oUser = new User();
$oUser->load($_SESSION['userid']);

if($oUser->sAdmin == 'no'){
	header('Location:login.php');
}

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

echo View::renderAdminListings($oCategory,$sStatus);

?>

</div>
 
<?php
require_once('includes/footer.php');
?>

