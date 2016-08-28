<?php 

require_once('connection.php');
require_once('listings.php');

class User{

	public $iId;
	public $sFirstName;
	public $sLastName;
	public $sOrganisation;
	public $sEmail;
	public $sAddress;
	public $sPhone;
	public $sUserName;
	public $sPassword;
	public $sAdmin;
	public $aUserListings;

	public function __construct(){
		$this->iId = 0;
		$this->sFirstName = '';
		$this->sLastName = '';
		$this->sOrganisation = '';
		$this->sEmail = '';
		$this->sAddress = '';
		$this->sPhone = '';
		$this->sUserName = '';
		$this->sPassword = '';
		$this->sAdmin = '';
		$this->aUserListings = [];

	}

	public function load($iId){

		$oConnection = new Connection();

		$sSQL = 'SELECT id, first_name, last_name, organisation, email, 
				address, phone, username, password, admin
				FROM users
				WHERE id = '.$iId;

		$oResultSet = $oConnection->query($sSQL);

		$aRow = $oConnection->fetch($oResultSet);

		$this->iId = $aRow['id'];
		$this->sFirstName = $aRow['first_name'];
		$this->sLastName = $aRow['last_name'];
		$this->sOrganisation = $aRow['organisation'];
		$this->sEmail = $aRow['email'];
		$this->sAddress = $aRow['address'];
		$this->sPhone = $aRow['phone'];
		$this->sUserName = $aRow['username'];
		$this->sPassword = $aRow['password'];
		$this->sAdmin = $aRow['admin'];

		//find list of listings id for the user

		$sSQL = 'SELECT id
				FROM listings
				WHERE user_id = '.$iId;

		$oResultSet = $oConnection->query($sSQL);

		while($aRow = $oConnection->fetch($oResultSet)){
			
			$iListingId = $aRow['id'];

			$oListing = new Listing();
			$oListing->load($iListingId);
			$this->aUserListings[] = $oListing;
		}

	}

	public function save(){

		$oConnection = new Connection();

		if($this->iId == 0){
			$sSQL = "INSERT INTO users (first_name, last_name, 
					organisation, email, address, phone, username, password)
					VALUES ('".$oConnection->escape($this->sFirstName)."',
							'".$oConnection->escape($this->sLastName)."',
							'".$oConnection->escape($this->sOrganisation)."',
							'".$oConnection->escape($this->sEmail)."',
							'".$oConnection->escape($this->sAddress)."',
							'".$oConnection->escape($this->sPhone)."',
							'".$oConnection->escape($this->sUserName)."',
							'".$oConnection->escape($this->sPassword)."')";
			
			$bSuccess = $oConnection->query($sSQL);

			if($bSuccess == true){
				$this->iId = $oConnection->getInsertId();
			}
		
		}else{

			$sSQL = "UPDATE users
					SET first_name = '".$oConnection->escape($this->sFirstName)."',
					last_name = '".$oConnection->escape($this->sLastName)."',
					organisation = '".$oConnection->escape($this->sOrganisation)."',
					email = '".$oConnection->escape($this->sEmail)."',
					address = '".$oConnection->escape($this->sAddress)."',
					phone = '".$oConnection->escape($this->sPhone)."',
					username = '".$oConnection->escape($this->sUserName)."',
					password = '".$oConnection->escape($this->sPassword)."',
					admin = '".$oConnection->escape($this->sAdmin)."'
					WHERE id = ".$this->iId;

			$oConnection->query($sSQL);
		}
	}

	public function loadByUserName($sUserName){
		
		$oConnection = new Connection();

		$sSQL = "SELECT id, first_name, last_name, organisation, email, address, phone,
				username, password, admin
				FROM users
				WHERE username = '".$oConnection->escape($sUserName)."'";

		$oResultSet = $oConnection->query($sSQL);

		$aRow = $oConnection->fetch($oResultSet);

		if($aRow == true){

			$this->iId = $aRow['id'];
			$this->sFirstName = $aRow['first_name'];
			$this->sLastName = $aRow['last_name'];
			$this->sOrganisation = $aRow['organisation'];
			$this->sEmail = $aRow['email'];
			$this->sAddress = $aRow['address'];
			$this->sPhone = $aRow['phone'];
			$this->sUserName = $aRow['username'];
			$this->sPassword = $aRow['password'];
			$this->sAdmin = $aRow['admin'];

			return true;

		}else{

			return false;
		}
	}

	
}

//testing - load user...................................
// $oUser = new User();
// $oUser->load(1);

// echo '<pre>';
// print_r($oUser);
// echo '</pre>';


// ...............................testing save..............................

//save new user
// $oUser = new User();

// $oUser->sFirstName = 'Joe';
// $oUser->sLastName = 'Blogs';
// $oUser->sUserName = 'joe';
// $oUser->save();

// echo '<pre>';
// print_r($oUser);
// echo '</pre>';

//change existing user details
// $oUser = new User();
// $oUser->load(1);
// $oUser->sFirstName = 'xxxxBob';
// $oUser->sPhone = '(09) 647 3930';
// $oUser->sAddress = '1234 Everglade Rd, Mt Eden, Auckland';
// $oUser->save();

// echo '<pre>';
// print_r($oUser);
// echo '</pre>';

//testing loadByUserName...........................
// $oUser = new User();
// $oUser->loadByUserName('nat1');

// echo '<pre>';
// print_r($oUser);
// echo '</pre>';
?>