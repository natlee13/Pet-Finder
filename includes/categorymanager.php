<?php 

require_once('connection.php');
require_once('categories.php');

class CategoryManager{

	static public function getCategories(){

		$aCategories = [];

		$oConnection = new Connection();

		$sSQL = 'SELECT id FROM categories';

		$oResultSet = $oConnection->query($sSQL);

		while($aRow = $oConnection->fetch($oResultSet)){

			$iCategoryId = $aRow['id'];

			$oCategory = new Category();
			$oCategory->load($iCategoryId);

			$aCategories[] = $oCategory;
		}

		return $aCategories;
	}

	static public function listCategories(){

		$aCategories = [];

		$oConnection = new Connection();

		$sSQL = 'SELECT id, category_name
				FROM categories';

		$oResultSet = $oConnection->query($sSQL);

		while($aRow = $oConnection->fetch($oResultSet)){

			$iCategoryId = $aRow['id'];

			$aCategories[$iCategoryId] = $aRow['category_name'];
		}

		return $aCategories;
	}
	
}

//testing

// echo '<pre>';
// print_r(CategoryManager::getCategories());
// echo '</pre>';

// echo '<pre>';
// print_r(CategoryManager::listCategories());
// echo '</pre>';

?>