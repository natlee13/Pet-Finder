<?php 

require_once('includes/header.php');

//checking that member is logged in
if(isset($_SESSION['userid']) == false){ 
	header('Location:login.php');
}

?>

<div class="headerPhoto">	
	<div class="titleBox">
		<h1>Welcome to Pet Finder</h1>
		<h3>Helping Reunite You with Your Best Friend</h3>
		<p>A comprehensive database of lost and found NZ pets. </p>
		<form action="search_results.php" method = "POST" class="pure-form search">
			<input type="text" name="keyword" placeholder="Search">
			<input type="submit" name = "submit" class="search-button" value="Go">
		</form>
		<a class="listing-button" href="user_create_listing.php">Create Listing</a>
	</div>
</div>

<div class="container">
	
	<div class="about">
		<h2>Lost Pets</h2>
		<p>Have you lost your best friend?  Browse our listings for stray pets that have been found or log in and create a customised listing in the lost pets section for all users to see.</p>
	</div>

	<div class="about">
		<h2>Found Pets</h2>
		<p>Has a pet turned up on your doorstep? Perhaps a dog followed you home or you found an injured pet? 
		Browse our lost listings to look for a match or log in to create a found listing.</p>
	</div>
	
	<div class="about">
		<h2>Success Stories</h2>
		<p>Read a selection of success stories, including Rusty the boxer, reunited with his family after 6 days 
		missing, and Snowy who was missing for 8 months.</p>
	</div>
</div>


<?php 

require_once('includes/footer.php');

?>