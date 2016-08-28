<?php 
ob_start();
require_once('includes/header.php');
require_once('includes/form.php');
require_once('includes/user.php');

//check if user logged in
if(isset($_SESSION['userid']) == true){ //if user is logged in
	$iCurrentUserId = $_SESSION['userid']; 
}

else{ //if user not logged in redirect to log in page
	header('Location: login.php');
}

$oUser = new User(); //create a new user
$oUser->load($iCurrentUserId); //load user by user id

//making sticky data for form
$aStickyData = [];

$aStickyData['first_name'] = $oUser->sFirstName;
$aStickyData['last_name'] = $oUser->sLastName;
$aStickyData['organisation'] = $oUser->sOrganisation;
$aStickyData['email'] = $oUser->sEmail;
$aStickyData['address'] = $oUser->sAddress;
$aStickyData['phone'] = $oUser->sPhone;
$aStickyData['username'] = $oUser->sUserName;
// $aStickyData['password'] = $oUser->sPassword;

$oForm = new Form();
$oForm->aData = $aStickyData; //putting sticky data into form

if(isset($_POST['submit']) == true){ //if user clicks submit button
	$oForm->aData = $_POST;
	//errors to show if form field left empty
	if($_POST['first_name'] == ''){
		$oForm->addError('first_name', 'Please fill in'); 
	}

	if($_POST['last_name'] == ''){
		$oForm->addError('last_name', 'Please fill in');
	}

	if($_POST['organisation'] == ''){
		$oForm->addError('organisation', 'Please fill in');
	}

	if($_POST['email'] == ''){
		$oForm->addError('email', 'Please fill in');
	}

	if($_POST['address'] == ''){
		$oForm->addError('address', 'Please fill in');
	}

	if($_POST['phone'] == ''){
		$oForm->addError('phone', 'Please fill in');
	}

	if($_POST['username'] == ''){
		$oForm->addError('username', 'Please fill in');
	}

	if($_POST['password'] == ''){
		$oForm->addError('password', 'Please fill in');
	}
	if($_POST['confirmpw'] == '' || $_POST['password'] != $_POST['confirmpw']){ //if the confirm password input is empty or 
        //is not the same as the password
        $oForm->addError('confirmpw', 'Please confirm password');
    }

	if(count($oForm->aErrors) == 0){ //if there are no errors, store the inputted data as follows and save to db

		$oUser->sFirstName = $_POST['first_name'];
		$oUser->sLastName = $_POST['last_name'];
		$oUser->sOrganisation = $_POST['organisation'];
		$oUser->sEmail = $_POST['email'];
		$oUser->sAddress = $_POST['address'];
		$oUser->sPhone = $_POST['phone'];
		$oUser->sUserName = $_POST['username'];
		$oUser->sPassword = password_hash($_POST['password'],PASSWORD_DEFAULT);

		$oUser->save();

	header('Location:userdetails.php');//redirect to user details page

	}
}
//making form
$oForm->open();
$oForm->makeTextInput('Username:', 'username', '');
$oForm->makeTextInput('First Name:', 'first_name', '');
$oForm->makeTextInput('Last Name:', 'last_name', '');
$oForm->makeTextInput('Organisation:', 'organisation', '');
$oForm->makeTextInput('Email:', 'email', '');
$oForm->makeTextInput('Address:', 'address', '');
$oForm->makeTextInput('Phone:', 'phone', '');
$oForm->makePasswordInput('Change Password:', 'password', 'Or Enter Current Password');
$oForm->makePasswordInput('Confirm Password:', 'confirmpw', '');
$oForm->makeSubmit('Update', 'submit', 'login');

$oForm->close();

?>

 <div class="form-banner">	
	<h1>Update Your Member Details Here</h1>
	<p>Make your changes in the form below to keep your details up to date</p>
</div>

<div class="container">

<?php 
echo $oForm->sHTML; //display form
?>

</div>