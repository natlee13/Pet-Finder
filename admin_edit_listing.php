<?php 
ob_start();

// include composer autoload
require 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

require_once('includes/admin_header.php');
require_once('includes/form.php');
require_once('includes/listings.php');

//checks if user logged in is admin, if not goes to login page

if(isset($_SESSION['userid']) == true){ //if user is logged in, the current user id equals the user id from the session
	$iCurrentUserId = $_SESSION['userid']; 

	$oUser = new User();
	$oUser->load($_SESSION['userid']);
	if($oUser->sAdmin == 'no'){

		header('Location:login.php');
	}
}

else{ //if user not logged in redirect to log in page
	header('Location: login.php');
}

$iListingId = 2;

if(isset($_GET['listingid'])==true){ //if there is a listingid
	$iListingId = $_GET['listingid'];//get the relevant listingid
}

$oListing = new Listing();
$oListing->load($iListingId); //load the relvant listing

//create sticky data
$aStickyData = [];

$aStickyData['user_id'] = $oListing->iUserId;
$aStickyData['status'] = $oListing->sStatus; 
$aStickyData['category_id'] = $oListing->iCategoryId;
$aStickyData['title'] = $oListing->sTitle;
$aStickyData['suburb'] = $oListing->sSuburb;
$aStickyData['region'] = $oListing->sRegion;
$aStickyData['date'] = $oListing->sDate;
$aStickyData['sex'] = $oListing->sSex;
$aStickyData['breed'] = $oListing->sBreed;
$aStickyData['contact_name'] = $oListing->sContactName;
$aStickyData['contact_ph'] = $oListing->sContactPh;
$aStickyData['description'] = $oListing->sDescription;


$oForm = new Form(); //new Form
$oForm->aData = $aStickyData; //include sticky data

// echo '<pre>';
// print_r($_FILES);
// echo '</pre>';

if(isset($_POST['submit']) == true){
	$oForm->aData = $_POST;

	//errors if input fields are left empty
	if($_POST['title'] == ''){
		$oForm->addError('title', 'Please fill in title');
	}

	if($_POST['suburb'] == ''){
		$oForm->addError('suburb', 'Please fill in suburb');
	}

	if($_POST['region'] == ''){
		$oForm->addError('region', 'Please fill in region');
	}

	if($_POST['date'] == ''){
		$oForm->addError('date', 'Please fill in date');
	}

	if($_POST['sex'] == ''){
		$oForm->addError('sex', 'Please fill in sex');
	}

	if($_POST['breed'] == ''){
		$oForm->addError('breed', 'Please fill in breed');
	}

	if($_POST['contact_name'] == ''){
		$oForm->addError('contact_name', 'Please fill in contact name');
	}

	if($_POST['contact_ph'] == ''){
		$oForm->addError('contact_ph', 'Please fill in contact phone');
	}

	if($_POST['description'] == ''){
		$oForm->addError('description', 'Please fill in description');
	}

	if(count($oForm->aErrors) == 0){ //if there are no errors create new listing based on $_POST input

		$iUserId = $_SESSION['userid'];
		$oListing->iUserId = $iUserId;
		$oListing->sStatus = $_POST['status'];
		$oListing->iCategoryId = $_POST['category_id'];
		$oListing->sTitle = $_POST['title'];
		$oListing->sSuburb = $_POST['suburb'];
		$oListing->sRegion = $_POST['region'];
		$oListing->sDate = $_POST['date'];
		$oListing->sSex = $_POST['sex'];
		$oListing->sBreed = $_POST['breed'];
		$oListing->sContactName = $_POST['contact_name'];
		$oListing->sContactPh = $_POST['contact_ph'];
		$oListing->sDescription = $_POST['description'];


		if($_FILES['photo']['error'] == 0){ //adds a new photo if chosen, or keeps current photo if new one not chosen.
			$aFileDetails = $_FILES['photo'];
	        $sNewFileName = time().$aFileDetails['name'];
	        $to = dirname(".").'/assets/images/'.$sNewFileName;
	        move_uploaded_file($aFileDetails['tmp_name'], $to);

	        $manager = new ImageManager();
        	$image = $manager->make('assets/images/'.$sNewFileName)->resize(550, 360);
        	$image->save('assets/images/'.$sNewFileName);

	        $oListing->sPhoto = $sNewFileName;
		}

		$oListing->save();

		header('Location:admin_homepage.php'); //redirects back to admin homepage
	}
}

//creating the form
$oForm->open();
$oForm->makeSelectInput('List in:', 'status', ['lost'=>'Lost','found'=>'Found']);
$oForm->makeSelectInput('Species:', 'category_id', CategoryManager::listCategories());
$oForm->makeTextInput('Listing Title:', 'title', '');
$oForm->makeFileInput('Upload New Photo:', 'photo');
$oForm->makeTextInput('Suburb:', 'suburb', '');
$oForm->makeTextInput('Region:', 'region', '');
$oForm->makeTextInput('Date:', 'date', '');
$oForm->makeTextInput('Sex:', 'sex', '');
$oForm->makeTextInput('Breed:', 'breed', '');
$oForm->makeTextInput('Contact Person:', 'contact_name', '');
$oForm->makeTextInput('Contact Phone:', 'contact_ph', '');
$oForm->makeTextArea('Description', 'description', '');
$oForm->makeSubmit('Submit', 'submit', ' pure-button-primary');
$oForm->close();
?>

<div class="form-banner">	
	<h1>Update Listings Here</h1>
	<p>Make your changes in the form below to update your current listings.</p>
</div>

<div class="container">

<?php 
echo $oForm->sHTML;// displaying the form
?>

</div>

<?php 
require_once('includes/footer.php');
?>