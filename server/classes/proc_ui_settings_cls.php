<?php

  include_once('godfessi_godfessions_baseClass.php');
  class proc_ui_settings_cls extends godfessi_godfessions_baseClass {

    //Properties 
    private $id = "";
    private $company_id = "";
    private $file_type = "";
    private $content = "";
    private $file_name = "";
    private $created = "";
    
    //Save Routine Validation Flags 
    private $validateid = false;
    private $validatecompany_id = false;
    private $validatefile_type = false;
    private $validatecontent = false;
    private $validatefile_name = false;
    private $validatecreated = false;
    
    //Other Controls 
    private $procarr     = array();
    private $proc        = true;
    private $mainDBtable = "ui_settings";
    private $statMsg     = "";
    private $returnArr   = array();
    private $datamethod  = "";
    private $datakls     = "";
    private $actualact   = "";

    public function __construct($inparams=array()) {
      if (!empty($inparams)) {
        if (isset($inparams['ui_settings_id']) && ($inparams['ui_settings_id'] != "")) $this->procarr['id'] = $this->id =  $inparams['ui_settings_id'];
        if (isset($inparams['company_id']) && ($inparams['company_id'] != "")) $this->procarr['company_id'] = $this->company_id =  $inparams['company_id'];
        if (isset($inparams['file_type']) && ($inparams['file_type'] != "")) $this->procarr['file_type'] = $this->file_type =  $inparams['file_type'];
        if (isset($inparams['content']) && ($inparams['content'] != "")) $this->procarr['content'] = $this->content =  $inparams['content'];
        if (isset($inparams['file_name']) && ($inparams['file_name'] != "")) $this->procarr['file_name'] = $this->file_name =  $inparams['file_name'];
        if (isset($inparams['created']) && ($inparams['created'] != "")) $this->procarr['created'] = $this->created =  $inparams['created'];

        if (isset($inparams['datamethod']))   $this->datamethod  =  $inparams['datamethod'];
        if (isset($inparams['datakls']))      $this->datakls     =  $inparams['datakls'];
        if (isset($inparams['actualact']))    $this->actualact   =  $inparams['actualact'];
      }
    }

      public function save_ui_settings() {
        if($this->id == "") return dosave_ui_settings();
        if($this->id != "") return doupdate_ui_settings();
      }

      public function dosave_ui_settings() {
        //Save Input Validations
        if (($this->proc == true) && ($this->validateid == true) && ($this->id == "")) {
          $this->proc    = false;
          $this->statMsg = "id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecompany_id == true) && ($this->company_id == "")) {
          $this->proc    = false;
          $this->statMsg = "company_id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatefile_type == true) && ($this->file_type == "")) {
          $this->proc    = false;
          $this->statMsg = "file_type can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecontent == true) && ($this->content == "")) {
          $this->proc    = false;
          $this->statMsg = "content can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatefile_name == true) && ($this->file_name == "")) {
          $this->proc    = false;
          $this->statMsg = "file_name can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecreated == true) && ($this->created == "")) {
          $this->proc    = false;
          $this->statMsg = "created can not be empty, pls correct to continue.";
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

      public function doupdate_ui_settings() {
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

      public function get_ui_settings() {
        $getParam = array();
        //NOTE : The = before ~ can be <>, NOT IN, LIKE, IN etc;
        //NOTE : e.g $getParam['AND=>columnname'] = "IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "NOT IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "<>~''"; columnname not = empty
        //NOTE : e.g $getParam['AND=>columnname'] = "!=~''"; columnname not = empty
        if ($this->id != "") $getParam['AND=>id'] = "=~$this->id";
        if ($this->company_id != "") $getParam['AND=>company_id'] = "=~$this->company_id";
        if ($this->file_type != "") $getParam['AND=>file_type'] = "=~$this->file_type";
        if ($this->content != "") $getParam['AND=>content'] = "=~$this->content";
        if ($this->file_name != "") $getParam['AND=>file_name'] = "=~$this->file_name";
        if ($this->created != "") $getParam['AND=>created'] = "=~$this->created";
    
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
            $this->returnArr[$j]['ui_settings_id'] = $reta['id'];
            $this->returnArr[$j]['company_id'] = $reta['company_id'];
            $this->returnArr[$j]['file_type'] = $reta['file_type'];
            $this->returnArr[$j]['content'] = $reta['content'];
            $this->returnArr[$j]['file_name'] = $reta['file_name'];
            $this->returnArr[$j]['created'] = $reta['created'];
            $j+=1;
          }
        } else if($this->actualact == "getSingle") {
            $this->returnArr[0]['ui_settings_id'] = $reton[0]['id'];
            $this->returnArr[0]['company_id'] = $reton[0]['company_id'];
            $this->returnArr[0]['file_type'] = $reton[0]['file_type'];
            $this->returnArr[0]['content'] = $reton[0]['content'];
            $this->returnArr[0]['file_name'] = $reton[0]['file_name'];
            $this->returnArr[0]['created'] = $reton[0]['created'];
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

      public function delete_ui_settings() {
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

