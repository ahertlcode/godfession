<?php
	/** 
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of db
	 *
	 * @author abayomi
	 */

	/*Define Constant to old DB Parameters*/
	class db extends mysqli
	{
		//DB Properties
		/*Set $dbhost to the mysql server IP or localhost*/
		private $dbhost 		= "localhost";

		/*Set $dbname to the database/schema name*/
		private $dbname 		= "godfessi_godfessions";

		/*Set $dbuser to the database user name*/
		private $dbuser 		= "root";

		/*Set $dbpass to the database password */
		private $dbpass 	    = "aherceo2$";

		private $connerror 	= "Database Connection Fail";
		private $conn;
		public 	$inQuery;
		private $outcome;
		private $tableRow 	= array();
		private $tableAssoc = array();
		private $erno;
		private $errmsg;
		private $low;

		//Connect to MySQL
		public function _construct()
		{
		}

		private function makeCon()
		{
			if(!($this->conn = new mysqli($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname)))
			{
				$this->erno = mysqli_connect_errno();
				$this->errmsg = mysqli_connect_error();
				$this->logError();
				return $this->connerror;
			}
			return $this->conn;
		}

		public function executeQuery($q)
		{
			$dbcon = $this->makeCon();
			$this->inQuery = $q;
			$this->outcome = $dbcon->query($this->inQuery);
			if(!$this->outcome)
			{
				$this->erno = $dbcon->errno;
				$this->errmsg = $dbcon->error;
				$this->logError();
				return 0;
			}
			$dbcon->close();
			return $this->outcome;
		}

		public function getRows($q)
		{
			$dbh = $this->makeCon();
			$this->tableRow = (array) null;
			$this->inQuery = $q;
			$this->outcome = $dbh->query($this->inQuery);
			if(!$this->outcome)
			{
				$this->erno = $dbh->errno;
				$this->errmsg = $dbh->error;
				$this->logError();
				return 0;
			}
			while($this->low = $this->outcome->fetch_row())
			{
				$this->tableRow[] = $this->low;
			}
			$dbh->close();
			return $this->tableRow;
		}

		public function getRowAssoc($q)
		{
			$dh = $this->makeCon();
			$this->tableAssoc = (array) null;
			$this->inQuery = $q;
			$this->outcome = $dh->query($this->inQuery);
			if(!$this->outcome)
			{
				$this->erno = $dh->errno;
				$this->errmsg = $dh->error;
				$this->logError();
				return 0;
			}
			while($this->low = $this->outcome->fetch_assoc())
			{
				$this->tableAssoc[] = $this->low;
			}
			$dh->close();
			return $this->tableAssoc;
		}

		private function doSelectQuery($tb,$rows = null){
			if($rows == null){
				$q = "select * from {$tb}";
			}else{
				$cols = explode(",",$rows);
				$vs = sizeof($cols);
				$track = 0;
				$q = "select ";
				for($t=0;$t<sizeof($cols);$t++){
					$track += 1;
					if($track != $vs){
					$q .= $cols[$t].",";
				}else{
					$q .= $cols[$t];
				}
				}
				$q .= " from {$tb}";
			}
			return $q;
		}

		public function getdata($tablename,$rows = null,$mode){
			$data = Array();
			if($rows == null){
				$q = $this->doSelectQuery($tablename);
			}else{
				$q = $this->doSelectQuery($tablename,$rows);
			}
			$this->inQuery = $q;
			if($mode == "ASSOC"){
				$data = $this->getRowAssoc($this->inQuery);
			}else if($mode == "NUMBERED"){
				$data = $this->getRows($this->inQuery);
			}
			return $data;
		}

		public function putdata($tablename,$options,$mode,$ordered)
		{
			if($mode == "ALL" && $ordered){
				$q = $this->doInsertQuery($tablename,$options,"ordered");
		}else if($mode == "ALL" && !$ordered){
				$q = $this->doInsertQuery($tablename,$options,"unordered");
		}else if($mode == "SELECTED"){
				$q = $this->doInsertQuery($tablename,$options,"unordered");
		}else{
				$q = $this->doInsertQuery($tablename,$options);
		}
		$this->inQuery = $q;
		if(!$this->executeQuery($this->inQuery)){
			$msg = array("status"=>"Failed","message"=>"Data could not be saved.");
		}else{
			$msg = array("status"=>"success","message"=>"Data saved Successfully!");
		}
		return $msg;
		}

		private function doInsertQuery($tab,$opts,$stat=null)
		{
			$cols = $opts;
			$track = 0;
			$len = sizeof($cols);
			//return $cols;
		  switch ($stat) {
		  	case 'ordered':
					$q = "insert into {$tab} values(";
					foreach($cols as $key=>$val){
						$track += 1;
						if($track != $len){
						$q .= "'".$val."',";
					}else{
						$q .= "'".$val."'";
					}
				}
					$q .= ")";
					return $q;
		  		break;
		  	case 'unordered':
				$q = "insert into {$tab}(";
				//foreach($cols as $valx){
					foreach($cols as $key=>$val){
						$track += 1;
						if($track != $len){
							$q .= $key.",";
						}else{
							$q .= $key.")";
						}
					}
				//}
				$q .=" values(";
				   $track = 0;
					foreach ($cols as $key => $val){
						$track += 1;
						if($track != $len){
							$q .= "'".$val."',";
						}else{
							$q .= "'".$val."'";
						}
					}
				//}
				$q .= ")";
				return $q;
				break;
		  	default:
				$q = "insert into {$tab} values(";
				//foreach($cols as $valx){
				foreach($cols as $key=>$val){
					$track += 1;
					if($track != $len){
					$q .= "'".$val."',";
				}else{
					$q .= "'".$val."'";
				}
			}//}
				$q .= ")";
				return $q;
		  		break;
		  }
		}
		public function logError($ErrorObj = null)
		{
		    $fp = fopen("Error/ErrorLog.txt","a+");
		    if($ErrorObj !== null){
		        $msg = date("Y-m-d H:s i").": ".$ErrorObj;
		        fwrite($fp,$msg);
                fclose($fp);
		    }else{
			    $msg = date("Y-m-d H:s i")." : "."Database Error No: ".$this->erno." - "."Error Information: ".$this->errmsg."\n";
			    fwrite($fp,$msg);
			    fclose($fp);
			}
			return 1;
		}

	}
