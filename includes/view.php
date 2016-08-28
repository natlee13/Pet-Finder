<?php  

class View{

	static public function renderNav($aCategories){

		$sHTML = '	<ul class = "leftNav">';

		if(isset($_SESSION['userid']) == true){
		
			$sHTML .= '<li><a href="member_homepage.php">Home</a></li>';
		
		}else{

			$sHTML .= '<li><a href="index.php">Home</a></li>';
		}
		
		$sHTML .=	'<li class="dropdown"> 						
						<a href="#" class="dropbtn">&nbsp&nbsp Lost &nbsp <i class="fa fa-caret-down" aria-hidden="true"></i> </a>
			 			<div class="dropdown-content">';

		for($i=0; $i<count($aCategories); $i++){

			$oCategory = $aCategories[$i];
	
			$sHTML .= '<a href="main.php?categoryid='.$oCategory->iId.'&status=lost">'.htmlentities($oCategory->sCategoryName).'</a>';
		}

  		$sHTML .= '</div>
  				</li>
		
				<li class="dropdown">
					<a href="#" class="dropbtn">Found &nbsp <i class="fa fa-caret-down" aria-hidden="true"></i></a>
					<div class = "dropdown-content">';
				
		for($i=0; $i<count($aCategories); $i++){

			$oCategory = $aCategories[$i];
	
			$sHTML .= '<a href="main.php?categoryid='.$oCategory->iId.'&status=found">'.htmlentities($oCategory->sCategoryName).'</a>';
		}
			
		$sHTML .= '</div>
				</li>

				<li><a href="success_stories.php">Success Stories</a></li>
			</ul>';

		if(isset($_SESSION['userid']) == true){ //if a session is underway ie. user is logged in show this rhs nav
	
			$sHTML .= '<ul class="rightNav">
				<li><a href="user_create_listing.php">Create a Listing</a></li>
				<li><a href="user_view_listings.php">My Listings</a></li>
				<li><a href="userdetails.php">My Details</a></li>
				<li><a href="logout.php"><span><i class="fa fa-sign-out" aria-hidden="true"></i></span>&nbsp Log Out</a></li>	
			</ul>';

		}else{ //if a session is not underway show this rhs nav

			$sHTML .= '	<ul class="rightNav">	
					<li><a href="registration.php"><span><i class="fa fa-user" aria-hidden="true"></i></span>&nbsp Sign Up</a></li>
					<li><a href="login.php"><span><i class="fa fa-sign-in" aria-hidden="true"></i></span>&nbsp Log In</a></li>	
				</ul>';
		}
		
		return $sHTML;
	}

	static public function renderListings($oCategory,$sStatus){

		if($sStatus == 'lost'){

			$aListings = $oCategory->aLostListings;
		
		}else{

			$aListings = $oCategory->aFoundListings;

		}

		$sHTML = '<div class="banner">	
					<h1>Browse Listings</h1>
					<p>Check out our listings for lost or stray pets here</p>
					
					</div>

				<div class="container">';

		for($i=0; $i<count($aListings); $i++){

			$oListing = $aListings[$i];

			if($oListing->sDeleted == 'no'){

				$sHTML .= '<div class="listing">	
						<img src="assets/images/'.htmlentities($oListing->sPhoto).'" alt="">
						<div class="listing-info">
							<h3>'.htmlentities($oListing->sTitle).'</h3>
							<p><span>Region:</span>'.htmlentities($oListing->sRegion).'</p>
							<p><span>Date:</span>'.htmlentities($oListing->sDate).'</p>
						</div>
						<a class="view-listing-button" href="full_listing.php?listingid='.$oListing->iId.'">View Listing</a>
					</div>';
			}
		}
		
		$sHTML .= '</div>';

		return $sHTML;
	}

	static public function renderFullListing($oListing){

		$sHTML = '<div class="container">
					<div class="big-image">
						<img src="assets/images/'.htmlentities($oListing->sPhoto).'" alt="">
					</div>
					<div class="full-listing">
						<h3>'.htmlentities($oListing->sTitle).'</h3>
						<p><span>Listing ID: </span>'.htmlentities($oListing->iId).'</p>
						<p><span>Suburb: </span>'.htmlentities($oListing->sSuburb).'</p>
						<p><span>Region: </span>'.htmlentities($oListing->sRegion).'</p>
						<p><span>Date: </span>'.htmlentities($oListing->sDate).'</p>
						<p><span>Sex: </span>'.htmlentities($oListing->sSex).'<p>
						<p><span>Breed: </span>'.htmlentities($oListing->sBreed).'</p>
						<hr>
						<p>'.htmlentities($oListing->sDescription).'</p>
						<hr>
						<p><span>Contact: </span>'.htmlentities($oListing->sContactName).'</p>
						<p><span>Contact Ph:</span>'.htmlentities($oListing->sContactPh).'</p>
					</div>
				</div>';
		
		return $sHTML;
	}

	static public function renderSuccessStories($aSuccessStories){

		$sHTML = ' <div class="banner">	
					<h1>Success Stories</h1>
					<p>Check out these great success stories</p>
				</div>

				<div class="container">';

		for($i=0; $i<count($aSuccessStories); $i++){
		
		$oSuccessStory = $aSuccessStories[$i];

				if($oSuccessStory->sDeleted == 'no'){
						$sHTML .= '<div class="success-story">
						<img src="assets/images/'.htmlentities($oSuccessStory->sPhoto).'" alt="">
						<div class="info">
							<h3>'.htmlentities($oSuccessStory->sTitle).'</h3>
							<p><span>Age:</span>'.htmlentities($oSuccessStory->sAge).'</p>
							<p><span>Sex:</span>'.htmlentities($oSuccessStory->sSex).'</p>
							<p><span>Breed:</span>'.htmlentities($oSuccessStory->sBreed).'</p>
							<p><span>Time Missing:</span>'.htmlentities($oSuccessStory->sTimeMissing).'</p>
							<p>'.htmlentities($oSuccessStory->sStory).'</p>
						</div>
					</div>
				<hr>';
			}
		}
				
		$sHTML .= '</div>';

		return $sHTML;
	}

	public function renderUserDetails($oUser){

		$sHTML = '<div class="banner">	
					<h1>View Your Member Details</h1>
					<a class="edit-details-button" href="user_edit_details.php">Edit details</a>	
				</div>

				<div class="container">
					<ul class="user-details">
						<li><span>User ID:</span>'.htmlentities($oUser->iId).'</li>
						<li><span>Username:</span>'.htmlentities($oUser->sUserName).'</li>
						<li><span>First Name:</span>'.htmlentities($oUser->sFirstName).'</li>
						<li><span>Last Name:</span> '.htmlentities($oUser->sLastName).'</li>
						<li><span>Organisation:</span>'.htmlentities($oUser->sOrganisation).'</li>
						<li><span>Email:</span>'.htmlentities($oUser->sEmail).'</li>
						<li><span>Address:</span>'.htmlentities($oUser->sAddress).'</li>
						<li><span>Telephone:</span>'.htmlentities($oUser->sPhone).'</li>
					</ul>

				</div>';

		return $sHTML;

	}

	public function renderUserListings($aUserListings){

		$sHTML = '<div class="container">';

		for($i=0; $i<count($aUserListings); $i++){

			$oUserListing = $aUserListings[$i];

			if($oUserListing->sDeleted == 'no'){

				$sHTML .= '<div class="user-listing">	
					<img src="assets/images/'.htmlentities($oUserListing->sPhoto).'" alt="">
					<div class="listing-info">
						<h3>'.htmlentities($oUserListing->sTitle).'</h3>
						<span>Suburb:</span><p>'.htmlentities($oUserListing->sSuburb).'</p>
						<span>Region:</span><p>'.htmlentities($oUserListing->sRegion).'</p>
						<span>Date L/F:</span><p>'.htmlentities($oUserListing->sDate).'</p>
						<span>Sex:</span><p>'.htmlentities($oUserListing->sSex).'<p>
						<span>Breed:</span><p>'.htmlentities($oUserListing->sBreed).'</p><br>
						<span>Contact:</span><p>'.htmlentities($oUserListing->sContactName).'</p>
						<span>Contact ph:</span><p>'.htmlentities($oUserListing->sContactPh).'</p><br>
						<p>'.htmlentities($oUserListing->sDescription).'</p>	
					</div>
					<a class="edit" href="user_edit_listing.php?listingid='.htmlentities($oUserListing->iId).'">Edit</a>
					<a class="delete" href="user_delete_listing.php?listingid='.htmlentities($oUserListing->iId).'">Remove</a>
				</div>';
			}
		}

		$sHTML .= '</div>';

		return $sHTML;
	}

	static public function renderAdminNav($aCategories){

		$sHTML = '	<ul class = "leftNav">';

		if(isset($_SESSION['userid']) == true){
		
			$sHTML .= '<li><a href="admin_homepage.php">Home</a></li>';
		
		}else{

			$sHTML .= '<li><a href="homepage.php">Home</a></li>';
		}
		
		$sHTML .=	'<li class="dropdown">
						<a href="#" class="dropbtn">&nbsp&nbsp Lost &nbsp <i class="fa fa-caret-down" aria-hidden="true"></i></a>
			 			<div class="dropdown-content">';

		for($i=0; $i<count($aCategories); $i++){

			$oCategory = $aCategories[$i];
	
			$sHTML .= '<a href="admin_main.php?categoryid='.$oCategory->iId.'&status=lost">'.htmlentities($oCategory->sCategoryName).'</a>';
		}

  		$sHTML .= '</div>
  				</li>
		
				<li class="dropdown">
					<a href="#" class="dropbtn">Found &nbsp <i class="fa fa-caret-down" aria-hidden="true"></i></a>
					<div class = "dropdown-content">';
				
		for($i=0; $i<count($aCategories); $i++){

			$oCategory = $aCategories[$i];
	
			$sHTML .= '<a href="admin_main.php?categoryid='.$oCategory->iId.'&status=found">'.htmlentities($oCategory->sCategoryName).'</a>';
		}
			
		$sHTML .= '</div>
				</li>

				<li><a href="admin_success_stories.php">Success Stories</a></li>
				<li><a href="admin_view_deleted.php">Deleted Listings</li>
			</ul>
			
			<ul class="rightNav">
				<li><a href="logout.php"><span><i class="fa fa-sign-out" aria-hidden="true"></i></span>&nbspLog Out</a></li>	
			</ul>';
		
		return $sHTML;
	}

	static public function renderAdminListings($oCategory,$sStatus){

		if($sStatus == 'lost'){

			$aListings = $oCategory->aLostListings;
		
		}else{

			$aListings = $oCategory->aFoundListings;

		}

		$sHTML = '<div class="banner">	
					<h1>Browse Listings</h1>
					<p>Edit or Delete Listings Here</p>
					</div>

				<div class="container">';

		for($i=0; $i<count($aListings); $i++){

			$oListing = $aListings[$i];

			if($oListing->sDeleted == 'no'){

				$sHTML .= '<div class="listing">	
								<img src="assets/images/'.htmlentities($oListing->sPhoto).'" alt="">
								<div class="listing-info">
									<h3>'.htmlentities($oListing->sTitle).'</h3>
									<p><span>Region:</span>'.htmlentities($oListing->sRegion).'</p>
									<p><span>Date:</span>'.htmlentities($oListing->sDate).'</p>
							</div>
		
							<a class="admin-edit-listing" href="admin_edit_listing.php?listingid='.$oListing->iId.'">Edit</a>
							<a class="admin-delete-listing" href="admin_delete_listing.php?listingid='.$oListing->iId.'">Delete</a>
							</div>';
			}

		}

		return $sHTML;
	}


	static public function renderAdminSuccessStories($aSuccessStories){

		$sHTML = ' <div class="banner">	
					<h1>Success Stories</h1>
					<p>Edit or Delete Success Stories Here</p>
				</div>

				<div class="container">';

		for($i=0; $i<count($aSuccessStories); $i++){
		
		$oSuccessStory = $aSuccessStories[$i];

		if($oSuccessStory->sDeleted == 'no'){
				$sHTML .= '<div class="success-story">
						<img src="assets/images/'.htmlentities($oSuccessStory->sPhoto).'" alt="">
						<div class="info">
							<h3>'.htmlentities($oSuccessStory->sTitle).'</h3>
							<p><span>Age:</span>'.htmlentities($oSuccessStory->sAge).'</p>
							<p><span>Sex:</span>'.htmlentities($oSuccessStory->sSex).'</p>
							<p><span>Breed:</span>'.htmlentities($oSuccessStory->sBreed).'</p>
							<p><span>Time Missing:</span>'.htmlentities($oSuccessStory->sTimeMissing).'</p>
							<p>'.htmlentities($oSuccessStory->sStory).'</p>
							<a class="admin-edit" href="admin_edit_success_story.php?storyid='.$oSuccessStory->iId.'">Edit</a>
							<a class="admin-delete" href="admin_delete_success_story.php?storyid='.$oSuccessStory->iId.'">Delete</a>
						</div>
					</div>
				<hr>';
			}
		}
				
		$sHTML .= '</div>';

		return $sHTML;
	}

	static public function renderDeletedListings($oCategory){
		
			$aDeletedListings = $oCategory->aDeletedListings;

		$sHTML = '<div class="form-banner">	
					<h1>View Deleted Listings</h1>
					<p>See listings that have been removed from the site here</p>
				</div>

				<div class="container">';

		for($i=0; $i<count($aDeletedListings); $i++){

			$oListing = $aDeletedListings[$i];

			$sHTML .= '<div class="listing">	
						<img src="assets/images/'.htmlentities($oListing->sPhoto).'" alt="">
						<div class="listing-info">
							<h3>'.htmlentities($oListing->sTitle).'</h3>
							<p><span>Region:</span>'.htmlentities($oListing->sRegion).'</p>
							<p><span>Date:</span>'.htmlentities($oListing->sDate).'</p>
						</div>
						<a class="view-listing-button" href="admin_repost_listing.php?listingid='.$oListing->iId.'">Re-Post</a>
					</div>';
					;
		}

		$sHTML .= '</div>';

		return $sHTML;
	}

		
	static public function renderSearchResults($aListings){

		$sHTML = '<div class="banner">	
					<h1>Search Results</h1>
					<p>Results of your search are below</p>
					</div>

				<div class="container">';

		for($i=0; $i<count($aListings); $i++){

			$oListing = $aListings[$i];

			if($oListing->sDeleted == 'no'){

				$sHTML .= '<div class="listing">	
								<img src="assets/images/'.htmlentities($oListing->sPhoto).'" alt="">
								<div class="listing-info">
									<h3>'.htmlentities($oListing->sTitle).'</h3>
									<p><span>Region:</span>'.htmlentities($oListing->sRegion).'</p>
									<p><span>Date:</span>'.htmlentities($oListing->sDate).'</p>
							</div>
		
							<a class="view-listing-button" href="full_listing.php?listingid='.$oListing->iId.'">View Listing</a>
							</div>';
			}

		}
		return $sHTML;
	}
}


?>