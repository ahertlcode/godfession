<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header('Content-Type: text/json');
ini_set('memory_limit','1024M');
include('utilities/dbrel.php');
include('utilities/libraries.php');
include('utilities/renderer.php');
include('classes/proc_users_cls.php');//proc_users_cls

if ((isset($_POST['datakls'])) && ($_POST['datakls'] != "") && ($_POST['datakls'] != "users")) {
  include_once('classes/proc_'.$_POST['datakls'].'_cls.php');
}

$validae  = new libraries();
$to_rend  = new renderer();
$curObj   = "proc_".$_POST['datakls']."_cls";
$curData  = $_POST;
$newArr   = array();
$cookArr  = array();

$saveUserMethod   = "save_users";
$getUserMethod    = "get_users";
$resetUserMethod  = "";//TO BE TAKEN CARE OFF

foreach ($curData as $ky => $val) {
  $dxpold = explode("__", $ky);
  if (!empty($dxpold)) {
    if ($dxpold[0] == "ck") {
      $cookArr[$ky] = (isset($val) && $val != '[object Object]')    ? $validae->validateInputs($val) : "";
    } else {
      $newArr[$ky]  = (isset($val) && $val != '[object Object]')    ? $validae->validateInputs($val) : "";
    }
  }
  $allPostedArr[$ky]= (isset($val) && $val != '[object Object]')    ? $validae->validateInputs($val) : "";
}

$datamethod     = (isset($newArr['datamethod']))        ? $newArr['datamethod'] : "";
$ck__datamethod = (isset($cookArr['ck__datamethod']))   ? $cookArr['ck__datamethod'] : "";

$retn = array();
if (($datamethod != "") || ($ck__datamethod != "")) {
  if (!empty($cookArr)) {

    # WANT TO DO SOME PROCESS BUT NEED AUTHENTICATION OR
    # WANT TO UPDATE USER RECORD
    $appuserid   = (isset($cookArr['ck__users_id']))          ? $cookArr['ck__users_id'] : "";
    $opappuserid = (isset($newArr['users_id']) && ($newArr['users_id'] != "")) ? $newArr['users_id'] : "";

    if ($appuserid != "") {
      # AUTHENTICATE USER FIRST
      //if (class_exists("userMgnt_cls") && ($ck__datamethod == "resolveUser")) {
      if (class_exists("proc_users_cls")) {
        # Authenticate User
        $userAuthCredntials['users_id']     = $cookArr['ck__users_id'];
        $userAuthCredntials['phone_no']     = $cookArr['ck__phone_no'];
        $userAuthCredntials['email']        = $cookArr['ck__email'];
        $userAuthCredntials['password']     = $cookArr['ck__password'];
        $userAuthCredntials['datamethod']   = $getUserMethod;
        $userAuthCredntials['actualact']    = $newArr['actualact'];

        $userObj    = new proc_users_cls($userAuthCredntials);
        $userObjRet = $userObj->$getUserMethod();
        //print_r($userObjRet);

        if (!empty($userObjRet)) {
          if ($userObjRet['stat_flag'] === 1) {
            if ($opappuserid == $appuserid) {
              # USER UPDATE ACTION
              $updObj   = new proc_users_cls($newArr);
              $retn     = $updObj->$saveUserMethod();
            } elseif (($opappuserid == "") && ($_POST['actualact'] == "logIn" || $_POST['actualact'] == "fillOutUser")) {
              # RE - CHECK LOGIN CREDENTIALS
              $lognRet['ck__users_id']        = ($userObjRet[0]['users_id'])       ? $userObjRet[0]['users_id']       : "";
              $lognRet['ck__username']        = ($userObjRet[0]['username'])        ? $userObjRet[0]['username']    : "";
              $lognRet['ck__email']           = ($userObjRet[0]['email'])           ? $userObjRet[0]['email']   : "";
              $lognRet['ck__phone_no']        = ($userObjRet[0]['phone_no'])        ? $userObjRet[0]['phone_no']     : "";
              $lognRet['ck__password']        = ($userObjRet[0]['password'])        ? $userObjRet[0]['password']     : "";

              $retn['retn']         = $lognRet;
              $retn['stat_flag']    = 1;
              $retn['stat_msg']     = $userObjRet['stat_msg'];
              $retn['datamethod']   = $userObjRet['datamethod'];
              $retn['actualact']    = $userObjRet['actualact'];
            } else {
              #... DATA PROCESSING
              $actCall    = (class_exists($curObj)) ? new $curObj($allPostedArr) : null;
              $retn       = $actCall->$datamethod();
              //print_r($retn);
            }
          } elseif ($userObjRet['stat_flag'] === 0) {

          }
        } else {
          $retn['stat_flag'] = 0;
          $retn['stat_msg']  = "Could not Authenticate User, Please Contact Admin!";
        }
      } else {
        $retn['stat_flag'] = 0;
        $retn['stat_msg']  = "Could not Authenticate User, Please Contact Admin!";
      }
    }
  } elseif (empty($cookArr)) {
    # WANT TO LOG IN OR REGISTER
    if ($_POST['datamethod'] == $saveUserMethod) {
      # SAVE NEW USER
      $nwUserObj    = new proc_users_cls($newArr);
      $retn         = $nwUserObj->$saveUserMethod();
    } elseif ($_POST['datamethod'] == $getUserMethod) {
      # LOG IN USER A FRESH Authenticate User

      //$loginParam['users_id']    = "";
      $loginParam['phone_no']   = (isset($newArr['phone_no'])) ? $validae->validateInputs($newArr['phone_no'])    : "";
      $loginParam['email']      = (isset($newArr['email']))    ? $validae->validateInputs($newArr['email'])  : "";
      $loginParam['password']   = (isset($newArr['password'])) ? $validae->validateInputs($newArr['password'])    : "";
      $loginParam['datamethod'] = $newArr['datamethod'];
      $loginParam['datakls']    = "proc_users_cls";
      $loginParam['actualact']  = (isset($newArr['actualact'])) ? $validae->validateInputs($newArr['actualact']) : "";

      $lognObj                    = new proc_users_cls($loginParam);
      $userObjRet                 = $lognObj->$getUserMethod();
      //print_r($userObjRet);

      if ($userObjRet['stat_flag']==1) {
        $lognRet['ck__users_id']        = ($userObjRet[0]['users_id'])       ? $userObjRet[0]['users_id']       : "";
        $lognRet['ck__username']        = ($userObjRet[0]['username'])        ? $userObjRet[0]['username']    : "";
        $lognRet['ck__email']           = ($userObjRet[0]['email'])           ? $userObjRet[0]['email']   : "";
        $lognRet['ck__phone_no']        = ($userObjRet[0]['phone_no'])        ? $userObjRet[0]['phone_no']     : "";
        $lognRet['ck__password']        = ($userObjRet[0]['password'])        ? $userObjRet[0]['password']     : "";

        //appuseraddress
        $retn['retn']         = $lognRet;
        $retn['stat_flag']    = 1;
        $retn['stat_msg']     = $userObjRet['stat_msg'];
        $retn['datamethod']   = $userObjRet['datamethod'];
        $retn['actualact']    = $userObjRet['actualact'];
      } else {
        $retn['stat_flag']    = 0;
        $retn['stat_msg']     = $userObjRet['stat_msg'];
        $retn['datamethod']   = $userObjRet['datamethod'];
        $retn['actualact']    = $userObjRet['actualact'];
      }

    } elseif ($_POST['datamethod'] == $resetUserMethod) {
      # User Password Reset
      $resObj                 = new proc_users_cls($allPostedArr);
      $resObjRes              = $resObj->$resetUserMethod();
      $retn = $resObjRes;
    } elseif ($_POST['datamethod'] == "any_action") {//Any action that doesnt need logging in
      #... DATA PROCESSING
      $actCall    = (class_exists($curObj)) ? new $curObj($allPostedArr) : null;
      $retn       = ($actCall != null) ? $actCall->$datamethod() : array();
    }
  } else {
    # CAN NOT RESOLVE THIS OPERATION
  }
} else {

}

$renda      = $to_rend->render('json', $retn, 'retn,<list></list>');
echo $renda;
