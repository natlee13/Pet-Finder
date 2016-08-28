<?php 

session_start();
require_once('categorymanager.php');
require_once('view.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pet Finder</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/base-min.css">
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
	<link href='https://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Merriweather:400' rel='stylesheet' type='text/css'>
	<script src="https://use.fontawesome.com/af578e55d7.js"></script>
	<link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<div class = "header">
	<div class= "logo">	
		<img src="assets/images/logo2.png" alt="">	
	</div>

<?php 

$aCategories = CategoryManager::getCategories();
echo View::renderNav($aCategories);

?>

</div>