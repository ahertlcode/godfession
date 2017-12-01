<?php

  include_once('godfessi_godfessions_baseClass.php');
  class proc_states_cls extends godfessi_godfessions_baseClass {

    //Properties 
    private $id = "";
    private $status = "";
    private $country_id = "";
    private $name = "";
    private $Code = "";
    private $abbrev_name = "";
    private $ADM1Code = "";
    
    //Save Routine Validation Flags 
    private $validateid = false;
    private $validatestatus = false;
    private $validatecountry_id = false;
    private $validatename = false;
    private $validateCode = false;
    private $validateabbrev_name = false;
    private $validateADM1Code = false;
    
    //Other Controls 
    private $procarr     = array();
    private $proc        = true;
    private $mainDBtable = "states";
    private $statMsg     = "";
    private $returnArr   = array();
    private $datamethod  = "";
    private $datakls     = "";
    private $actualact   = "";

    public function __construct($inparams=array()) {
      if (!empty($inparams)) {
        if (isset($inparams['states_id']) && ($inparams['states_id'] != "")) $this->procarr['id'] = $this->id =  $inparams['states_id'];
        if (isset($inparams['status']) && ($inparams['status'] != "")) $this->procarr['status'] = $this->status =  $inparams['status'];
        if (isset($inparams['country_id']) && ($inparams['country_id'] != "")) $this->procarr['country_id'] = $this->country_id =  $inparams['country_id'];
        if (isset($inparams['name']) && ($inparams['name'] != "")) $this->procarr['name'] = $this->name =  $inparams['name'];
        if (isset($inparams['Code']) && ($inparams['Code'] != "")) $this->procarr['Code'] = $this->Code =  $inparams['Code'];
        if (isset($inparams['abbrev_name']) && ($inparams['abbrev_name'] != "")) $this->procarr['abbrev_name'] = $this->abbrev_name =  $inparams['abbrev_name'];
        if (isset($inparams['ADM1Code']) && ($inparams['ADM1Code'] != "")) $this->procarr['ADM1Code'] = $this->ADM1Code =  $inparams['ADM1Code'];

        if (isset($inparams['datamethod']))   $this->datamethod  =  $inparams['datamethod'];
        if (isset($inparams['datakls']))      $this->datakls     =  $inparams['datakls'];
        if (isset($inparams['actualact']))    $this->actualact   =  $inparams['actualact'];
      }
    }

      public function save_states() {
        if($this->id == "") return dosave_states();
        if($this->id != "") return doupdate_states();
      }

      public function dosave_states() {
        //Save Input Validations
        if (($this->proc == true) && ($this->validateid == true) && ($this->id == "")) {
          $this->proc    = false;
          $this->statMsg = "id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatestatus == true) && ($this->status == "")) {
          $this->proc    = false;
          $this->statMsg = "status can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecountry_id == true) && ($this->country_id == "")) {
          $this->proc    = false;
          $this->statMsg = "country_id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatename == true) && ($this->name == "")) {
          $this->proc    = false;
          $this->statMsg = "name can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateCode == true) && ($this->Code == "")) {
          $this->proc    = false;
          $this->statMsg = "Code can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateabbrev_name == true) && ($this->abbrev_name == "")) {
          $this->proc    = false;
          $this->statMsg = "abbrev_name can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateADM1Code == true) && ($this->ADM1Code == "")) {
          $this->proc    = false;
          $this->statMsg = "ADM1Code can not be empty, pls correct to continue.";
        }

    
        if($this->proc == true) {
          $actionres = $this->in_rec_arr($this->innarr,$this->mainDBtable);
          if ($actionres) {
            $this->returnArr['stat_flag']  = 1;
            $this->returnArr['stat_msg']   = "Action Successful";
            $this->returnArr['datamethod'] = $this->datamethod;
            $this->returnArr['actualact']  = $this->actualact;
          } else {
            $this->returnArr['stat_flag']  = 0;
            $this->returnArr['stat_msg']   = "Action Failed";
            $this->returnArr['datamethod'] = $this->datamethod;
            $this->returnArr['actualact']  = $this->actualact;
          }
        } else {
          $this->returnArr['stat_flag']  = 0;
          $this->returnArr['stat_msg']   = $this->statMsg;
          $this->returnArr['datamethod'] = $this->datamethod;
          $this->returnArr['actualact']  = $this->actualact;
        }
        return $this->returnArr;
      }

      public function doupdate_states() {
        if($this->proc == true) {
          $actionres = $this->upd_rec_arr($this->innarr,$this->mainDBtable);
          if ($actionres) {
            $this->returnArr['stat_flag']  = 1;
            $this->returnArr['stat_msg']   = "Successfully Updated!";
            $this->returnArr['datamethod'] = $this->datamethod;
            $this->returnArr['actualact']  = $this->actualact;
          } else {
            $this->returnArr['stat_flag']  = 0;
            $this->returnArr['stat_msg']   = "Update Failed";
            $this->returnArr['datamethod'] = $this->datamethod;
            $this->returnArr['actualact']  = $this->actualact;
          }
        } else {
          $this->returnArr['stat_flag']  = 0;
          $this->returnArr['stat_msg']   = $this->statMsg;
          $this->returnArr['datamethod'] = $this->datamethod;
          $this->returnArr['actualact']  = $this->actualact;
        }
        return $this->returnArr;
      }

      public function get_states() {
        $getParam = array();
        //NOTE : The = before ~ can be <>, NOT IN, LIKE, IN etc;
        //NOTE : e.g $getParam['AND=>columnname'] = "IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "NOT IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "<>~''"; columnname not = empty
        //NOTE : e.g $getParam['AND=>columnname'] = "!=~''"; columnname not = empty
        if ($this->id != "") $getParam['AND=>id'] = "=~$this->id";
        if ($this->status != "") $getParam['AND=>status'] = "=~$this->status";
        if ($this->country_id != "") $getParam['AND=>country_id'] = "=~$this->country_id";
        if ($this->name != "") $getParam['AND=>name'] = "=~$this->name";
        if ($this->Code != "") $getParam['AND=>Code'] = "=~$this->Code";
        if ($this->abbrev_name != "") $getParam['AND=>abbrev_name'] = "=~$this->abbrev_name";
        if ($this->ADM1Code != "") $getParam['AND=>ADM1Code'] = "=~$this->ADM1Code";
    
        $arr['1%AND'] = (!empty($getParam)) ? $getParam : "";

        $allin['conditionarr'] = $arr;
        $allin['tableName']    = $this->mainDBtable;
        $allin['fldsel']       = "";
        $allin['limitOffset']  = "";
        $allin['returnDebug']  = ""; //"sQl" or "returnArray" or "inValues" or "ALL"
        $allin['oneEqualsOne'] = true;
        $reton   = $this->fetchRecs2($allin);

        if ($this->actualact == "getdrops") {
           $this->returnArr[0]['value']  =  "";
           $this->returnArr[0]['desc']   =  "Select Option";

          if (!empty($reton)) {
            $j = 1;
            foreach ($reton as $reta) {
              $this->returnArr[$j]['value']    =   "OPT";//$reta[''];
              $this->returnArr[$j]['desc']     =   "Option";//$reta[''];
              $j+=1;
            }
          }
        } else if($this->actualact == "getLists") {
          $j=0;
          foreach ($reton as $reta) {
            $this->returnArr[$j]['states_id'] = $reta['id'];
            $this->returnArr[$j]['status'] = $reta['status'];
            $this->returnArr[$j]['country_id'] = $reta['country_id'];
            $this->returnArr[$j]['name'] = $reta['name'];
            $this->returnArr[$j]['Code'] = $reta['Code'];
            $this->returnArr[$j]['abbrev_name'] = $reta['abbrev_name'];
            $this->returnArr[$j]['ADM1Code'] = $reta['ADM1Code'];
            $j+=1;
          }
        } else if($this->actualact == "getSingle") {
            $this->returnArr[0]['states_id'] = $reton[0]['id'];
            $this->returnArr[0]['status'] = $reton[0]['status'];
            $this->returnArr[0]['country_id'] = $reton[0]['country_id'];
            $this->returnArr[0]['name'] = $reton[0]['name'];
            $this->returnArr[0]['Code'] = $reton[0]['Code'];
            $this->returnArr[0]['abbrev_name'] = $reton[0]['abbrev_name'];
            $this->returnArr[0]['ADM1Code'] = $reton[0]['ADM1Code'];
        }

        if (!empty($reton)) {
          $this->returnArr['stat_flag']     =   1;
          $this->returnArr['stat_msg']      =   "Success";
          $this->returnArr['datamethod']    =   $this->datamethod;
          $this->returnArr['actualact']     =   $this->actualact;
        } else {
          $this->returnArr['stat_flag']     =   0;
          $this->returnArr['stat_msg']      =   "Action failed, pls try again";
          $this->returnArr['datamethod']    =   $this->datamethod;
          $this->returnArr['actualact']     =   $this->actualact;
        }
        return $this->returnArr;
      }

      public function delete_states() {
        if($this->proc == true) {
          $actionres = $this->delete_rec($this->innarr,$this->mainDBtable);
          if ($actionres) {
            $this->returnArr['stat_flag']  = 1;
            $this->returnArr['stat_msg']   = "Successfully Deleted!";
            $this->returnArr['datamethod'] = $this->datamethod;
            $this->returnArr['actualact']  = $this->actualact;
          } else {
            $this->returnArr['stat_flag']  = 0;
            $this->returnArr['stat_msg']   = "Deletion Failed";
            $this->returnArr['datamethod'] = $this->datamethod;
            $this->returnArr['actualact']  = $this->actualact;
          }
        } else {
          $this->returnArr['stat_flag']  = 0;
          $this->returnArr['stat_msg']   = "Deletion Failed";
          $this->returnArr['datamethod'] = $this->datamethod;
          $this->returnArr['actualact']  = $this->actualact;
        }
        return $this->returnArr;
      }

  }

