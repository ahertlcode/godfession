<?php

  include_once('godfessi_godfessions_baseClass.php');
  class proc_chlanguages_cls extends godfessi_godfessions_baseClass {

    //Properties 
    private $id = "";
    private $user_id = "";
    private $language_id = "";
    private $creditcard_number = "";
    private $expDateMonth = "";
    private $expDateYear = "";
    private $cvvNumber = "";
    private $card_type = "";
    private $status = "";
    private $is_deleted = "";
    private $created = "";
    private $modified = "";
    
    //Save Routine Validation Flags 
    private $validateid = false;
    private $validateuser_id = false;
    private $validatelanguage_id = false;
    private $validatecreditcard_number = false;
    private $validateexpDateMonth = false;
    private $validateexpDateYear = false;
    private $validatecvvNumber = false;
    private $validatecard_type = false;
    private $validatestatus = false;
    private $validateis_deleted = false;
    private $validatecreated = false;
    private $validatemodified = false;
    
    //Other Controls 
    private $procarr     = array();
    private $proc        = true;
    private $mainDBtable = "chlanguages";
    private $statMsg     = "";
    private $returnArr   = array();
    private $datamethod  = "";
    private $datakls     = "";
    private $actualact   = "";

    public function __construct($inparams=array()) {
      if (!empty($inparams)) {
        if (isset($inparams['chlanguages_id']) && ($inparams['chlanguages_id'] != "")) $this->procarr['id'] = $this->id =  $inparams['chlanguages_id'];
        if (isset($inparams['user_id']) && ($inparams['user_id'] != "")) $this->procarr['user_id'] = $this->user_id =  $inparams['user_id'];
        if (isset($inparams['language_id']) && ($inparams['language_id'] != "")) $this->procarr['language_id'] = $this->language_id =  $inparams['language_id'];
        if (isset($inparams['creditcard_number']) && ($inparams['creditcard_number'] != "")) $this->procarr['creditcard_number'] = $this->creditcard_number =  $inparams['creditcard_number'];
        if (isset($inparams['expDateMonth']) && ($inparams['expDateMonth'] != "")) $this->procarr['expDateMonth'] = $this->expDateMonth =  $inparams['expDateMonth'];
        if (isset($inparams['expDateYear']) && ($inparams['expDateYear'] != "")) $this->procarr['expDateYear'] = $this->expDateYear =  $inparams['expDateYear'];
        if (isset($inparams['cvvNumber']) && ($inparams['cvvNumber'] != "")) $this->procarr['cvvNumber'] = $this->cvvNumber =  $inparams['cvvNumber'];
        if (isset($inparams['card_type']) && ($inparams['card_type'] != "")) $this->procarr['card_type'] = $this->card_type =  $inparams['card_type'];
        if (isset($inparams['status']) && ($inparams['status'] != "")) $this->procarr['status'] = $this->status =  $inparams['status'];
        if (isset($inparams['is_deleted']) && ($inparams['is_deleted'] != "")) $this->procarr['is_deleted'] = $this->is_deleted =  $inparams['is_deleted'];
        if (isset($inparams['created']) && ($inparams['created'] != "")) $this->procarr['created'] = $this->created =  $inparams['created'];
        if (isset($inparams['modified']) && ($inparams['modified'] != "")) $this->procarr['modified'] = $this->modified =  $inparams['modified'];

        if (isset($inparams['datamethod']))   $this->datamethod  =  $inparams['datamethod'];
        if (isset($inparams['datakls']))      $this->datakls     =  $inparams['datakls'];
        if (isset($inparams['actualact']))    $this->actualact   =  $inparams['actualact'];
      }
    }

      public function save_chlanguages() {
        if($this->id == "") return dosave_chlanguages();
        if($this->id != "") return doupdate_chlanguages();
      }

      public function dosave_chlanguages() {
        //Save Input Validations
        if (($this->proc == true) && ($this->validateid == true) && ($this->id == "")) {
          $this->proc    = false;
          $this->statMsg = "id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateuser_id == true) && ($this->user_id == "")) {
          $this->proc    = false;
          $this->statMsg = "user_id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatelanguage_id == true) && ($this->language_id == "")) {
          $this->proc    = false;
          $this->statMsg = "language_id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecreditcard_number == true) && ($this->creditcard_number == "")) {
          $this->proc    = false;
          $this->statMsg = "creditcard_number can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateexpDateMonth == true) && ($this->expDateMonth == "")) {
          $this->proc    = false;
          $this->statMsg = "expDateMonth can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateexpDateYear == true) && ($this->expDateYear == "")) {
          $this->proc    = false;
          $this->statMsg = "expDateYear can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecvvNumber == true) && ($this->cvvNumber == "")) {
          $this->proc    = false;
          $this->statMsg = "cvvNumber can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecard_type == true) && ($this->card_type == "")) {
          $this->proc    = false;
          $this->statMsg = "card_type can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatestatus == true) && ($this->status == "")) {
          $this->proc    = false;
          $this->statMsg = "status can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateis_deleted == true) && ($this->is_deleted == "")) {
          $this->proc    = false;
          $this->statMsg = "is_deleted can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecreated == true) && ($this->created == "")) {
          $this->proc    = false;
          $this->statMsg = "created can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatemodified == true) && ($this->modified == "")) {
          $this->proc    = false;
          $this->statMsg = "modified can not be empty, pls correct to continue.";
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

      public function doupdate_chlanguages() {
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

      public function get_chlanguages() {
        $getParam = array();
        //NOTE : The = before ~ can be <>, NOT IN, LIKE, IN etc;
        //NOTE : e.g $getParam['AND=>columnname'] = "IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "NOT IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "<>~''"; columnname not = empty
        //NOTE : e.g $getParam['AND=>columnname'] = "!=~''"; columnname not = empty
        if ($this->id != "") $getParam['AND=>id'] = "=~$this->id";
        if ($this->user_id != "") $getParam['AND=>user_id'] = "=~$this->user_id";
        if ($this->language_id != "") $getParam['AND=>language_id'] = "=~$this->language_id";
        if ($this->creditcard_number != "") $getParam['AND=>creditcard_number'] = "=~$this->creditcard_number";
        if ($this->expDateMonth != "") $getParam['AND=>expDateMonth'] = "=~$this->expDateMonth";
        if ($this->expDateYear != "") $getParam['AND=>expDateYear'] = "=~$this->expDateYear";
        if ($this->cvvNumber != "") $getParam['AND=>cvvNumber'] = "=~$this->cvvNumber";
        if ($this->card_type != "") $getParam['AND=>card_type'] = "=~$this->card_type";
        if ($this->status != "") $getParam['AND=>status'] = "=~$this->status";
        if ($this->is_deleted != "") $getParam['AND=>is_deleted'] = "=~$this->is_deleted";
        if ($this->created != "") $getParam['AND=>created'] = "=~$this->created";
        if ($this->modified != "") $getParam['AND=>modified'] = "=~$this->modified";
    
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
            $this->returnArr[$j]['chlanguages_id'] = $reta['id'];
            $this->returnArr[$j]['user_id'] = $reta['user_id'];
            $this->returnArr[$j]['language_id'] = $reta['language_id'];
            $this->returnArr[$j]['creditcard_number'] = $reta['creditcard_number'];
            $this->returnArr[$j]['expDateMonth'] = $reta['expDateMonth'];
            $this->returnArr[$j]['expDateYear'] = $reta['expDateYear'];
            $this->returnArr[$j]['cvvNumber'] = $reta['cvvNumber'];
            $this->returnArr[$j]['card_type'] = $reta['card_type'];
            $this->returnArr[$j]['status'] = $reta['status'];
            $this->returnArr[$j]['is_deleted'] = $reta['is_deleted'];
            $this->returnArr[$j]['created'] = $reta['created'];
            $this->returnArr[$j]['modified'] = $reta['modified'];
            $j+=1;
          }
        } else if($this->actualact == "getSingle") {
            $this->returnArr[0]['chlanguages_id'] = $reton[0]['id'];
            $this->returnArr[0]['user_id'] = $reton[0]['user_id'];
            $this->returnArr[0]['language_id'] = $reton[0]['language_id'];
            $this->returnArr[0]['creditcard_number'] = $reton[0]['creditcard_number'];
            $this->returnArr[0]['expDateMonth'] = $reton[0]['expDateMonth'];
            $this->returnArr[0]['expDateYear'] = $reton[0]['expDateYear'];
            $this->returnArr[0]['cvvNumber'] = $reton[0]['cvvNumber'];
            $this->returnArr[0]['card_type'] = $reton[0]['card_type'];
            $this->returnArr[0]['status'] = $reton[0]['status'];
            $this->returnArr[0]['is_deleted'] = $reton[0]['is_deleted'];
            $this->returnArr[0]['created'] = $reton[0]['created'];
            $this->returnArr[0]['modified'] = $reton[0]['modified'];
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

      public function delete_chlanguages() {
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

