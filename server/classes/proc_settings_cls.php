<?php

  include_once('godfessi_godfessions_baseClass.php');
  class proc_settings_cls extends godfessi_godfessions_baseClass {

    //Properties 
    private $id = "";
    private $api_sign = "";
    private $api_user = "";
    private $api_pass = "";
    private $enviroment = "";
    
    //Save Routine Validation Flags 
    private $validateid = false;
    private $validateapi_sign = false;
    private $validateapi_user = false;
    private $validateapi_pass = false;
    private $validateenviroment = false;
    
    //Other Controls 
    private $procarr     = array();
    private $proc        = true;
    private $mainDBtable = "settings";
    private $statMsg     = "";
    private $returnArr   = array();
    private $datamethod  = "";
    private $datakls     = "";
    private $actualact   = "";

    public function __construct($inparams=array()) {
      if (!empty($inparams)) {
        if (isset($inparams['settings_id']) && ($inparams['settings_id'] != "")) $this->procarr['id'] = $this->id =  $inparams['settings_id'];
        if (isset($inparams['api_sign']) && ($inparams['api_sign'] != "")) $this->procarr['api_sign'] = $this->api_sign =  $inparams['api_sign'];
        if (isset($inparams['api_user']) && ($inparams['api_user'] != "")) $this->procarr['api_user'] = $this->api_user =  $inparams['api_user'];
        if (isset($inparams['api_pass']) && ($inparams['api_pass'] != "")) $this->procarr['api_pass'] = $this->api_pass =  $inparams['api_pass'];
        if (isset($inparams['enviroment']) && ($inparams['enviroment'] != "")) $this->procarr['enviroment'] = $this->enviroment =  $inparams['enviroment'];

        if (isset($inparams['datamethod']))   $this->datamethod  =  $inparams['datamethod'];
        if (isset($inparams['datakls']))      $this->datakls     =  $inparams['datakls'];
        if (isset($inparams['actualact']))    $this->actualact   =  $inparams['actualact'];
      }
    }

      public function save_settings() {
        if($this->id == "") return dosave_settings();
        if($this->id != "") return doupdate_settings();
      }

      public function dosave_settings() {
        //Save Input Validations
        if (($this->proc == true) && ($this->validateid == true) && ($this->id == "")) {
          $this->proc    = false;
          $this->statMsg = "id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateapi_sign == true) && ($this->api_sign == "")) {
          $this->proc    = false;
          $this->statMsg = "api_sign can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateapi_user == true) && ($this->api_user == "")) {
          $this->proc    = false;
          $this->statMsg = "api_user can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateapi_pass == true) && ($this->api_pass == "")) {
          $this->proc    = false;
          $this->statMsg = "api_pass can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateenviroment == true) && ($this->enviroment == "")) {
          $this->proc    = false;
          $this->statMsg = "enviroment can not be empty, pls correct to continue.";
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

      public function doupdate_settings() {
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

      public function get_settings() {
        $getParam = array();
        //NOTE : The = before ~ can be <>, NOT IN, LIKE, IN etc;
        //NOTE : e.g $getParam['AND=>columnname'] = "IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "NOT IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "<>~''"; columnname not = empty
        //NOTE : e.g $getParam['AND=>columnname'] = "!=~''"; columnname not = empty
        if ($this->id != "") $getParam['AND=>id'] = "=~$this->id";
        if ($this->api_sign != "") $getParam['AND=>api_sign'] = "=~$this->api_sign";
        if ($this->api_user != "") $getParam['AND=>api_user'] = "=~$this->api_user";
        if ($this->api_pass != "") $getParam['AND=>api_pass'] = "=~$this->api_pass";
        if ($this->enviroment != "") $getParam['AND=>enviroment'] = "=~$this->enviroment";
    
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
            $this->returnArr[$j]['settings_id'] = $reta['id'];
            $this->returnArr[$j]['api_sign'] = $reta['api_sign'];
            $this->returnArr[$j]['api_user'] = $reta['api_user'];
            $this->returnArr[$j]['api_pass'] = $reta['api_pass'];
            $this->returnArr[$j]['enviroment'] = $reta['enviroment'];
            $j+=1;
          }
        } else if($this->actualact == "getSingle") {
            $this->returnArr[0]['settings_id'] = $reton[0]['id'];
            $this->returnArr[0]['api_sign'] = $reton[0]['api_sign'];
            $this->returnArr[0]['api_user'] = $reton[0]['api_user'];
            $this->returnArr[0]['api_pass'] = $reton[0]['api_pass'];
            $this->returnArr[0]['enviroment'] = $reton[0]['enviroment'];
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

      public function delete_settings() {
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

