<?php 
ob_start();
require_once('includes/admin_header.php');
require_once('includes/form.php');
require_once('includes/categories.php');

//test 1 - check a session is underway
if(isset($_SESSION['userid']) == false){
	header('Location:login.php');
}

//test 2 - check that user is signed as admin
$oUser = new User();
$oUser->load($_SESSION['userid']);
if($oUser->sAdmin == 'no'){

	header('Location:login.php');
}


$oForm = new Form();

if(isset($_POST['submit']) == true){

	$oForm->aData = $_POST; //in the case that errors show data already entered is kept as sticky

	//errors if inputs are left empty
	if($_POST['category_name'] == ''){
		$oForm->addError('category_name', 'Please enter name of category');
	}

	if($_POST['category_description'] == ''){
		$oForm->addError('category_description', 'Please enter description of category');
	}

	if(count($oForm->aErrors) == 0){ //if there are no errors, create a new category with the following $_POST data and redirect to admin homepage.
		
		$oCategory = new Category();

		$oCategory->sCategoryName = $_POST['category_name'];
		$oCategory->sCategoryDescription = $_POST['category_description'];

		$oCategory->save();

		header('Location: admin_homepage.php');
	}
}

//making the form
$oForm->open();
$oForm->makeTextInput('Category Name', 'category_name', '');
$oForm->makeTextInput('Category Description', 'category_description', '');
$oForm->makeSubmit('Submit', 'submit', ' pure-button-primary');
$oForm->close();
?>

<div class="form-banner">	
	<h1>Create a New Category</h1>
	<p>Add a type of animal to include as a category for listings.</p>
</div>

<div class="container">

<?php 
echo $oForm->sHTML; //showing the form made above
?>

</div>

<?php 
require_once('includes/footer.php');
?>