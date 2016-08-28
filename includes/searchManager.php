<?php

require_once('connection.php');
require_once('listings.php');  

class SearchManager{

	static public function searchListings($keywords){

		$aListings = [];

		$oConnection = new Connection();

		$sSQL = 'SELECT id
				FROM listings
				WHERE MATCH(description, breed, region, title, suburb)AGAINST("'.$oConnection->escape($keywords).'" IN NATURAL LANGUAGE MODE)';

		$oResultSet = $oConnection->query($sSQL);

		while($aRow = $oConnection->fetch($oResultSet)){

			$iListingId = $aRow['id'];

			$oListing = new Listing();
			$oListing->load($iListingId);

			$aListings[] = $oListing;
		}

		return $aListings;
	}
}

//testing

// $aListings = SearchManager::searchListings('Having red collar');

// echo '<pre>';
// print_r($aListings);
// echo '</pre>';

?>