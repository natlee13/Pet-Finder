<?php 
ob_start();

// include composer autoload
require 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

require_once('includes/admin_header.php');
require_once('includes/form.php');
require_once('includes/stories.php');

//checking that admin is logged in
if(isset($_SESSION['userid']) == false){ 

	header('Location: login.php');
}

$oUser = new User();
$oUser->load($_SESSION['userid']);
if($oUser->sAdmin == 'no'){

	header('Location:login.php');
}

//getting the relevant story and loading it
$iStoryId = $_GET['storyid'];

$oStory = new Success_Story();
$oStory->load($iStoryId);

//make sticky data
$aStickyData = [];

$aStickyData['title'] = $oStory->sTitle;
$aStickyData['age'] = $oStory->sAge;
$aStickyData['sex'] = $oStory->sSex;
$aStickyData['breed'] = $oStory->sBreed;
$aStickyData['time_missing'] = $oStory->sTimeMissing;
$aStickyData['story'] = $oStory->sStory;

$oForm = new Form();
$oForm->aData = $aStickyData; //put sticky data in form

if(isset($_POST['submit']) == true){
	$oForm->aData = $_POST;
	//errors if the input is left empty
	if($_POST['title'] == ''){
		$oForm->addError('title', 'Please enter title');
	}

	if($_POST['age'] == ''){
		$oForm->addError('age', 'Please enter animal age');
	}

	if($_POST['sex'] == ''){
		$oForm->addError('sex', 'Please enter animal sex');
	}

	if($_POST['breed'] == ''){
		$oForm->addError('breed', 'Please enter breed');
	}

	if($_POST['time_missing'] == ''){
		$oForm->addError('time_missing', 'Please enter time missing');
	}

	if($_POST['story'] == ''){
		$oForm->addError('story', 'Please enter success story');
	}

	if(count($oForm->aErrors) == 0){ //if there are no errors, update with $_POST data

		$oStory->sTitle = $_POST['title'];
		$oStory->sAge = $_POST['age'];
		$oStory->sSex = $_POST['sex'];
		$oStory->sBreed = $_POST['breed'];
		$oStory->sTimeMissing = $_POST['time_missing'];
		$oStory->sStory = $_POST['story'];

		if($_FILES['photo']['error'] == 0){ //adds a new photo if new one is selected otherwise keeps existing photo
			$aFileDetails = $_FILES['photo'];
	        $sNewFileName = time().$aFileDetails['name'];
	        $to = dirname(".").'/assets/images/'.$sNewFileName;
	        move_uploaded_file($aFileDetails['tmp_name'], $to);

	        $manager = new ImageManager();
        	$image = $manager->make('assets/images/'.$sNewFileName)->crop(660, 600)->resize(330, 300);
        	$image->save('assets/images/'.$sNewFileName);

	        $oStory->sPhoto = $sNewFileName;
		}

		$oStory->save();

		header('Location: admin_success_stories.php');
	}
}

//making the form
$oForm->open();
$oForm->makeFileInput('Upload Photo', 'photo');
$oForm->makeTextInput('Title', 'title', '');
$oForm->makeTextInput('Age of Pet', 'age', '');
$oForm->makeTextInput('Sex of Pet', 'sex', '');
$oForm->makeTextInput('Breed', 'breed', '');
$oForm->makeTextInput('Time Missing', 'time_missing', '');
$oForm->makeTextArea('Story', 'story', '' );
$oForm->makeSubmit('Edit', 'submit', 'pure-button-primary');
$oForm->close();

?>

<div class="form-banner">	
	<h1>Update Your Current Listings Here</h1>
	<p>Make your changes in the form below to update your current listings.</p>
</div>

<div class="container">

<?php 
echo $oForm->sHTML; //displaying the form
?>

</div>

<?php 
require_once('includes/footer.php') 
?>