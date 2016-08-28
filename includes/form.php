<?php 

class Form{
	public $sHTML;
	public $aData;
	public $aErrors;

	public function __construct(){
		$this->sHTML = '';
		$this->aData = [];
		$this->aErrors = [];
	}

	public function open(){

		$this->sHTML .= '<form action="" method="POST" enctype="multipart/form-data" class="pure-form pure-form-aligned login-form">
    						<fieldset>';
	}

	public function close(){

		$this->sHTML .= '</fieldset>
						</form>';
	}

	public function makeTextInput($sLabel, $sInputName, $sPlaceholder){

		$sData = ''; //sticky data

		//check for sticky data of input
		if(isset($this->aData[$sInputName]) == true){
			$sData = $this->aData[$sInputName];
		}

		$sError = '';

		//check for errors in input
		if(isset($this->aErrors[$sInputName]) == true){
			$sError = $this->aErrors[$sInputName];
		}

		$this->sHTML .= '<div class="pure-control-group">
            				<label for="'.$sInputName.'">'.$sLabel.'</label>
            				<input id="'.$sInputName.'" type="text" name="'.$sInputName.'" placeholder="'.$sPlaceholder.'" 
            				value="'.$sData.'">
        				</div>';

        $this->sHTML .= '<span class = "error">'.$sError.'</span>';
	}

	public function makePasswordInput($sLabel, $sInputName, $sPlaceholder){

		$sData = ''; //sticky data

		//check for sticky data of input
		if(isset($this->aData[$sInputName]) == true){
			$sData = $this->aData[$sInputName];
		}

		$sError = '';

		//check for errors in input
		if(isset($this->aErrors[$sInputName]) == true){
			$sError = $this->aErrors[$sInputName];
		}

		$this->sHTML .= '<div class="pure-control-group">
            				<label for="'.$sInputName.'">'.$sLabel.'</label>
            				<input id="'.$sInputName.'" type="password" name="'.$sInputName.'" placeholder="'.$sPlaceholder.'" 
            				value="'.$sData.'">
        				</div>';

        $this->sHTML .= '<span class = "error">'.$sError.'</span>';
	}

	public function maketextArea($sLabel, $sInputName, $sPlaceholder){

		$sData = ''; //sticky data

		//check for sticky data of input
		if(isset($this->aData[$sInputName]) == true){
			$sData = $this->aData[$sInputName];
		}

		$sError = '';

		//check for errors in input
		if(isset($this->aErrors[$sInputName]) == true){
			$sError = $this->aErrors[$sInputName];
		}

		$this->sHTML .= '<div class="pure-control-group">
            				<label for="'.$sInputName.'">'.$sLabel.'</label>
            				<textarea id="'.$sInputName.'" type="text" name="'.$sInputName.'" 
            				placeholder="'.$sPlaceholder.'">'.$sData.'</textarea>
        				</div>';

        $this->sHTML .= '<span class = "error">'.$sError.'</span>';
	}

	public function makeSubmit($sLabel, $sInputName, $sClass){ //??ad $sClass to change class (colour) of button?
		$this->sHTML .= '<div class="pure-controls">
							<button type="submit" class="pure-button '.$sClass.'" name="'.$sInputName.'">'.$sLabel.'</button>
       					 </div>';

	}

	public function makeSelectInput($sLabel, $sInputName, $aOptions){

		$sData = '';

		if(isset($this->aData[$sInputName]) == true){
			$sData =$this->aData[$sInputName];
		}

		 $sError = '';

        if(isset($this->aErrors[$sInputName])  == true){
            $sError = $this->aErrors[$sInputName];
        }

        $this->sHTML .= '<div class="pure-control-group">
            				<label for="'.$sInputName.'">'.$sLabel.'</label>
        					<select id="'.$sInputName.'" name="'.$sInputName.'" value="'.$sData.'">';

        foreach($aOptions as $sValue=>$sText){

        	if($sValue == $sData){
        		$this->sHTML .=	'<option value = "'.$sValue.'" selected>'.$sText.'</option>';

        	}else{
        		$this->sHTML .=	'<option value = "'.$sValue.'">'.$sText.'</option>';

        	}
            
          }
        
        $this->sHTML .= ' </select>
        				</div>';  

        $this->sHTML .= '<span class = "error">'.$sError.'</span>';  		

	}

	public function makeFileInput($sLabel, $sInputName){

		$sData = '';

		if(isset($this->aData[$sInputName]) == true){
			$sData =$this->aData[$sInputName];
		}

		$sError = '';

		//check for errors in input
		if(isset($this->aErrors[$sInputName]) == true){
			$sError = $this->aErrors[$sInputName];
		}

		$this->sHTML .= '<div class="pure-control-group">
            				<label for="'.$sInputName.'">'.$sLabel.'</label>
            				<input id="'.$sInputName.'" type="file" name="'.$sInputName.'" value="'.$sData.'">
        				</div>';

        $this->sHTML .= '<span class = "error">'.$sError.'</span>';
	}


	public function addError($sInputName, $sMessage){

		$this->aErrors[$sInputName] = $sMessage;
	}
}

 ?>