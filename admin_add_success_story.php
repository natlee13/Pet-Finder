<?php 
ob_start();

// include composer autoload
require 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

require_once('includes/admin_header.php');
require_once('includes/form.php');
require_once('includes/stories.php');

//checks x2 that session is underway and user logged in is admin
if(isset($_SESSION['userid']) == false){ 
    header('Location:login.php');
}

$oUser = new User();
$oUser->load($_SESSION['userid']);
if($oUser->sAdmin == 'no'){

	header('Location:login.php');
}

$oForm = new Form();

if(isset($_POST['submit']) == true){ //if the form is submitted

	$oForm->aData = $_POST; //inputted data is kept as sticky if an error occurs.

	//errors if the input is left empty
	if($_FILES['photo']['error'] > 0){
        $oForm->addError('photo', 'Please upload photo');
    }

	if($_POST['title'] == ''){
		$oForm->addError('title', 'Please enter a title');
	}

	if($_POST['age'] == ''){
		$oForm->addError('age', 'Please enter age of pet');
	}

	if($_POST['sex'] == ''){
		$oForm->addError('sex', 'Please enter sex of pet');
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

	if(count($oForm->aErrors) == 0){ //if there are no errors in the form input, create a new success story
		
		$oStory = new Success_Story();
	
		$aFileDetails = $_FILES['photo'];
    	$sNewFileName = time().$aFileDetails['name'];
    	$to = dirname(".").'/assets/images/'.$sNewFileName;

        move_uploaded_file($aFileDetails['tmp_name'], $to);

        $manager = new ImageManager();
        $image = $manager->make('assets/images/'.$sNewFileName)->crop(660, 600)->resize(330, 300);
        $image->save('assets/images/'.$sNewFileName);
	
		$oStory->sPhoto = $sNewFileName;
		$oStory->sTitle = $_POST['title'];
		$oStory->sAge = $_POST['age'];
		$oStory->sSex = $_POST['sex'];
		$oStory->sBreed = $_POST['breed'];
		$oStory->sTimeMissing = $_POST['time_missing'];
		$oStory->sStory = $_POST['story'];
	
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
$oForm->makeSubmit('Create', 'submit', 'pure-button-primary');
$oForm->close();


 ?>

 <div class="form-banner">	
	<h1>Create a New Success Story</h1>
	<p>Enter information of new success story in form below</p>
</div>

<div class="container">

<?php 
echo $oForm->sHTML; //displaying the form
?>

</div>

<?php 
require_once('includes/footer.php') 
?>