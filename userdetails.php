<?php 
require_once('includes/header.php');
require_once('includes/user.php');
require_once('includes/view.php');

// if not logged in, redirect to login page
if(isset($_SESSION['userid']) == false){ 
	header('Location:login.php');
}

$iUserId = $_SESSION['userid'];
$oUser = new User();
$oUser->load($iUserId);

echo View::renderUserDetails($oUser);
 
require_once('includes/footer.php');
?>
