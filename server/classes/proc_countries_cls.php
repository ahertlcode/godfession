<?php

  include_once('godfessi_godfessions_baseClass.php');
  class proc_countries_cls extends godfessi_godfessions_baseClass {

    //Properties 
    private $id = "";
    private $name = "";
    private $Capital = "";
    private $NationalitySingular = "";
    private $NationalityPlural = "";
    private $Currency = "";
    private $CurrencyCode = "";
    private $status = "";
    
    //Save Routine Validation Flags 
    private $validateid = false;
    private $validatename = false;
    private $validateCapital = false;
    private $validateNationalitySingular = false;
    private $validateNationalityPlural = false;
    private $validateCurrency = false;
    private $validateCurrencyCode = false;
    private $validatestatus = false;
    
    //Other Controls 
    private $procarr     = array();
    private $proc        = true;
    private $mainDBtable = "countries";
    private $statMsg     = "";
    private $returnArr   = array();
    private $datamethod  = "";
    private $datakls     = "";
    private $actualact   = "";

    public function __construct($inparams=array()) {
      if (!empty($inparams)) {
        if (isset($inparams['countries_id']) && ($inparams['countries_id'] != "")) $this->procarr['id'] = $this->id =  $inparams['countries_id'];
        if (isset($inparams['name']) && ($inparams['name'] != "")) $this->procarr['name'] = $this->name =  $inparams['name'];
        if (isset($inparams['Capital']) && ($inparams['Capital'] != "")) $this->procarr['Capital'] = $this->Capital =  $inparams['Capital'];
        if (isset($inparams['NationalitySingular']) && ($inparams['NationalitySingular'] != "")) $this->procarr['NationalitySingular'] = $this->NationalitySingular =  $inparams['NationalitySingular'];
        if (isset($inparams['NationalityPlural']) && ($inparams['NationalityPlural'] != "")) $this->procarr['NationalityPlural'] = $this->NationalityPlural =  $inparams['NationalityPlural'];
        if (isset($inparams['Currency']) && ($inparams['Currency'] != "")) $this->procarr['Currency'] = $this->Currency =  $inparams['Currency'];
        if (isset($inparams['CurrencyCode']) && ($inparams['CurrencyCode'] != "")) $this->procarr['CurrencyCode'] = $this->CurrencyCode =  $inparams['CurrencyCode'];
        if (isset($inparams['status']) && ($inparams['status'] != "")) $this->procarr['status'] = $this->status =  $inparams['status'];

        if (isset($inparams['datamethod']))   $this->datamethod  =  $inparams['datamethod'];
        if (isset($inparams['datakls']))      $this->datakls     =  $inparams['datakls'];
        if (isset($inparams['actualact']))    $this->actualact   =  $inparams['actualact'];
      }
    }

      public function save_countries() {
        if($this->id == "") return dosave_countries();
        if($this->id != "") return doupdate_countries();
      }

      public function dosave_countries() {
        //Save Input Validations
        if (($this->proc == true) && ($this->validateid == true) && ($this->id == "")) {
          $this->proc    = false;
          $this->statMsg = "id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatename == true) && ($this->name == "")) {
          $this->proc    = false;
          $this->statMsg = "name can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateCapital == true) && ($this->Capital == "")) {
          $this->proc    = false;
          $this->statMsg = "Capital can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateNationalitySingular == true) && ($this->NationalitySingular == "")) {
          $this->proc    = false;
          $this->statMsg = "NationalitySingular can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateNationalityPlural == true) && ($this->NationalityPlural == "")) {
          $this->proc    = false;
          $this->statMsg = "NationalityPlural can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateCurrency == true) && ($this->Currency == "")) {
          $this->proc    = false;
          $this->statMsg = "Currency can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateCurrencyCode == true) && ($this->CurrencyCode == "")) {
          $this->proc    = false;
          $this->statMsg = "CurrencyCode can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatestatus == true) && ($this->status == "")) {
          $this->proc    = false;
          $this->statMsg = "status can not be empty, pls correct to continue.";
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

      public function doupdate_countries() {
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

      public function get_countries() {
        $getParam = array();
        //NOTE : The = before ~ can be <>, NOT IN, LIKE, IN etc;
        //NOTE : e.g $getParam['AND=>columnname'] = "IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "NOT IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "<>~''"; columnname not = empty
        //NOTE : e.g $getParam['AND=>columnname'] = "!=~''"; columnname not = empty
        if ($this->id != "") $getParam['AND=>id'] = "=~$this->id";
        if ($this->name != "") $getParam['AND=>name'] = "=~$this->name";
        if ($this->Capital != "") $getParam['AND=>Capital'] = "=~$this->Capital";
        if ($this->NationalitySingular != "") $getParam['AND=>NationalitySingular'] = "=~$this->NationalitySingular";
        if ($this->NationalityPlural != "") $getParam['AND=>NationalityPlural'] = "=~$this->NationalityPlural";
        if ($this->Currency != "") $getParam['AND=>Currency'] = "=~$this->Currency";
        if ($this->CurrencyCode != "") $getParam['AND=>CurrencyCode'] = "=~$this->CurrencyCode";
        if ($this->status != "") $getParam['AND=>status'] = "=~$this->status";
    
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
            $this->returnArr[$j]['countries_id'] = $reta['id'];
            $this->returnArr[$j]['name'] = $reta['name'];
            $this->returnArr[$j]['Capital'] = $reta['Capital'];
            $this->returnArr[$j]['NationalitySingular'] = $reta['NationalitySingular'];
            $this->returnArr[$j]['NationalityPlural'] = $reta['NationalityPlural'];
            $this->returnArr[$j]['Currency'] = $reta['Currency'];
            $this->returnArr[$j]['CurrencyCode'] = $reta['CurrencyCode'];
            $this->returnArr[$j]['status'] = $reta['status'];
            $j+=1;
          }
        } else if($this->actualact == "getSingle") {
            $this->returnArr[0]['countries_id'] = $reton[0]['id'];
            $this->returnArr[0]['name'] = $reton[0]['name'];
            $this->returnArr[0]['Capital'] = $reton[0]['Capital'];
            $this->returnArr[0]['NationalitySingular'] = $reton[0]['NationalitySingular'];
            $this->returnArr[0]['NationalityPlural'] = $reton[0]['NationalityPlural'];
            $this->returnArr[0]['Currency'] = $reton[0]['Currency'];
            $this->returnArr[0]['CurrencyCode'] = $reton[0]['CurrencyCode'];
            $this->returnArr[0]['status'] = $reton[0]['status'];
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

      public function delete_countries() {
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

