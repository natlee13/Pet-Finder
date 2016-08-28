<?php 

require_once('connection.php');
require_once('user.php');

class Listing{

	public $iId;
	public $sPhoto;
	public $sTitle;
	public $sSuburb;
	public $sRegion;
	public $sDate;
	public $sSex;
	public $sBreed;
	public $sDescription;
	public $iCategoryId;
	public $iUserId;
	public $sContactName;
	public $sContactPh;
	public $sStatus;
	public $sDeleted;

	public function __construct(){
		$this->iId = 0;
		$this->sPhoto = '';
		$this->sTitle = '';
		$this->sSuburb = '';
		$this->sRegion = '';
		$this->sDate = '';
		$this->sSex = '';
		$this->sBreed = '';
		$this->sDescription = '';
		$this->iCategoryId = 0;
		$this->iUserId = 0;
		$this->sContactName = '';
		$this->sContactPh = '';
		$this->sStatus = '';
		$this->sDeleted = '';
	}

	public function load($iId){

		$oConnection = new Connection();

		$sSQL = 'SELECT id, photo, title, suburb, region, date, sex, breed, 
		contact_name, contact_ph, description, user_id, category_id, status,deleted
		FROM listings
		WHERE id =' .$iId;

		$oResultSet = $oConnection->query($sSQL);

		$aRow = $oConnection->fetch($oResultSet);

		$this->iId = $aRow['id'];
		$this->sPhoto = $aRow['photo'];
		$this->sTitle = $aRow['title'];
		$this->sSuburb = $aRow['suburb'];
		$this->sRegion = $aRow['region'];
		$this->sDate = $aRow['date'];
		$this->sSex = $aRow['sex'];
		$this->sBreed = $aRow['breed'];
		$this->sDescription = $aRow['description'];
		$this->iCategoryId = $aRow['category_id'];
		$this->iUserId = $aRow['user_id'];
		$this->sContactName = $aRow['contact_name'];
		$this->sContactPh = $aRow['contact_ph'];
		$this->sStatus = $aRow['status'];
		$this->sDeleted = $aRow['deleted'];
	}

	public function save(){

		$oConnection = new Connection();

		if($this->iId == 0){

			$sSQL = "INSERT INTO listings (photo, title, suburb, region, date, sex,
				breed, contact_name, contact_ph, description, user_id, category_id,
				status)
				VALUES ('".$oConnection->escape($this->sPhoto)."', 
					'".$oConnection->escape($this->sTitle)."',
					'".$oConnection->escape($this->sSuburb)."',
					'".$oConnection->escape($this->sRegion)."',
					'".$oConnection->escape($this->sDate)."',
					'".$oConnection->escape($this->sSex)."',
					'".$oConnection->escape($this->sBreed)."',
					'".$oConnection->escape($this->sContactName)."',
					'".$oConnection->escape($this->sContactPh)."',
					'".$oConnection->escape($this->sDescription)."',
					'".$oConnection->escape($this->iUserId)."',
					'".$oConnection->escape($this->iCategoryId)."',
					'".$oConnection->escape($this->sStatus)."')";

			

			$bSuccess = $oConnection->query($sSQL);

			if($bSuccess == true){
				$this->iId = $oConnection->getInsertId();
			}

		} else {

			$sSQL = "UPDATE listings
					SET photo = '".$oConnection->escape($this->sPhoto)."',
						title = '".$oConnection->escape($this->sTitle)."',
						suburb = '".$oConnection->escape($this->sSuburb)."',
						region = '".$oConnection->escape($this->sRegion)."',
						date = '".$oConnection->escape($this->sDate)."',
						sex = '".$oConnection->escape($this->sSex)."',
						breed = '".$oConnection->escape($this->sBreed)."',
						contact_name = '".$oConnection->escape($this->sContactName)."',
						contact_ph = '".$oConnection->escape($this->sContactPh)."',
						description = '".$oConnection->escape($this->sDescription)."',
						user_id = '".$oConnection->escape($this->iUserId)."',
						category_id = '".$oConnection->escape($this->iCategoryId)."',
						status = '".$oConnection->escape($this->sStatus)."',
						deleted = '".$oConnection->escape($this->sDeleted)."'
					WHERE id = ".$this->iId;

			$oConnection->query($sSQL);
		}
	}

}
//testing load.............................................
// $oListing = new Listing();
// $oListing->load(2);

// echo '<pre>';
// print_r($oListing);
// echo '</pre>';


//testing save (new info into existing listing).........................

// $oListing = new Listing();
// $oListing->load(2);
// $oListing->sTitle = 'Teddy is Missing';
// $oListing->sBreed = 'DLH';

// $oListing->sDeleted = '';
// $oListing->save();

// echo '<pre>';
// print_r($oListing);
// echo '</pre>';

//testing save (completely new listing).....................................

// $oListing = new Listing();
// $oListing->sTitle = 'Testing';
// $oListing->sSuburb = 'blah';
// $oListing->sPhoto = '';
// $oListing->sRegion = '';
// $oListing->sDate = '';
// $oListing->sSex = '';
// $oListing->sBreed = '';
// $oListing->sDescription = '';
// $oListing->iCategoryId = 1;
// $oListing->iUserId = 1;
// $oListing->sContactName = '';
// $oListing->sContactPh = '';
// $oListing->sStatus = 'lost';
// $oListing->save();

// echo '<pre>';
// print_r($oListing);
// echo '</pre>';

//testing load by userid.......................................

// $oListing = new Listing();
// $oListing->loadByUserId(3);

// echo '<pre>';
// print_r($oListing);
// echo '</pre>';
?>