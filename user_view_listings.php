<?php 
require_once('includes/header.php');
require_once('includes/user.php');
require_once('includes/view.php');

//check that user is logged in
if(isset($_SESSION['userid']) == false){ 
	header('Location:login.php');
}

$iUserId = $_SESSION['userid'];
$oUser = new User();
$oUser->load($iUserId);

?>

<div class="banner">	
	<h1>Your Current Listings</h1>
	<a class="listing-button" href="user_create_listing.php">Create Listing</a>
</div>

<?php  

echo View::renderUserListings($oUser->aUserListings);
 
require_once('includes/footer.php'); 
?>
