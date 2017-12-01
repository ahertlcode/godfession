<?php
class libraries {
	//Properties
	private $input2val = array();
	private $valtype;
	private $valoutput;
	
	//Constructor
	
	public function __construct() {
		
	}
	
	public function validateInputs($input=array(), $type="") {
		$this->input2val 	= $input;
		$this->valtype 		= $type;
		$this->valoutput 	= (isset($this->input2val) 	&& ($this->input2val != "") && ($this->input2val != '[object Object]')) ? trim($this->input2val) : "";
		return $this->valoutput;
	}
}
?>