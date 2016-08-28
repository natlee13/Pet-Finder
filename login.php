<?php
ob_start();
require_once('includes/header.php');
require_once('includes/form.php');
require_once('includes/user.php');

$oForm = new Form();

$sMessage = '';

if(isset($_POST['submit']) == true){ //if the user clicks submit


	$oForm->aData = $_POST; //sticky data in filled in inputs if error comes up

	if($_POST['username'] == ''){ //if username is empty 
		$oForm->addError('username','Please enter your username'); //display this error
	}

	if($_POST['password'] == ''){ //if password is empty
		$oForm->addError('password','Please enter your password'); // display this error
	}


	if(count($oForm->aErrors) == 0){ //if there are no errors i.e empty inputs

		$oUser = new User(); //create a new user
		$bSuccess = $oUser->loadByUserName($_POST['username']); //and load by username

		if($bSuccess == true){ //if able to load

			if(password_verify($_POST['password'], $oUser->sPassword) == true){ //if the password is correct

				$_SESSION['userid'] = $oUser->iId; //create a session using the user id, records who is logged in
				
				if($oUser->sAdmin == 'yes'){ //if user is admin

					header('Location: admin_homepage.php'); //redirect to admin homepage

				}else{

					header('Location:member_homepage.php'); //redirect logged in user to the member homepage.
				}
			
			}else{
				//header('Location: login.php'); //redirect to login page if password is incorrect
				$sMessage = 'Username or Password Incorrect.  Please try again';
			}

		}else{

			$bSuccess == false; //if cannot load by username
			$sMessage = 'Username or Password entered is incorrect.  Please try again';
		}
	}
}

//making the form
$oForm->open();
$oForm->makeTextInput('Username', 'username','');
$oForm->makePasswordInput('Password', 'password','');
$oForm->makeSubmit('Login', 'submit', 'login','');
$oForm->close();
?>

<div class="form-banner">	
	<h1>Login</h1>
	<p>Log in to create a listing or &nbsp <a class="signup" href="registration.php">Sign Up</a>

</div>

<div class="container">	
	<div class="login-message">
		<?php 
		echo $sMessage; //displays error message if username or password are incorrect
		?> 
	</div>

<?php 
echo $oForm->sHTML; //displaying the form
?>

</div>


<?php 
require_once('includes/footer.php') 
?>