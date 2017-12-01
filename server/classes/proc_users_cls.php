<?php

  include_once('godfessi_godfessions_baseClass.php');
  class proc_users_cls extends godfessi_godfessions_baseClass {

    //Properties 
    private $id = "";
    private $first_name = "";
    private $last_name = "";
    private $email = "";
    private $gender = "";
    private $username = "";
    private $password = "";
    private $image = "";
    private $address = "";
    private $country_id = "";
    private $state_id = "";
    private $city = "";
    private $zip = "";
    private $phone_no = "";
    private $is_notification = "";
    private $language_id = "";
    private $status = "";
    private $is_deleted = "";
    private $created = "";
    private $modified = "";
    
    //Save Routine Validation Flags 
    private $validateid = false;
    private $validatefirst_name = false;
    private $validatelast_name = false;
    private $validateemail = false;
    private $validategender = false;
    private $validateusername = false;
    private $validatepassword = false;
    private $validateimage = false;
    private $validateaddress = false;
    private $validatecountry_id = false;
    private $validatestate_id = false;
    private $validatecity = false;
    private $validatezip = false;
    private $validatephone_no = false;
    private $validateis_notification = false;
    private $validatelanguage_id = false;
    private $validatestatus = false;
    private $validateis_deleted = false;
    private $validatecreated = false;
    private $validatemodified = false;
    
    //Other Controls 
    private $procarr     = array();
    private $proc        = true;
    private $mainDBtable = "users";
    private $statMsg     = "";
    private $returnArr   = array();
    private $datamethod  = "";
    private $datakls     = "";
    private $actualact   = "";

    public function __construct($inparams=array()) {
      if (!empty($inparams)) {
        if (isset($inparams['users_id']) && ($inparams['users_id'] != "")) $this->procarr['id'] = $this->id =  $inparams['users_id'];
        if (isset($inparams['first_name']) && ($inparams['first_name'] != "")) $this->procarr['first_name'] = $this->first_name =  $inparams['first_name'];
        if (isset($inparams['last_name']) && ($inparams['last_name'] != "")) $this->procarr['last_name'] = $this->last_name =  $inparams['last_name'];
        if (isset($inparams['email']) && ($inparams['email'] != "")) $this->procarr['email'] = $this->email =  $inparams['email'];
        if (isset($inparams['gender']) && ($inparams['gender'] != "")) $this->procarr['gender'] = $this->gender =  $inparams['gender'];
        if (isset($inparams['username']) && ($inparams['username'] != "")) $this->procarr['username'] = $this->username =  $inparams['username'];
        if (isset($inparams['password']) && ($inparams['password'] != "")) $this->procarr['password'] = $this->password =  $inparams['password'];
        if (isset($inparams['image']) && ($inparams['image'] != "")) $this->procarr['image'] = $this->image =  $inparams['image'];
        if (isset($inparams['address']) && ($inparams['address'] != "")) $this->procarr['address'] = $this->address =  $inparams['address'];
        if (isset($inparams['country_id']) && ($inparams['country_id'] != "")) $this->procarr['country_id'] = $this->country_id =  $inparams['country_id'];
        if (isset($inparams['state_id']) && ($inparams['state_id'] != "")) $this->procarr['state_id'] = $this->state_id =  $inparams['state_id'];
        if (isset($inparams['city']) && ($inparams['city'] != "")) $this->procarr['city'] = $this->city =  $inparams['city'];
        if (isset($inparams['zip']) && ($inparams['zip'] != "")) $this->procarr['zip'] = $this->zip =  $inparams['zip'];
        if (isset($inparams['phone_no']) && ($inparams['phone_no'] != "")) $this->procarr['phone_no'] = $this->phone_no =  $inparams['phone_no'];
        if (isset($inparams['is_notification']) && ($inparams['is_notification'] != "")) $this->procarr['is_notification'] = $this->is_notification =  $inparams['is_notification'];
        if (isset($inparams['language_id']) && ($inparams['language_id'] != "")) $this->procarr['language_id'] = $this->language_id =  $inparams['language_id'];
        if (isset($inparams['status']) && ($inparams['status'] != "")) $this->procarr['status'] = $this->status =  $inparams['status'];
        if (isset($inparams['is_deleted']) && ($inparams['is_deleted'] != "")) $this->procarr['is_deleted'] = $this->is_deleted =  $inparams['is_deleted'];
        if (isset($inparams['created']) && ($inparams['created'] != "")) $this->procarr['created'] = $this->created =  $inparams['created'];
        if (isset($inparams['modified']) && ($inparams['modified'] != "")) $this->procarr['modified'] = $this->modified =  $inparams['modified'];

        if (isset($inparams['datamethod']))   $this->datamethod  =  $inparams['datamethod'];
        if (isset($inparams['datakls']))      $this->datakls     =  $inparams['datakls'];
        if (isset($inparams['actualact']))    $this->actualact   =  $inparams['actualact'];
        if (!isset($inparams['ck__users_id']) || ($inparams['ck__users_id'] = "")) $this->procarr['password'] = $this->password =  md5($inparams['password']);
      }
    }

      public function save_users() {
        if($this->id == "") return dosave_users();
        if($this->id != "") return doupdate_users();
      }

      public function dosave_users() {
        //Save Input Validations
        if (($this->proc == true) && ($this->validateid == true) && ($this->id == "")) {
          $this->proc    = false;
          $this->statMsg = "id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatefirst_name == true) && ($this->first_name == "")) {
          $this->proc    = false;
          $this->statMsg = "first_name can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatelast_name == true) && ($this->last_name == "")) {
          $this->proc    = false;
          $this->statMsg = "last_name can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateemail == true) && ($this->email == "")) {
          $this->proc    = false;
          $this->statMsg = "email can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validategender == true) && ($this->gender == "")) {
          $this->proc    = false;
          $this->statMsg = "gender can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateusername == true) && ($this->username == "")) {
          $this->proc    = false;
          $this->statMsg = "username can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatepassword == true) && ($this->password == "")) {
          $this->proc    = false;
          $this->statMsg = "password can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateimage == true) && ($this->image == "")) {
          $this->proc    = false;
          $this->statMsg = "image can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateaddress == true) && ($this->address == "")) {
          $this->proc    = false;
          $this->statMsg = "address can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecountry_id == true) && ($this->country_id == "")) {
          $this->proc    = false;
          $this->statMsg = "country_id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatestate_id == true) && ($this->state_id == "")) {
          $this->proc    = false;
          $this->statMsg = "state_id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecity == true) && ($this->city == "")) {
          $this->proc    = false;
          $this->statMsg = "city can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatezip == true) && ($this->zip == "")) {
          $this->proc    = false;
          $this->statMsg = "zip can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatephone_no == true) && ($this->phone_no == "")) {
          $this->proc    = false;
          $this->statMsg = "phone_no can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateis_notification == true) && ($this->is_notification == "")) {
          $this->proc    = false;
          $this->statMsg = "is_notification can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatelanguage_id == true) && ($this->language_id == "")) {
          $this->proc    = false;
          $this->statMsg = "language_id can not be empty, pls correct to continue.";
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

      public function doupdate_users() {
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

      public function get_users() {
        $getParam = array();
        //NOTE : The = before ~ can be <>, NOT IN, LIKE, IN etc;
        //NOTE : e.g $getParam['AND=>columnname'] = "IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "NOT IN~1^0"; with each values separated by caret
        //NOTE : e.g $getParam['AND=>columnname'] = "<>~''"; columnname not = empty
        //NOTE : e.g $getParam['AND=>columnname'] = "!=~''"; columnname not = empty
        if ($this->id != "") $getParam['AND=>id'] = "=~$this->id";
        if ($this->first_name != "") $getParam['AND=>first_name'] = "=~$this->first_name";
        if ($this->last_name != "") $getParam['AND=>last_name'] = "=~$this->last_name";
        if ($this->email != "") $getParam['AND=>email'] = "=~$this->email";
        if ($this->gender != "") $getParam['AND=>gender'] = "=~$this->gender";
        if ($this->username != "") $getParam['AND=>username'] = "=~$this->username";
        if ($this->password != "") $getParam['AND=>password'] = "=~$this->password";
        if ($this->image != "") $getParam['AND=>image'] = "=~$this->image";
        if ($this->address != "") $getParam['AND=>address'] = "=~$this->address";
        if ($this->country_id != "") $getParam['AND=>country_id'] = "=~$this->country_id";
        if ($this->state_id != "") $getParam['AND=>state_id'] = "=~$this->state_id";
        if ($this->city != "") $getParam['AND=>city'] = "=~$this->city";
        if ($this->zip != "") $getParam['AND=>zip'] = "=~$this->zip";
        if ($this->phone_no != "") $getParam['AND=>phone_no'] = "=~$this->phone_no";
        if ($this->is_notification != "") $getParam['AND=>is_notification'] = "=~$this->is_notification";
        if ($this->language_id != "") $getParam['AND=>language_id'] = "=~$this->language_id";
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
            $this->returnArr[$j]['users_id'] = $reta['id'];
            $this->returnArr[$j]['first_name'] = $reta['first_name'];
            $this->returnArr[$j]['last_name'] = $reta['last_name'];
            $this->returnArr[$j]['email'] = $reta['email'];
            $this->returnArr[$j]['gender'] = $reta['gender'];
            $this->returnArr[$j]['username'] = $reta['username'];
            $this->returnArr[$j]['password'] = $reta['password'];
            $this->returnArr[$j]['image'] = $reta['image'];
            $this->returnArr[$j]['address'] = $reta['address'];
            $this->returnArr[$j]['country_id'] = $reta['country_id'];
            $this->returnArr[$j]['state_id'] = $reta['state_id'];
            $this->returnArr[$j]['city'] = $reta['city'];
            $this->returnArr[$j]['zip'] = $reta['zip'];
            $this->returnArr[$j]['phone_no'] = $reta['phone_no'];
            $this->returnArr[$j]['is_notification'] = $reta['is_notification'];
            $this->returnArr[$j]['language_id'] = $reta['language_id'];
            $this->returnArr[$j]['status'] = $reta['status'];
            $this->returnArr[$j]['is_deleted'] = $reta['is_deleted'];
            $this->returnArr[$j]['created'] = $reta['created'];
            $this->returnArr[$j]['modified'] = $reta['modified'];
            $j+=1;
          }
        } else if($this->actualact == "getSingle") {
            $this->returnArr[0]['users_id'] = $reton[0]['id'];
            $this->returnArr[0]['first_name'] = $reton[0]['first_name'];
            $this->returnArr[0]['last_name'] = $reton[0]['last_name'];
            $this->returnArr[0]['email'] = $reton[0]['email'];
            $this->returnArr[0]['gender'] = $reton[0]['gender'];
            $this->returnArr[0]['username'] = $reton[0]['username'];
            $this->returnArr[0]['password'] = $reton[0]['password'];
            $this->returnArr[0]['image'] = $reton[0]['image'];
            $this->returnArr[0]['address'] = $reton[0]['address'];
            $this->returnArr[0]['country_id'] = $reton[0]['country_id'];
            $this->returnArr[0]['state_id'] = $reton[0]['state_id'];
            $this->returnArr[0]['city'] = $reton[0]['city'];
            $this->returnArr[0]['zip'] = $reton[0]['zip'];
            $this->returnArr[0]['phone_no'] = $reton[0]['phone_no'];
            $this->returnArr[0]['is_notification'] = $reton[0]['is_notification'];
            $this->returnArr[0]['language_id'] = $reton[0]['language_id'];
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

      public function delete_users() {
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

