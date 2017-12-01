<?php

  include_once('godfessi_godfessions_baseClass.php');
  class proc_languages_cls extends godfessi_godfessions_baseClass {

    //Properties 
    private $id = "";
    private $language_name = "";
    private $languagesku = "";
    private $status = "";
    private $is_deleted = "";
    private $created = "";
    private $modified = "";
    
    //Save Routine Validation Flags 
    private $validateid = false;
    private $validatelanguage_name = false;
    private $validatelanguagesku = false;
    private $validatestatus = false;
    private $validateis_deleted = false;
    private $validatecreated = false;
    private $validatemodified = false;
    
    //Other Controls 
    private $procarr     = array();
    private $proc        = true;
    private $mainDBtable = "languages";
    private $statMsg     = "";
    private $returnArr   = array();
    private $datamethod  = "";
    private $datakls     = "";
    private $actualact   = "";

    public function __construct($inparams=array()) {
      if (!empty($inparams)) {
        if (isset($inparams['languages_id']) && ($inparams['languages_id'] != "")) $this->procarr['id'] = $this->id =  $inparams['languages_id'];
        if (isset($inparams['language_name']) && ($inparams['language_name'] != "")) $this->procarr['language_name'] = $this->language_name =  $inparams['language_name'];
        if (isset($inparams['languagesku']) && ($inparams['languagesku'] != "")) $this->procarr['languagesku'] = $this->languagesku =  $inparams['languagesku'];
        if (isset($inparams['status']) && ($inparams['status'] != "")) $this->procarr['status'] = $this->status =  $inparams['status'];
        if (isset($inparams['is_deleted']) && ($inparams['is_deleted'] != "")) $this->procarr['is_deleted'] = $this->is_deleted =  $inparams['is_deleted'];
        if (isset($inparams['created']) && ($inparams['created'] != "")) $this->procarr['created'] = $this->created =  $inparams['created'];
        if (isset($inparams['modified']) && ($inparams['modified'] != "")) $this->procarr['modified'] = $this->modified =  $inparams['modified'];

        if (isset($inparams['datamethod']))   $this->datamethod  =  $inparams['datamethod'];
        if (isset($inparams['datakls']))      $this->datakls     =  $inparams['datakls'];
        if (isset($inparams['actualact']))    $this->actualact   =  $inparams['actualact'];
      }
    }

      public function save_languages() {
        if($this->id == "") return dosave_languages();
        if($this->id != "") return doupdate_languages();
      }

      public function dosave_languages() {
        //Save Input Validations
        if (($this->proc == true) && ($this->validateid == true) && ($this->id == "")) {
          $this->proc    = false;
          $this->statMsg = "id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatelanguage_name == true) && ($this->language_name == "")) {
          $this->proc    = false;
          $this->statMsg = "language_name can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatelanguagesku == true) && ($this->languagesku == "")) {
          $this->proc    = false;
          $this->statMsg = "languagesku can not be empty, pls correct to continue.";
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

      public function doupdate_languages() {
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

      public function get_languages() {
        $getParam = array();
        //NOTE : The = before ~ can be <>, NOT IN, LIKE, IN etc;
        //NOTE : e.g $getParam['AND=>columnname'] = "IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "NOT IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "<>~''"; columnname not = empty
        //NOTE : e.g $getParam['AND=>columnname'] = "!=~''"; columnname not = empty
        if ($this->id != "") $getParam['AND=>id'] = "=~$this->id";
        if ($this->language_name != "") $getParam['AND=>language_name'] = "=~$this->language_name";
        if ($this->languagesku != "") $getParam['AND=>languagesku'] = "=~$this->languagesku";
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
            $this->returnArr[$j]['languages_id'] = $reta['id'];
            $this->returnArr[$j]['language_name'] = $reta['language_name'];
            $this->returnArr[$j]['languagesku'] = $reta['languagesku'];
            $this->returnArr[$j]['status'] = $reta['status'];
            $this->returnArr[$j]['is_deleted'] = $reta['is_deleted'];
            $this->returnArr[$j]['created'] = $reta['created'];
            $this->returnArr[$j]['modified'] = $reta['modified'];
            $j+=1;
          }
        } else if($this->actualact == "getSingle") {
            $this->returnArr[0]['languages_id'] = $reton[0]['id'];
            $this->returnArr[0]['language_name'] = $reton[0]['language_name'];
            $this->returnArr[0]['languagesku'] = $reton[0]['languagesku'];
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

      public function delete_languages() {
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

