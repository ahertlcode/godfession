<?php
  class mydbs {
    private $servername 	   = "localhost";
    private $username   	   = "root";
    private $password   	   = "aherceo2$";//Please the db password
    private $dbname     	   = "godfessi_godfessions";
    private $conn;

    public $tableName   	   = "";
    public $fieldSel    	   = "";
    public $limitOffset 	   = "";
    public $returnDebug 	   = "";
    public $oneEqualOne 	   = "";
    public $condtionArr 	   = array();
    private $sqlQry     	   = "";
    public $orderby			     = "";
    public $orderprecedence	 = "";

    public function __constructor() {}

    private function do_conn() {
      try {
        //Do connections
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        $this->errorLogg($e->getLine(), $e->getFile(), $e->getMessage());
      }
    }

    private function desc_table($tablename) {
      $this->do_conn();
      try {
        if ($tablename != "") {
          $stmt       = $this->conn->prepare("DESCRIBE $tablename ");
          $stmt->execute();
          $each_rec   = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $each_rec;
        }
      } catch(Exception $e) {
        $this->errorLogg($e->getLine(), $e->getFile(), $e->getMessage());
      }
    }

    public function show_dbTables($tablename) {
      $this->do_conn();
      try {
        if ($tablename != "") {
          $stmt       = $this->conn->prepare("SHOW TABLES FROM $tablename");
          $stmt->execute();
          $each_rec   = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $each_rec;
        }
      } catch(Exception $e) {
        $this->errorLogg($e->getLine(), $e->getFile(), $e->getMessage());
      }
    }

    public function tableDesc($tablename) {
      return $this->desc_table($tablename);
    }

    public function arraylog($title, $arrayname) {
      if (!empty($arrayname)) {
        echo " <pre> $title<br>";
        print_r($arrayname);
        echo " </pre><br>";
      } else {
        echo "<br />$title<br />";
      }
    }

    //PRIMARY, UNIQUE AND INDEX KEY
    private function tabKeys($tabArr, $kyType='') {
      try {
        $priKey = "";
        if ($kyType == "") $kyType = "PRI";
        $cnt = 0;
        foreach ($tabArr as $cols) {
          if ($cols['Key'] == "$kyType") {
            if ($cnt == 0) $priKey = $cols['Field'];
            if ($cnt > 0)  $priKey = ",".$cols['Field'];
          }
          $cnt++;
        }
        return $priKey;
      } catch(Exception $e) {
        $this->errorLogg($e->getLine(), $e->getFile(), $e->getMessage());
      }
    }

    //RECORD INSERT
    public function in_rec_arr($inn_arr=array(),$tablename='') {
      $this->do_conn();
      try {
        $tab_desc = array();
        if (!empty($inn_arr)) {
          $tab_desc = ($tablename != "") ? $this->desc_table($tablename) : array();
          if (!empty($tab_desc)) {
            $Qry = " INSERT INTO $tablename (";
            $rt  = 0;
            foreach ($inn_arr as $ky=>$each_elm) {
              if ($rt === 0) $Qry .= "$ky";
              if ($rt !== 0) $Qry .= ", $ky";
              $rt++;
            }
            $Qry .= ") VALUES (";
            $tr = 0;
            foreach ($inn_arr as $ky=>$each_elm) {
              if ($tr === 0) $Qry .= ":$ky";
              if ($tr !== 0) $Qry .= ", :$ky";
              $tr++;
            }
            $Qry .= ")";

            $stmt = $this->conn->prepare($Qry);
            $pt   = 0;
            foreach ($inn_arr as $ky=>$each_elm) {
              $stmt->bindValue(":$ky", $each_elm);
            }

            $act_reslt  = $stmt->execute();
            return $act_reslt;
            $this->conn = null;
          }
        }
      } catch(Exception $e) {
        $this->errorLogg($e->getLine(), $e->getFile(), $e->getMessage());
      }
    }

    //RECORD UPDATE
    public function upd_rec_arr($inn_arr=array(),$tablename='',$otherCond=array()) {
      $this->do_conn();
      try {
        if (!empty($inn_arr)) {
          $tab_desc = ($tablename != "") ? $this->desc_table($tablename) : array();
          if (!empty($tab_desc)) {
            $Qry        = " UPDATE $tablename SET ";
            $rt         = 0;
            foreach ($inn_arr as $ky=>$each_elm) {
              if ($rt === 0) $Qry .= " $ky = '$each_elm' ";
              if ($rt !== 0) $Qry .= " , $ky = '$each_elm' ";
              $rt++;
            }

            $priKey     = "";
            $priValue   = "";
            $priKey     = $this->tabKeys($tab_desc,'PRI');
            foreach ($inn_arr as $ky=>$each_elm) {
              if ($ky == $priKey) {
                  $priValue = $each_elm;
              }
            }

            $condParam[] =  $priValue;
            $Qry        .= " WHERE $priKey = ? ";
            if (!empty($otherCond)) {
              foreach ($otherCond as $ck=>$otherC) {
                 $Qry .= " AND $ck = ? ";
                 $condParam[] = $otherC;
              }
            }

            $stmt       = $this->conn->prepare($Qry);
            $act_reslt  = $stmt->execute($condParam);
            return $act_reslt;
            $this->conn = null;
          }
        }
      } catch(Exception $e) {
        $this->errorLogg($e->getLine(), $e->getFile(), $e->getMessage());
      }
    }

    //RECORD SELECTION
    //NOTE : ERROR HAS NOT BEEN HANDLED ON THIS METHOD
    //PROVISION SHOULD BE MADE FOR CUSTUM QUERY TO RUN WITH HASSLE
    function fetchRecs($paramArr=array()) {
      $this->do_conn();
      try {
        if (!empty($paramArr)) {
          //IN PARAMETERS RESOLVES HERE
          $this->tableName   		= ((isset($paramArr['tableName']))   		&& ($paramArr['tableName'] != ""))   	?   $paramArr['tableName']  	: "";
          $this->fieldSel    		= ((isset($paramArr['fldsel']))      		&& ($paramArr['fldsel'] != ""))      	?   $paramArr['fldsel']  		: "*";
          $this->limitOffset 		= ((isset($paramArr['limitOffset'])) 		&& ($paramArr['limitOffset'] != "")) 	?	$paramArr['limitOffset']  	: "";
          $this->returnDebug 		= ((isset($paramArr['returnDebug'])) 		&& ($paramArr['returnDebug'] != "")) 	? 	$paramArr['returnDebug']  	: "";
          $this->oneEqualOne 		= ((isset($paramArr['oneEqualsOne']))		&& ($paramArr['oneEqualsOne'] == true))? 	" (1=1) "               	: "";
          $this->condtionArr 		= ((isset($paramArr['conditionarr']))		&& ($paramArr['conditionarr'] != ""))	?	$paramArr['conditionarr']  	: array();
          $this->orderby 			  = ((isset($paramArr['orderby']))	 		  && ($paramArr['orderby'] != ""))		  ?	$paramArr['orderby']  		: "";
          $this->orderprecedence= ((isset($paramArr['orderprecedence']))&& ($paramArr['orderprecedence'] != ""))?	$paramArr['orderprecedence']: "";
          if ($this->tableName != "") {
            $this->sqlQry =  "SELECT $this->fieldSel FROM $this->tableName WHERE $this->oneEqualOne ";
            if (!empty($this->condtionArr)) {
              //OUTER ARRAY COUNTER INITIALISED HERE
              $icnt = 0;
              //QUERY PARAMETER/VALUE ARRAY TO BIND INITIALISED
              $param2bind = array();

              foreach ($this->condtionArr as $ky=>$valu) {
                if ($valu == "") {
                  $this->sqlQry .= "";
                } else {
                  $spltky = explode("%",$ky);
                  $ky     = $spltky[1];
                  if ($this->oneEqualOne != "" || $icnt != 0) $this->sqlQry .= " $ky ";//
                  $this->sqlQry .= ($this->oneEqualOne != "") ? " ( " : " ";
                  if ($this->oneEqualOne == "") $this->sqlQry .= " ( ";
                  $jcnt = 0;
                  foreach ($valu as $kt=>$valt) {
                    $splky= explode("=>",$kt);
                    if ( count($splky) == 1 ) {
                      $this->sqlQry .= " $kt = ?";
                      $param2bind[] = $valt;
                    } elseif (count($splky) > 1) {
                      $nwcond = $splky[0];
                      $nwkey  = $splky[1];
                      if ($jcnt == 0) {
                        $this->sqlQry .= " $nwkey = ? ";
                      } elseif ($jcnt > 0) {
                        $this->sqlQry .= " $nwcond $nwkey = ? ";
                      }
                      $param2bind[] = $valt;
                    }
                    $jcnt++;
                  }
                  $this->sqlQry .= " ) ";
                  $icnt++;
                }
              }

              //LIMIT AND OFFSET START HERE
              $limit = "";
              $offset= "";
              if ($this->limitOffset != "") {
                $offLim = explode(",", $this->limitOffset);
                $limit = (isset($offLim[0])) ? $offLim[0] : "";
                $offset= (isset($offLim[1])) ? $offLim[1] : "";
              }
              $limitQry   = ($limit != "")  ? " LIMIT $limit "    : "";
              $ffsetQry   = ($offset != "") ? " OFFSET $offset "  : "";
              $this->sqlQry .= $limitQry;
              $this->sqlQry .= $ffsetQry;
              //LIMIT AND OFFSET END HERE

              if ($this->orderby != "") 			$this->sqlQry .= " ORDER BY $this->orderby ";
              if ($this->orderprecedence != "") 	$this->sqlQry .= " $this->orderprecedence ";

              if ($this->returnDebug != "") {
                if ($this->returnDebug == "sQl") {
                  echo $this->sqlQry;
                } elseif ($this->returnDebug == "inValues") {
                  $this->arraylog("inValues",$param2bind);
                } elseif ($this->returnDebug == "ALL") {
                  echo $this->sqlQry."<br />";
                  $this->arraylog("inValues",$param2bind);
                } else {

                }
              }
              //PREPARING
              $stmt       = $this->conn->prepare($this->sqlQry);
              $Qres       = $stmt->execute($param2bind);
              $result     = ($Qres) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : array();
              return $result;
              $this->conn = null;
            }
          }
        }
      } catch(Exception $e) {
        $this->errorLogg($e->getLine(), $e->getFile(), $e->getMessage());
      }
    }


    //RECORD SELECTION
    //NOTE : ERROR HAS NOT BEEN HANDLED ON THIS METHOD
    //PROVISION SHOULD BE MADE FOR CUSTUM QUERY TO RUN WITH HASSLE
    function fetchRecs2($paramArr=array()) {
      $this->do_conn();
      try {
        if (!empty($paramArr)) {
          //IN PARAMETERS RESOLVES HERE
          $this->tableName   		= ((isset($paramArr['tableName']))   		&& ($paramArr['tableName'] != ""))   	?   $paramArr['tableName']  	: "";
          $this->fieldSel    		= ((isset($paramArr['fldsel']))      		&& ($paramArr['fldsel'] != ""))      	?   $paramArr['fldsel']  		: "*";
          $this->limitOffset 		= ((isset($paramArr['limitOffset'])) 		&& ($paramArr['limitOffset'] != "")) 	?	$paramArr['limitOffset']  	: "";
          $this->returnDebug 		= ((isset($paramArr['returnDebug'])) 		&& ($paramArr['returnDebug'] != "")) 	? 	$paramArr['returnDebug']  	: "";
          $this->oneEqualOne 		= ((isset($paramArr['oneEqualsOne']))		&& ($paramArr['oneEqualsOne'] == true))? 	" (1=1) "               	: "";
          $this->condtionArr 		= ((isset($paramArr['conditionarr']))		&& ($paramArr['conditionarr'] != ""))	?	$paramArr['conditionarr']  	: array();
          $this->orderby 			  = ((isset($paramArr['orderby']))	 		  && ($paramArr['orderby'] != ""))		  ?	$paramArr['orderby']  		: "";
          $this->orderprecedence= ((isset($paramArr['orderprecedence']))&& ($paramArr['orderprecedence'] != ""))?	$paramArr['orderprecedence']: "";
          if ($this->tableName != "") {
            $this->sqlQry =  "SELECT $this->fieldSel FROM $this->tableName WHERE $this->oneEqualOne ";
            if (!empty($this->condtionArr)) {

              //OUTER ARRAY COUNTER INITIALISED HERE
              $icnt = 0;
              //QUERY PARAMETER/VALUE ARRAY TO BIND INITIALISED
              $param2bind = array();

              foreach ($this->condtionArr as $ky=>$valu) {
                if ($valu == "") {
                  $this->sqlQry .= "";
                } else {
                  $spltky = explode("%",$ky);
                  $ky     = $spltky[1];
                  if ($this->oneEqualOne != "" || $icnt != 0) $this->sqlQry .= " $ky ";//
                  $this->sqlQry .= ($this->oneEqualOne != "") ? " ( " : " ";
                  if ($this->oneEqualOne == "") $this->sqlQry .= " ( ";
                  $jcnt = 0;
                  foreach ($valu as $kt=>$valt) {
                    $splky  = explode("=>",$kt);
                    $spval  = explode("~",$valt);
                    $op     = $spval[0];
                    $sval   = $spval[1];
                    $opvalsplt = explode("^",$sval);
                    if ( count($splky) == 1 ) {
                      if ($op == "IN") {
                        $this->sqlQry .= " $kt $op (".str_pad('',count($opvalsplt)*2-1,'?,').") ";
                      } elseif ($op == "%LIKE%") {
                        if ($op == "%LIKE%") $dop = "LIKE";
                        $this->sqlQry .= " $kt $dop ? ";
                      } else {
                        $this->sqlQry .= " $kt $op ? ";
                      }
                    } elseif (count($splky) > 1) {
                      $nwcond = $splky[0];
                      $nwkey  = $splky[1];
                      if ($jcnt == 0) {
                        if ($op == "IN") {
                          $this->sqlQry .= " $nwkey $op (".str_pad('',count($opvalsplt)*2-1,'?,').") ";
                        } elseif ($op == "%LIKE%") {
                          if ($op == "%LIKE%") $dop = "LIKE";
                          $this->sqlQry .= " $nwkey $dop ? ";
                        } else {
                          $this->sqlQry .= " $nwkey $op ? ";
                        }
                      } elseif ($jcnt > 0) {
                        if ($op == "IN") {
                          $this->sqlQry .= " $nwcond $nwkey $op (".str_pad('',count($opvalsplt)*2-1,'?,').") ";
                        } elseif ($op == "%LIKE%") {
                          if ($op == "%LIKE%") $dop = "LIKE";
                          $this->sqlQry .= " $nwcond $nwkey $dop ? ";
                        } else {
                          $this->sqlQry .= " $nwcond $nwkey $op ? ";
                        }
                      }
                    }

                    if ($op == "%LIKE%") {
                      $param2bind[] = "%$sval%";
                    } elseif($op == "IN") {
                      for($t=0; $t<count($opvalsplt); $t+=1) {
                        $param2bind[] = $opvalsplt[$t];
                      }
                    } else {
                      $param2bind[] = $sval;
                    }
                    $jcnt++;
                  }
                  $this->sqlQry .= " ) ";
                  $icnt++;
                }
              }

              //LIMIT AND OFFSET START HERE
              $limit = "";
              $offset= "";
              if ($this->limitOffset != "") {
                $offLim = explode(",", $this->limitOffset);
                $limit = (isset($offLim[0])) ? $offLim[0] : "";
                $offset= (isset($offLim[1])) ? $offLim[1] : "";
              }
              $limitQry   = ($limit != "")  ? " LIMIT $limit "    : "";
              $ffsetQry   = ($offset != "") ? " OFFSET $offset "  : "";
              $this->sqlQry .= $limitQry;
              $this->sqlQry .= $ffsetQry;
              //LIMIT AND OFFSET END HERE

              if ($this->orderby != "") 			$this->sqlQry .= " ORDER BY $this->orderby ";
              if ($this->orderprecedence != "") 	$this->sqlQry .= " $this->orderprecedence ";

              if ($this->returnDebug != "") {
                if ($this->returnDebug == "sQl") {
                    echo $this->sqlQry;
                } elseif ($this->returnDebug == "inValues") {
                    $this->arraylog("inValues",$param2bind);
                } elseif ($this->returnDebug == "ALL") {
                    echo $this->sqlQry."<br />";
                    $this->arraylog("inValues",$param2bind);
                } else {

                }
              }

              //PREPARING
              $stmt       = $this->conn->prepare($this->sqlQry);
              $Qres       = $stmt->execute($param2bind);
              $result     = ($Qres) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : array();
              return $result;
              $this->conn = null;
            }
          }
        }
      } catch(Exception $e) {
        $this->errorLogg($e->getLine(), $e->getFile(), $e->getMessage());
      }
    }

    //RECORD UPDATE
    public function delete_rec($inn_arr=array(),$tablename='') {
      $this->do_conn();
      try {
        if (!empty($inn_arr)) {
          $tab_desc = ($tablename != "") ? $this->desc_table($tablename) : array();
          $this->returnDebug = ((isset($inn_arr['returnDebug'])) && ($inn_arr['returnDebug'] != "")) ? $inn_arr['returnDebug'] : "";
          if (!empty($tab_desc)) {
            $Qry        = " DELETE FROM $tablename WHERE ";
            $priKey     = ""; $priValue   = "";
            $priKey     = $this->tabKeys($tab_desc,'PRI');

            foreach ($inn_arr as $ky=>$each_elm) {
              if ($ky != "returnDebug") {
                if ($ky == $priKey) {
                  $priValue = $each_elm;
                }
              }
            }
            $condParam[] =  $priValue;
            $Qry        .= " $priKey = ? ";

            $rt = 0;
            foreach ($inn_arr as $ky=>$each_elm) {
              if ($ky != "returnDebug") {
                if ($ky != $priKey) {
                  if ($priKey == "" && $rt == 0) $Qry .= " $ky = ? ";
                  if ($priKey == "" && $rt > 0)  $Qry .= " AND $ky = ? ";
                  if ($priKey != "") $Qry .= " AND $ky = ? ";
                  $condParam[] = $each_elm;
                }
                $rt++;
              }
            }

            if ($this->returnDebug != "") {
              if ($this->returnDebug == "sQl") {
                echo $Qry;
              } elseif ($this->returnDebug == "inValues") {
                $this->arraylog("inValues",$condParam);
              } elseif ($this->returnDebug == "ALL") {
                echo $Qry."<br />";
                $this->arraylog("inValues",$condParam);
              } else {
                #...
              }
            }

            $stmt       = $this->conn->prepare($Qry);
            $act_reslt  = $stmt->execute($condParam);
            return $act_reslt;
            $this->conn = null;
          }
        }
      } catch(Exception $e) {
        $this->errorLogg($e->getLine(), $e->getFile(), $e->getMessage());
      }
    }

    //ERROR LOG
    public function errorLogg($line_no="", $errror_file="", $errmsg="") {
      try {
        $errorMsg   = 'Error on line '.$line_no.' in '.$errror_file.' : '.$errmsg.'\n';
        $myfile     = fopen("./Error/Errorlog.txt", "a");
        fwrite($myfile, $errorMsg);
        fclose($myfile);
      } catch(Exception $e) {
        $this->errorLogg($e->getLine(), $e->getFile(), $e->getMessage());
      }
    }
  }
?>
