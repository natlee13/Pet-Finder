<?php
ob_start();
require_once('includes/header.php'); 
require_once('includes/form.php');
require_once('includes/user.php');

$oForm = new Form();

if(isset($_POST['submit']) == true){ //if user clicks submit on form

    $oForm->aData = $_POST; // put sticky data in form for filled in fields if an error comes up

    //errors to appear if fields are left empty
    if($_POST['first_name'] == ''){ // if the input for firstname is empty
        $oForm->addError('first_name', 'Please enter first name'); //display this error
    }

    if($_POST['last_name'] == ''){
        $oForm->addError('last_name', 'Please enter last name');
    }

    if($_POST['organisation'] == ''){
        $oForm->addError('organisation', 'Please enter organisation or n/a');
    }

    if($_POST['email'] == ''){
        $oForm->addError('email', 'Please enter your email');
    }

    if($_POST['address'] == ''){
        $oForm->addError('address', 'Please enter address');
    }

    if($_POST['phone'] == ''){
        $oForm->addError('phone', 'Please enter your phone number');
    }

    if($_POST['username'] == ''){
        $oForm->addError('username', 'Please choose a username');
    }

    if($_POST['password'] == ''){
        $oForm->addError('password', 'Please choose a password');
    }

    if($_POST['confirmpw'] == '' || $_POST['password'] != $_POST['confirmpw']){ //if the confirm password input is empty or 
        //is not the same as the password
        $oForm->addError('confirmpw', 'Please confirm password');
    }

    if(count($oForm->aErrors) == 0 && $_POST['password'] == $_POST['confirmpw']){  //if there are no errors and the password and confirm password fields match

            $oUser = new User(); //create a new user with the following values

            $oUser->sFirstName = $_POST['first_name'];
            $oUser->sLastName = $_POST['last_name'];
            $oUser->sOrganisation = $_POST['organisation'];
            $oUser->sEmail = $_POST['email'];
            $oUser->sAddress = $_POST['address'];
            $oUser->sPhone = $_POST['phone'];
            $oUser->sUserName = $_POST['username'];
            $oUser->sPassword = password_hash($_POST['password'],PASSWORD_DEFAULT);

            $oUser->save();

            $_SESSION['userid'] = $oUser->iId; //creates a session using userid so can redirect to member_homepage

            header('Location:member_homepage.php'); //redirect to the member homepage
    }   
}

//making the form
$oForm->open();
$oForm->makeTextInput('First Name:', 'first_name','');
$oForm->makeTextInput('Last Name:', 'last_name', '');
$oForm->makeTextInput('Organisation:', 'organisation', 'Type n/a if not an organisation');
$oForm->makeTextInput('Email:', 'email', '');
$oForm->makeTextInput('Address:', 'address', '');
$oForm->makeTextInput('Phone:', 'phone', '');
$oForm->makeTextInput('Choose Username', 'username', '');
$oForm->makePasswordInput('Choose Password', 'password', '');
$oForm->makePasswordInput('Confirm Password', 'confirmpw', '');
$oForm->makeSubmit('Sign Up', 'submit', 'signup', '');
$oForm->close();
?>


<div class="form-banner">	
	<h1>Sign Up to Become a Member</h1>
	<p>Sign up to create a listing or &nbsp<a class="login" href="login.php">Login</a></p>
</div>

<div class="container">

<?php 
echo $oForm->sHTML;  //displaying the form
?>	
	
</div>

<?php 
require_once('includes/footer.php') 
?>