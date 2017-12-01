<?php

  include_once('godfessi_godfessions_baseClass.php');
  class proc_news_comments_cls extends godfessi_godfessions_baseClass {

    //Properties 
    private $id = "";
    private $news_id = "";
    private $user_id = "";
    private $comment = "";
    private $created = "";
    private $modified = "";
    private $is_active = "";
    private $is_deleted = "";
    
    //Save Routine Validation Flags 
    private $validateid = false;
    private $validatenews_id = false;
    private $validateuser_id = false;
    private $validatecomment = false;
    private $validatecreated = false;
    private $validatemodified = false;
    private $validateis_active = false;
    private $validateis_deleted = false;
    
    //Other Controls 
    private $procarr     = array();
    private $proc        = true;
    private $mainDBtable = "news_comments";
    private $statMsg     = "";
    private $returnArr   = array();
    private $datamethod  = "";
    private $datakls     = "";
    private $actualact   = "";

    public function __construct($inparams=array()) {
      if (!empty($inparams)) {
        if (isset($inparams['news_comments_id']) && ($inparams['news_comments_id'] != "")) $this->procarr['id'] = $this->id =  $inparams['news_comments_id'];
        if (isset($inparams['news_id']) && ($inparams['news_id'] != "")) $this->procarr['news_id'] = $this->news_id =  $inparams['news_id'];
        if (isset($inparams['user_id']) && ($inparams['user_id'] != "")) $this->procarr['user_id'] = $this->user_id =  $inparams['user_id'];
        if (isset($inparams['comment']) && ($inparams['comment'] != "")) $this->procarr['comment'] = $this->comment =  $inparams['comment'];
        if (isset($inparams['created']) && ($inparams['created'] != "")) $this->procarr['created'] = $this->created =  $inparams['created'];
        if (isset($inparams['modified']) && ($inparams['modified'] != "")) $this->procarr['modified'] = $this->modified =  $inparams['modified'];
        if (isset($inparams['is_active']) && ($inparams['is_active'] != "")) $this->procarr['is_active'] = $this->is_active =  $inparams['is_active'];
        if (isset($inparams['is_deleted']) && ($inparams['is_deleted'] != "")) $this->procarr['is_deleted'] = $this->is_deleted =  $inparams['is_deleted'];

        if (isset($inparams['datamethod']))   $this->datamethod  =  $inparams['datamethod'];
        if (isset($inparams['datakls']))      $this->datakls     =  $inparams['datakls'];
        if (isset($inparams['actualact']))    $this->actualact   =  $inparams['actualact'];
      }
    }

      public function save_news_comments() {
        if($this->id == "") return dosave_news_comments();
        if($this->id != "") return doupdate_news_comments();
      }

      public function dosave_news_comments() {
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

        if (($this->proc == true) && ($this->validatecomment == true) && ($this->comment == "")) {
          $this->proc    = false;
          $this->statMsg = "comment can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecreated == true) && ($this->created == "")) {
          $this->proc    = false;
          $this->statMsg = "created can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatemodified == true) && ($this->modified == "")) {
          $this->proc    = false;
          $this->statMsg = "modified can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateis_active == true) && ($this->is_active == "")) {
          $this->proc    = false;
          $this->statMsg = "is_active can not be empty, pls correct to continue.";
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

      public function doupdate_news_comments() {
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

      public function get_news_comments() {
        $getParam = array();
        //NOTE : The = before ~ can be <>, NOT IN, LIKE, IN etc;
        //NOTE : e.g $getParam['AND=>columnname'] = "IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "NOT IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "<>~''"; columnname not = empty
        //NOTE : e.g $getParam['AND=>columnname'] = "!=~''"; columnname not = empty
        if ($this->id != "") $getParam['AND=>id'] = "=~$this->id";
        if ($this->news_id != "") $getParam['AND=>news_id'] = "=~$this->news_id";
        if ($this->user_id != "") $getParam['AND=>user_id'] = "=~$this->user_id";
        if ($this->comment != "") $getParam['AND=>comment'] = "=~$this->comment";
        if ($this->created != "") $getParam['AND=>created'] = "=~$this->created";
        if ($this->modified != "") $getParam['AND=>modified'] = "=~$this->modified";
        if ($this->is_active != "") $getParam['AND=>is_active'] = "=~$this->is_active";
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
            $this->returnArr[$j]['news_comments_id'] = $reta['id'];
            $this->returnArr[$j]['news_id'] = $reta['news_id'];
            $this->returnArr[$j]['user_id'] = $reta['user_id'];
            $this->returnArr[$j]['comment'] = $reta['comment'];
            $this->returnArr[$j]['created'] = $reta['created'];
            $this->returnArr[$j]['modified'] = $reta['modified'];
            $this->returnArr[$j]['is_active'] = $reta['is_active'];
            $this->returnArr[$j]['is_deleted'] = $reta['is_deleted'];
            $j+=1;
          }
        } else if($this->actualact == "getSingle") {
            $this->returnArr[0]['news_comments_id'] = $reton[0]['id'];
            $this->returnArr[0]['news_id'] = $reton[0]['news_id'];
            $this->returnArr[0]['user_id'] = $reton[0]['user_id'];
            $this->returnArr[0]['comment'] = $reton[0]['comment'];
            $this->returnArr[0]['created'] = $reton[0]['created'];
            $this->returnArr[0]['modified'] = $reton[0]['modified'];
            $this->returnArr[0]['is_active'] = $reton[0]['is_active'];
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

      public function delete_news_comments() {
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

