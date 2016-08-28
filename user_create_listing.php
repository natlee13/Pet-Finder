<?php
ob_start();

// include composer autoload
require 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

require_once('includes/header.php');
require_once('includes/form.php');
require_once('includes/listings.php');

//checking a session is under way
if(isset($_SESSION['userid']) == false){ 
    //header('Location:login.php');
}

$oForm = new Form();

if(isset($_POST['submit']) == true){ //if the form is submitted

    $oForm->aData = $_POST; //keep any data entered as sticky if an error appears

    //errors that occur if field is empty
    if($_POST['title'] == ''){
        $oForm->addError('title', 'Please enter listing title');
    }

    if($_POST['suburb'] == ''){
        $oForm->addError('suburb', 'Please enter suburb');
    }

    if($_POST['region'] == ''){
        $oForm->addError('region', 'Please enter region');
    }

    if($_POST['date'] == ''){
        $oForm->addError('date', 'Please enter date');
    }

    if($_POST['sex'] == ''){
        $oForm->addError('sex', 'Please enter sex');
    }

    if($_POST['breed'] == ''){
        $oForm->addError('breed', 'Please enter breed');
    }

    if($_POST['contact_name'] == ''){
        $oForm->addError('contact_name', 'Please enter contact name');
    }

    if($_POST['contact_ph'] == ''){
        $oForm->addError('contact_ph', 'Please enter contact phone');
    }

    if($_FILES['photo']['error'] > 0){
        $oForm->addError('photo', 'Please upload a photo');
    }

    if($_POST['description'] == ''){
        $oForm->addError('description', 'Please enter description');
    }

    if(count($oForm->aErrors) == 0){ //if there are no errors, create a new listing with the data entered

        $oListing = new Listing();

        $iUserId = $_SESSION['userid']; //making the $iUserID equal to that of the session

        //uploading photo
        $aFileDetails = $_FILES['photo'];
        $sNewFileName = time().$aFileDetails['name'];
        $to = dirname(".").'/assets/images/'.$sNewFileName;
        move_uploaded_file($aFileDetails['tmp_name'], $to);

        $manager = new ImageManager();
        $image = $manager->make('assets/images/'.$sNewFileName)->resize(550, 360);
        $image->save('assets/images/'.$sNewFileName);

        $oListing->iUserId = $iUserId;
        $oListing->sStatus = $_POST['status'];
        $oListing->iCategoryId = $_POST['category_id'];
        $oListing->sTitle = $_POST['title'];
        $oListing->sPhoto = $sNewFileName;
        $oListing->sSuburb = $_POST['suburb'];
        $oListing->sRegion = $_POST['region'];
        $oListing->sDate = $_POST['date'];
        $oListing->sSex = $_POST['sex'];
        $oListing->sBreed = $_POST['breed'];
        $oListing->sContactName = $_POST['contact_name'];
        $oListing->sContactPh = $_POST['contact_ph'];
        $oListing->sDescription = $_POST['description'];

        $oListing->save();

        header('Location: user_view_listings.php');
    }
}

//making the form
$oForm->open();
$oForm->makeSelectInput('List in:', 'status', ['lost'=>'Lost','found'=>'Found']);
$oForm->makeSelectInput('Species:', 'category_id', CategoryManager::listCategories());
$oForm->makeTextInput('Listing Title:', 'title', 'e.g Help Find Fluffy');
$oForm->makeFileInput('Upload Photo:', 'photo');
$oForm->makeTextInput('Suburb:', 'suburb', 'Suburb lost from/found in');
$oForm->makeTextInput('Region:', 'region', 'Region');
$oForm->makeTextInput('Date:', 'date', 'Date pet lost or found');
$oForm->makeTextInput('Sex:', 'sex', 'e.g Male, neutered');
$oForm->makeTextInput('Breed:', 'breed', 'e.g Labrador');
$oForm->makeTextInput('Contact Person:', 'contact_name', 'Name of person to contact re: listing');
$oForm->makeTextInput('Contact Phone:', 'contact_ph', 'Phone number of contact person');
$oForm->makeTextArea('Description', 'description', 'Add a description include, name if known, colour, age, any distinctive markings, collars or tags, if microchipped, microchip number etc.');
$oForm->makeSubmit('Create', 'submit', ' pure-button-primary');
$oForm->close();

?>

<div class="form-banner">	
	<h1>Create a New Lost or Found Listing</h1>
	<p>Enter information for your listing in the form below</p>
</div>

<div class="container">

<?php 
echo $oForm->sHTML; //displaying the form
?>

</div>

<?php 
require_once('includes/footer.php') 
?>
