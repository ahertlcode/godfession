<?php

  include_once('godfessi_godfessions_baseClass.php');
  class proc_staticpages_cls extends godfessi_godfessions_baseClass {

    //Properties 
    private $id = "";
    private $title = "";
    private $description = "";
    private $keyword = "";
    private $meta_description = "";
    private $meta_tag = "";
    private $page_name = "";
    private $is_deleted = "";
    private $status = "";
    private $created = "";
    private $modified = "";
    
    //Save Routine Validation Flags 
    private $validateid = false;
    private $validatetitle = false;
    private $validatedescription = false;
    private $validatekeyword = false;
    private $validatemeta_description = false;
    private $validatemeta_tag = false;
    private $validatepage_name = false;
    private $validateis_deleted = false;
    private $validatestatus = false;
    private $validatecreated = false;
    private $validatemodified = false;
    
    //Other Controls 
    private $procarr     = array();
    private $proc        = true;
    private $mainDBtable = "staticpages";
    private $statMsg     = "";
    private $returnArr   = array();
    private $datamethod  = "";
    private $datakls     = "";
    private $actualact   = "";

    public function __construct($inparams=array()) {
      if (!empty($inparams)) {
        if (isset($inparams['staticpages_id']) && ($inparams['staticpages_id'] != "")) $this->procarr['id'] = $this->id =  $inparams['staticpages_id'];
        if (isset($inparams['title']) && ($inparams['title'] != "")) $this->procarr['title'] = $this->title =  $inparams['title'];
        if (isset($inparams['description']) && ($inparams['description'] != "")) $this->procarr['description'] = $this->description =  $inparams['description'];
        if (isset($inparams['keyword']) && ($inparams['keyword'] != "")) $this->procarr['keyword'] = $this->keyword =  $inparams['keyword'];
        if (isset($inparams['meta_description']) && ($inparams['meta_description'] != "")) $this->procarr['meta_description'] = $this->meta_description =  $inparams['meta_description'];
        if (isset($inparams['meta_tag']) && ($inparams['meta_tag'] != "")) $this->procarr['meta_tag'] = $this->meta_tag =  $inparams['meta_tag'];
        if (isset($inparams['page_name']) && ($inparams['page_name'] != "")) $this->procarr['page_name'] = $this->page_name =  $inparams['page_name'];
        if (isset($inparams['is_deleted']) && ($inparams['is_deleted'] != "")) $this->procarr['is_deleted'] = $this->is_deleted =  $inparams['is_deleted'];
        if (isset($inparams['status']) && ($inparams['status'] != "")) $this->procarr['status'] = $this->status =  $inparams['status'];
        if (isset($inparams['created']) && ($inparams['created'] != "")) $this->procarr['created'] = $this->created =  $inparams['created'];
        if (isset($inparams['modified']) && ($inparams['modified'] != "")) $this->procarr['modified'] = $this->modified =  $inparams['modified'];

        if (isset($inparams['datamethod']))   $this->datamethod  =  $inparams['datamethod'];
        if (isset($inparams['datakls']))      $this->datakls     =  $inparams['datakls'];
        if (isset($inparams['actualact']))    $this->actualact   =  $inparams['actualact'];
      }
    }

      public function save_staticpages() {
        if($this->id == "") return dosave_staticpages();
        if($this->id != "") return doupdate_staticpages();
      }

      public function dosave_staticpages() {
        //Save Input Validations
        if (($this->proc == true) && ($this->validateid == true) && ($this->id == "")) {
          $this->proc    = false;
          $this->statMsg = "id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatetitle == true) && ($this->title == "")) {
          $this->proc    = false;
          $this->statMsg = "title can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatedescription == true) && ($this->description == "")) {
          $this->proc    = false;
          $this->statMsg = "description can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatekeyword == true) && ($this->keyword == "")) {
          $this->proc    = false;
          $this->statMsg = "keyword can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatemeta_description == true) && ($this->meta_description == "")) {
          $this->proc    = false;
          $this->statMsg = "meta_description can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatemeta_tag == true) && ($this->meta_tag == "")) {
          $this->proc    = false;
          $this->statMsg = "meta_tag can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatepage_name == true) && ($this->page_name == "")) {
          $this->proc    = false;
          $this->statMsg = "page_name can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateis_deleted == true) && ($this->is_deleted == "")) {
          $this->proc    = false;
          $this->statMsg = "is_deleted can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatestatus == true) && ($this->status == "")) {
          $this->proc    = false;
          $this->statMsg = "status can not be empty, pls correct to continue.";
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

      public function doupdate_staticpages() {
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

      public function get_staticpages() {
        $getParam = array();
        //NOTE : The = before ~ can be <>, NOT IN, LIKE, IN etc;
        //NOTE : e.g $getParam['AND=>columnname'] = "IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "NOT IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "<>~''"; columnname not = empty
        //NOTE : e.g $getParam['AND=>columnname'] = "!=~''"; columnname not = empty
        if ($this->id != "") $getParam['AND=>id'] = "=~$this->id";
        if ($this->title != "") $getParam['AND=>title'] = "=~$this->title";
        if ($this->description != "") $getParam['AND=>description'] = "=~$this->description";
        if ($this->keyword != "") $getParam['AND=>keyword'] = "=~$this->keyword";
        if ($this->meta_description != "") $getParam['AND=>meta_description'] = "=~$this->meta_description";
        if ($this->meta_tag != "") $getParam['AND=>meta_tag'] = "=~$this->meta_tag";
        if ($this->page_name != "") $getParam['AND=>page_name'] = "=~$this->page_name";
        if ($this->is_deleted != "") $getParam['AND=>is_deleted'] = "=~$this->is_deleted";
        if ($this->status != "") $getParam['AND=>status'] = "=~$this->status";
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
            $this->returnArr[$j]['staticpages_id'] = $reta['id'];
            $this->returnArr[$j]['title'] = $reta['title'];
            $this->returnArr[$j]['description'] = $reta['description'];
            $this->returnArr[$j]['keyword'] = $reta['keyword'];
            $this->returnArr[$j]['meta_description'] = $reta['meta_description'];
            $this->returnArr[$j]['meta_tag'] = $reta['meta_tag'];
            $this->returnArr[$j]['page_name'] = $reta['page_name'];
            $this->returnArr[$j]['is_deleted'] = $reta['is_deleted'];
            $this->returnArr[$j]['status'] = $reta['status'];
            $this->returnArr[$j]['created'] = $reta['created'];
            $this->returnArr[$j]['modified'] = $reta['modified'];
            $j+=1;
          }
        } else if($this->actualact == "getSingle") {
            $this->returnArr[0]['staticpages_id'] = $reton[0]['id'];
            $this->returnArr[0]['title'] = $reton[0]['title'];
            $this->returnArr[0]['description'] = $reton[0]['description'];
            $this->returnArr[0]['keyword'] = $reton[0]['keyword'];
            $this->returnArr[0]['meta_description'] = $reton[0]['meta_description'];
            $this->returnArr[0]['meta_tag'] = $reton[0]['meta_tag'];
            $this->returnArr[0]['page_name'] = $reton[0]['page_name'];
            $this->returnArr[0]['is_deleted'] = $reton[0]['is_deleted'];
            $this->returnArr[0]['status'] = $reton[0]['status'];
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

      public function delete_staticpages() {
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

