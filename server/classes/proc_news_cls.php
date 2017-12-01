<?php

  include_once('godfessi_godfessions_baseClass.php');
  class proc_news_cls extends godfessi_godfessions_baseClass {

    //Properties 
    private $id = "";
    private $title = "";
    private $description = "";
    private $image = "";
    private $tablet_image = "";
    private $video = "";
    private $video_thumbnail = "";
    private $audio = "";
    private $send_type = "";
    private $schedule_date = "";
    private $is_deleted = "";
    private $is_sent = "";
    private $created = "";
    private $modified = "";
    private $category_id = "";
    private $language_id = "";
    private $likes = "";
    private $published_date = "";
    
    //Save Routine Validation Flags 
    private $validateid = false;
    private $validatetitle = false;
    private $validatedescription = false;
    private $validateimage = false;
    private $validatetablet_image = false;
    private $validatevideo = false;
    private $validatevideo_thumbnail = false;
    private $validateaudio = false;
    private $validatesend_type = false;
    private $validateschedule_date = false;
    private $validateis_deleted = false;
    private $validateis_sent = false;
    private $validatecreated = false;
    private $validatemodified = false;
    private $validatecategory_id = false;
    private $validatelanguage_id = false;
    private $validatelikes = false;
    private $validatepublished_date = false;
    
    //Other Controls 
    private $procarr     = array();
    private $proc        = true;
    private $mainDBtable = "news";
    private $statMsg     = "";
    private $returnArr   = array();
    private $datamethod  = "";
    private $datakls     = "";
    private $actualact   = "";

    public function __construct($inparams=array()) {
      if (!empty($inparams)) {
        if (isset($inparams['news_id']) && ($inparams['news_id'] != "")) $this->procarr['id'] = $this->id =  $inparams['news_id'];
        if (isset($inparams['title']) && ($inparams['title'] != "")) $this->procarr['title'] = $this->title =  $inparams['title'];
        if (isset($inparams['description']) && ($inparams['description'] != "")) $this->procarr['description'] = $this->description =  $inparams['description'];
        if (isset($inparams['image']) && ($inparams['image'] != "")) $this->procarr['image'] = $this->image =  $inparams['image'];
        if (isset($inparams['tablet_image']) && ($inparams['tablet_image'] != "")) $this->procarr['tablet_image'] = $this->tablet_image =  $inparams['tablet_image'];
        if (isset($inparams['video']) && ($inparams['video'] != "")) $this->procarr['video'] = $this->video =  $inparams['video'];
        if (isset($inparams['video_thumbnail']) && ($inparams['video_thumbnail'] != "")) $this->procarr['video_thumbnail'] = $this->video_thumbnail =  $inparams['video_thumbnail'];
        if (isset($inparams['audio']) && ($inparams['audio'] != "")) $this->procarr['audio'] = $this->audio =  $inparams['audio'];
        if (isset($inparams['send_type']) && ($inparams['send_type'] != "")) $this->procarr['send_type'] = $this->send_type =  $inparams['send_type'];
        if (isset($inparams['schedule_date']) && ($inparams['schedule_date'] != "")) $this->procarr['schedule_date'] = $this->schedule_date =  $inparams['schedule_date'];
        if (isset($inparams['is_deleted']) && ($inparams['is_deleted'] != "")) $this->procarr['is_deleted'] = $this->is_deleted =  $inparams['is_deleted'];
        if (isset($inparams['is_sent']) && ($inparams['is_sent'] != "")) $this->procarr['is_sent'] = $this->is_sent =  $inparams['is_sent'];
        if (isset($inparams['created']) && ($inparams['created'] != "")) $this->procarr['created'] = $this->created =  $inparams['created'];
        if (isset($inparams['modified']) && ($inparams['modified'] != "")) $this->procarr['modified'] = $this->modified =  $inparams['modified'];
        if (isset($inparams['category_id']) && ($inparams['category_id'] != "")) $this->procarr['category_id'] = $this->category_id =  $inparams['category_id'];
        if (isset($inparams['language_id']) && ($inparams['language_id'] != "")) $this->procarr['language_id'] = $this->language_id =  $inparams['language_id'];
        if (isset($inparams['likes']) && ($inparams['likes'] != "")) $this->procarr['likes'] = $this->likes =  $inparams['likes'];
        if (isset($inparams['published_date']) && ($inparams['published_date'] != "")) $this->procarr['published_date'] = $this->published_date =  $inparams['published_date'];

        if (isset($inparams['datamethod']))   $this->datamethod  =  $inparams['datamethod'];
        if (isset($inparams['datakls']))      $this->datakls     =  $inparams['datakls'];
        if (isset($inparams['actualact']))    $this->actualact   =  $inparams['actualact'];
      }
    }

      public function save_news() {
        if($this->id == "") return dosave_news();
        if($this->id != "") return doupdate_news();
      }

      public function dosave_news() {
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

        if (($this->proc == true) && ($this->validateimage == true) && ($this->image == "")) {
          $this->proc    = false;
          $this->statMsg = "image can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatetablet_image == true) && ($this->tablet_image == "")) {
          $this->proc    = false;
          $this->statMsg = "tablet_image can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatevideo == true) && ($this->video == "")) {
          $this->proc    = false;
          $this->statMsg = "video can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatevideo_thumbnail == true) && ($this->video_thumbnail == "")) {
          $this->proc    = false;
          $this->statMsg = "video_thumbnail can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateaudio == true) && ($this->audio == "")) {
          $this->proc    = false;
          $this->statMsg = "audio can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatesend_type == true) && ($this->send_type == "")) {
          $this->proc    = false;
          $this->statMsg = "send_type can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateschedule_date == true) && ($this->schedule_date == "")) {
          $this->proc    = false;
          $this->statMsg = "schedule_date can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateis_deleted == true) && ($this->is_deleted == "")) {
          $this->proc    = false;
          $this->statMsg = "is_deleted can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateis_sent == true) && ($this->is_sent == "")) {
          $this->proc    = false;
          $this->statMsg = "is_sent can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecreated == true) && ($this->created == "")) {
          $this->proc    = false;
          $this->statMsg = "created can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatemodified == true) && ($this->modified == "")) {
          $this->proc    = false;
          $this->statMsg = "modified can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecategory_id == true) && ($this->category_id == "")) {
          $this->proc    = false;
          $this->statMsg = "category_id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatelanguage_id == true) && ($this->language_id == "")) {
          $this->proc    = false;
          $this->statMsg = "language_id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatelikes == true) && ($this->likes == "")) {
          $this->proc    = false;
          $this->statMsg = "likes can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatepublished_date == true) && ($this->published_date == "")) {
          $this->proc    = false;
          $this->statMsg = "published_date can not be empty, pls correct to continue.";
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

      public function doupdate_news() {
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

      public function get_news() {
        $getParam = array();
        //NOTE : The = before ~ can be <>, NOT IN, LIKE, IN etc;
        //NOTE : e.g $getParam['AND=>columnname'] = "IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "NOT IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "<>~''"; columnname not = empty
        //NOTE : e.g $getParam['AND=>columnname'] = "!=~''"; columnname not = empty
        if ($this->id != "") $getParam['AND=>id'] = "=~$this->id";
        if ($this->title != "") $getParam['AND=>title'] = "=~$this->title";
        if ($this->description != "") $getParam['AND=>description'] = "=~$this->description";
        if ($this->image != "") $getParam['AND=>image'] = "=~$this->image";
        if ($this->tablet_image != "") $getParam['AND=>tablet_image'] = "=~$this->tablet_image";
        if ($this->video != "") $getParam['AND=>video'] = "=~$this->video";
        if ($this->video_thumbnail != "") $getParam['AND=>video_thumbnail'] = "=~$this->video_thumbnail";
        if ($this->audio != "") $getParam['AND=>audio'] = "=~$this->audio";
        if ($this->send_type != "") $getParam['AND=>send_type'] = "=~$this->send_type";
        if ($this->schedule_date != "") $getParam['AND=>schedule_date'] = "=~$this->schedule_date";
        if ($this->is_deleted != "") $getParam['AND=>is_deleted'] = "=~$this->is_deleted";
        if ($this->is_sent != "") $getParam['AND=>is_sent'] = "=~$this->is_sent";
        if ($this->created != "") $getParam['AND=>created'] = "=~$this->created";
        if ($this->modified != "") $getParam['AND=>modified'] = "=~$this->modified";
        if ($this->category_id != "") $getParam['AND=>category_id'] = "=~$this->category_id";
        if ($this->language_id != "") $getParam['AND=>language_id'] = "=~$this->language_id";
        if ($this->likes != "") $getParam['AND=>likes'] = "=~$this->likes";
        if ($this->published_date != "") $getParam['AND=>published_date'] = "=~$this->published_date";
    
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
            $this->returnArr[$j]['news_id'] = $reta['id'];
            $this->returnArr[$j]['title'] = $reta['title'];
            $this->returnArr[$j]['description'] = $reta['description'];
            $this->returnArr[$j]['image'] = $reta['image'];
            $this->returnArr[$j]['tablet_image'] = $reta['tablet_image'];
            $this->returnArr[$j]['video'] = $reta['video'];
            $this->returnArr[$j]['video_thumbnail'] = $reta['video_thumbnail'];
            $this->returnArr[$j]['audio'] = $reta['audio'];
            $this->returnArr[$j]['send_type'] = $reta['send_type'];
            $this->returnArr[$j]['schedule_date'] = $reta['schedule_date'];
            $this->returnArr[$j]['is_deleted'] = $reta['is_deleted'];
            $this->returnArr[$j]['is_sent'] = $reta['is_sent'];
            $this->returnArr[$j]['created'] = $reta['created'];
            $this->returnArr[$j]['modified'] = $reta['modified'];
            $this->returnArr[$j]['category_id'] = $reta['category_id'];
            $this->returnArr[$j]['language_id'] = $reta['language_id'];
            $this->returnArr[$j]['likes'] = $reta['likes'];
            $this->returnArr[$j]['published_date'] = $reta['published_date'];
            $j+=1;
          }
        } else if($this->actualact == "getSingle") {
            $this->returnArr[0]['news_id'] = $reton[0]['id'];
            $this->returnArr[0]['title'] = $reton[0]['title'];
            $this->returnArr[0]['description'] = $reton[0]['description'];
            $this->returnArr[0]['image'] = $reton[0]['image'];
            $this->returnArr[0]['tablet_image'] = $reton[0]['tablet_image'];
            $this->returnArr[0]['video'] = $reton[0]['video'];
            $this->returnArr[0]['video_thumbnail'] = $reton[0]['video_thumbnail'];
            $this->returnArr[0]['audio'] = $reton[0]['audio'];
            $this->returnArr[0]['send_type'] = $reton[0]['send_type'];
            $this->returnArr[0]['schedule_date'] = $reton[0]['schedule_date'];
            $this->returnArr[0]['is_deleted'] = $reton[0]['is_deleted'];
            $this->returnArr[0]['is_sent'] = $reton[0]['is_sent'];
            $this->returnArr[0]['created'] = $reton[0]['created'];
            $this->returnArr[0]['modified'] = $reton[0]['modified'];
            $this->returnArr[0]['category_id'] = $reton[0]['category_id'];
            $this->returnArr[0]['language_id'] = $reton[0]['language_id'];
            $this->returnArr[0]['likes'] = $reton[0]['likes'];
            $this->returnArr[0]['published_date'] = $reton[0]['published_date'];
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

      public function delete_news() {
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

