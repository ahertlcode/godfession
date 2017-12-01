<?php

  include_once('godfessi_godfessions_baseClass.php');
  class proc_admins_cls extends godfessi_godfessions_baseClass {

    //Properties 
    private $id = "";
    private $first_name = "";
    private $last_name = "";
    private $email = "";
    private $phone = "";
    private $password = "";
    private $address = "";
    private $city = "";
    private $state = "";
    private $zip = "";
    private $status = "";
    private $is_deleted = "";
    private $random_key = "";
    private $admin_role_id = "";
    private $created = "";
    private $modified = "";
    private $welcome = "";
    
    //Save Routine Validation Flags 
    private $validateid = false;
    private $validatefirst_name = false;
    private $validatelast_name = false;
    private $validateemail = false;
    private $validatephone = false;
    private $validatepassword = false;
    private $validateaddress = false;
    private $validatecity = false;
    private $validatestate = false;
    private $validatezip = false;
    private $validatestatus = false;
    private $validateis_deleted = false;
    private $validaterandom_key = false;
    private $validateadmin_role_id = false;
    private $validatecreated = false;
    private $validatemodified = false;
    private $validatewelcome = false;
    
    //Other Controls 
    private $procarr     = array();
    private $proc        = true;
    private $mainDBtable = "admins";
    private $statMsg     = "";
    private $returnArr   = array();
    private $datamethod  = "";
    private $datakls     = "";
    private $actualact   = "";

    public function __construct($inparams=array()) {
      if (!empty($inparams)) {
        if (isset($inparams['admins_id']) && ($inparams['admins_id'] != "")) $this->procarr['id'] = $this->id =  $inparams['admins_id'];
        if (isset($inparams['first_name']) && ($inparams['first_name'] != "")) $this->procarr['first_name'] = $this->first_name =  $inparams['first_name'];
        if (isset($inparams['last_name']) && ($inparams['last_name'] != "")) $this->procarr['last_name'] = $this->last_name =  $inparams['last_name'];
        if (isset($inparams['email']) && ($inparams['email'] != "")) $this->procarr['email'] = $this->email =  $inparams['email'];
        if (isset($inparams['phone']) && ($inparams['phone'] != "")) $this->procarr['phone'] = $this->phone =  $inparams['phone'];
        if (isset($inparams['password']) && ($inparams['password'] != "")) $this->procarr['password'] = $this->password =  $inparams['password'];
        if (isset($inparams['address']) && ($inparams['address'] != "")) $this->procarr['address'] = $this->address =  $inparams['address'];
        if (isset($inparams['city']) && ($inparams['city'] != "")) $this->procarr['city'] = $this->city =  $inparams['city'];
        if (isset($inparams['state']) && ($inparams['state'] != "")) $this->procarr['state'] = $this->state =  $inparams['state'];
        if (isset($inparams['zip']) && ($inparams['zip'] != "")) $this->procarr['zip'] = $this->zip =  $inparams['zip'];
        if (isset($inparams['status']) && ($inparams['status'] != "")) $this->procarr['status'] = $this->status =  $inparams['status'];
        if (isset($inparams['is_deleted']) && ($inparams['is_deleted'] != "")) $this->procarr['is_deleted'] = $this->is_deleted =  $inparams['is_deleted'];
        if (isset($inparams['random_key']) && ($inparams['random_key'] != "")) $this->procarr['random_key'] = $this->random_key =  $inparams['random_key'];
        if (isset($inparams['admin_role_id']) && ($inparams['admin_role_id'] != "")) $this->procarr['admin_role_id'] = $this->admin_role_id =  $inparams['admin_role_id'];
        if (isset($inparams['created']) && ($inparams['created'] != "")) $this->procarr['created'] = $this->created =  $inparams['created'];
        if (isset($inparams['modified']) && ($inparams['modified'] != "")) $this->procarr['modified'] = $this->modified =  $inparams['modified'];
        if (isset($inparams['welcome']) && ($inparams['welcome'] != "")) $this->procarr['welcome'] = $this->welcome =  $inparams['welcome'];

        if (isset($inparams['datamethod']))   $this->datamethod  =  $inparams['datamethod'];
        if (isset($inparams['datakls']))      $this->datakls     =  $inparams['datakls'];
        if (isset($inparams['actualact']))    $this->actualact   =  $inparams['actualact'];
      }
    }

      public function save_admins() {
        if($this->id == "") return dosave_admins();
        if($this->id != "") return doupdate_admins();
      }

      public function dosave_admins() {
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

        if (($this->proc == true) && ($this->validatephone == true) && ($this->phone == "")) {
          $this->proc    = false;
          $this->statMsg = "phone can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatepassword == true) && ($this->password == "")) {
          $this->proc    = false;
          $this->statMsg = "password can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateaddress == true) && ($this->address == "")) {
          $this->proc    = false;
          $this->statMsg = "address can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecity == true) && ($this->city == "")) {
          $this->proc    = false;
          $this->statMsg = "city can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatestate == true) && ($this->state == "")) {
          $this->proc    = false;
          $this->statMsg = "state can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatezip == true) && ($this->zip == "")) {
          $this->proc    = false;
          $this->statMsg = "zip can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatestatus == true) && ($this->status == "")) {
          $this->proc    = false;
          $this->statMsg = "status can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateis_deleted == true) && ($this->is_deleted == "")) {
          $this->proc    = false;
          $this->statMsg = "is_deleted can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validaterandom_key == true) && ($this->random_key == "")) {
          $this->proc    = false;
          $this->statMsg = "random_key can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validateadmin_role_id == true) && ($this->admin_role_id == "")) {
          $this->proc    = false;
          $this->statMsg = "admin_role_id can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatecreated == true) && ($this->created == "")) {
          $this->proc    = false;
          $this->statMsg = "created can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatemodified == true) && ($this->modified == "")) {
          $this->proc    = false;
          $this->statMsg = "modified can not be empty, pls correct to continue.";
        }

        if (($this->proc == true) && ($this->validatewelcome == true) && ($this->welcome == "")) {
          $this->proc    = false;
          $this->statMsg = "welcome can not be empty, pls correct to continue.";
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

      public function doupdate_admins() {
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

      public function get_admins() {
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
        if ($this->phone != "") $getParam['AND=>phone'] = "=~$this->phone";
        if ($this->password != "") $getParam['AND=>password'] = "=~$this->password";
        if ($this->address != "") $getParam['AND=>address'] = "=~$this->address";
        if ($this->city != "") $getParam['AND=>city'] = "=~$this->city";
        if ($this->state != "") $getParam['AND=>state'] = "=~$this->state";
        if ($this->zip != "") $getParam['AND=>zip'] = "=~$this->zip";
        if ($this->status != "") $getParam['AND=>status'] = "=~$this->status";
        if ($this->is_deleted != "") $getParam['AND=>is_deleted'] = "=~$this->is_deleted";
        if ($this->random_key != "") $getParam['AND=>random_key'] = "=~$this->random_key";
        if ($this->admin_role_id != "") $getParam['AND=>admin_role_id'] = "=~$this->admin_role_id";
        if ($this->created != "") $getParam['AND=>created'] = "=~$this->created";
        if ($this->modified != "") $getParam['AND=>modified'] = "=~$this->modified";
        if ($this->welcome != "") $getParam['AND=>welcome'] = "=~$this->welcome";
    
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
            $this->returnArr[$j]['admins_id'] = $reta['id'];
            $this->returnArr[$j]['first_name'] = $reta['first_name'];
            $this->returnArr[$j]['last_name'] = $reta['last_name'];
            $this->returnArr[$j]['email'] = $reta['email'];
            $this->returnArr[$j]['phone'] = $reta['phone'];
            $this->returnArr[$j]['password'] = $reta['password'];
            $this->returnArr[$j]['address'] = $reta['address'];
            $this->returnArr[$j]['city'] = $reta['city'];
            $this->returnArr[$j]['state'] = $reta['state'];
            $this->returnArr[$j]['zip'] = $reta['zip'];
            $this->returnArr[$j]['status'] = $reta['status'];
            $this->returnArr[$j]['is_deleted'] = $reta['is_deleted'];
            $this->returnArr[$j]['random_key'] = $reta['random_key'];
            $this->returnArr[$j]['admin_role_id'] = $reta['admin_role_id'];
            $this->returnArr[$j]['created'] = $reta['created'];
            $this->returnArr[$j]['modified'] = $reta['modified'];
            $this->returnArr[$j]['welcome'] = $reta['welcome'];
            $j+=1;
          }
        } else if($this->actualact == "getSingle") {
            $this->returnArr[0]['admins_id'] = $reton[0]['id'];
            $this->returnArr[0]['first_name'] = $reton[0]['first_name'];
            $this->returnArr[0]['last_name'] = $reton[0]['last_name'];
            $this->returnArr[0]['email'] = $reton[0]['email'];
            $this->returnArr[0]['phone'] = $reton[0]['phone'];
            $this->returnArr[0]['password'] = $reton[0]['password'];
            $this->returnArr[0]['address'] = $reton[0]['address'];
            $this->returnArr[0]['city'] = $reton[0]['city'];
            $this->returnArr[0]['state'] = $reton[0]['state'];
            $this->returnArr[0]['zip'] = $reton[0]['zip'];
            $this->returnArr[0]['status'] = $reton[0]['status'];
            $this->returnArr[0]['is_deleted'] = $reton[0]['is_deleted'];
            $this->returnArr[0]['random_key'] = $reton[0]['random_key'];
            $this->returnArr[0]['admin_role_id'] = $reton[0]['admin_role_id'];
            $this->returnArr[0]['created'] = $reton[0]['created'];
            $this->returnArr[0]['modified'] = $reton[0]['modified'];
            $this->returnArr[0]['welcome'] = $reton[0]['welcome'];
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

      public function delete_admins() {
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

