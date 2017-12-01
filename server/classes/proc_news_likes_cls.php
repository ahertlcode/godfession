<?php

  include_once('godfessi_godfessions_baseClass.php');
  class proc_news_likes_cls extends godfessi_godfessions_baseClass {

    //Properties 
    private $id = "";
    private $news_id = "";
    private $user_id = "";
    private $like_status = "";
    private $is_deleted = "";
    
    //Save Routine Validation Flags 
    private $validateid = false;
    private $validatenews_id = false;
    private $validateuser_id = false;
    private $validatelike_status = false;
    private $validateis_deleted = false;
    
    //Other Controls 
    private $procarr     = array();
    private $proc        = true;
    private $mainDBtable = "news_likes";
    private $statMsg     = "";
    private $returnArr   = array();
    private $datamethod  = "";
    private $datakls     = "";
    private $actualact   = "";

    public function __construct($inparams=array()) {
      if (!empty($inparams)) {
        if (isset($inparams['news_likes_id']) && ($inparams['news_likes_id'] != "")) $this->procarr['id'] = $this->id =  $inparams['news_likes_id'];
        if (isset($inparams['news_id']) && ($inparams['news_id'] != "")) $this->procarr['news_id'] = $this->news_id =  $inparams['news_id'];
        if (isset($inparams['user_id']) && ($inparams['user_id'] != "")) $this->procarr['user_id'] = $this->user_id =  $inparams['user_id'];
        if (isset($inparams['like_status']) && ($inparams['like_status'] != "")) $this->procarr['like_status'] = $this->like_status =  $inparams['like_status'];
        if (isset($inparams['is_deleted']) && ($inparams['is_deleted'] != "")) $this->procarr['is_deleted'] = $this->is_deleted =  $inparams['is_deleted'];

        if (isset($inparams['datamethod']))   $this->datamethod  =  $inparams['datamethod'];
        if (isset($inparams['datakls']))      $this->datakls     =  $inparams['datakls'];
        if (isset($inparams['actualact']))    $this->actualact   =  $inparams['actualact'];
      }
    }

      public function save_news_likes() {
        if($this->id == "") return dosave_news_likes();
        if($this->id != "") return doupdate_news_likes();
      }

      public function dosave_news_likes() {
        //Save Input Validations
        if (($this->proc == true) && ($this->validateid == true) && ($this->id == "")) {
          $this->proc    = false;
          $this->statMsg = "id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatenews_id == true) && ($this->news_id == "")) {
          $this->proc    = false;
          $this->statMsg = "news_id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateuser_id == true) && ($this->user_id == "")) {
          $this->proc    = false;
          $this->statMsg = "user_id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatelike_status == true) && ($this->like_status == "")) {
          $this->proc    = false;
          $this->statMsg = "like_status can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateis_deleted == true) && ($this->is_deleted == "")) {
          $this->proc    = false;
          $this->statMsg = "is_deleted can not be empty, pls correct to continue.";
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

      public function doupdate_news_likes() {
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

      public function get_news_likes() {
        $getParam = array();
        //NOTE : The = before ~ can be <>, NOT IN, LIKE, IN etc;
        //NOTE : e.g $getParam['AND=>columnname'] = "IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "NOT IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "<>~''"; columnname not = empty
        //NOTE : e.g $getParam['AND=>columnname'] = "!=~''"; columnname not = empty
        if ($this->id != "") $getParam['AND=>id'] = "=~$this->id";
        if ($this->news_id != "") $getParam['AND=>news_id'] = "=~$this->news_id";
        if ($this->user_id != "") $getParam['AND=>user_id'] = "=~$this->user_id";
        if ($this->like_status != "") $getParam['AND=>like_status'] = "=~$this->like_status";
        if ($this->is_deleted != "") $getParam['AND=>is_deleted'] = "=~$this->is_deleted";
    
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
            $this->returnArr[$j]['news_likes_id'] = $reta['id'];
            $this->returnArr[$j]['news_id'] = $reta['news_id'];
            $this->returnArr[$j]['user_id'] = $reta['user_id'];
            $this->returnArr[$j]['like_status'] = $reta['like_status'];
            $this->returnArr[$j]['is_deleted'] = $reta['is_deleted'];
            $j+=1;
          }
        } else if($this->actualact == "getSingle") {
            $this->returnArr[0]['news_likes_id'] = $reton[0]['id'];
            $this->returnArr[0]['news_id'] = $reton[0]['news_id'];
            $this->returnArr[0]['user_id'] = $reton[0]['user_id'];
            $this->returnArr[0]['like_status'] = $reton[0]['like_status'];
            $this->returnArr[0]['is_deleted'] = $reton[0]['is_deleted'];
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

      public function delete_news_likes() {
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

