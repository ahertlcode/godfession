<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  header('Content-type: text/plain');
  include_once ('server/utilities/dbrel.php');

  $instObj          = new mydbs();
  $mainDBtable = "users";

  $getParam = array();
  //$getParam['country_id']      = "%LIKE%~253";
  $getParam['OR=>password']    = "=~7acce14ebf82c168e7445f2ca1ac91ad"; 
  //$getParam['AND=>is_deleted'] = "IN~1^0"; //is_deleted

  $arr['1%AND'] = $getParam;
  if (empty($getParam)) $arr['1%AND'] = "";

  $allin['conditionarr']  		  = $arr;
  $allin['tableName']     		  = $mainDBtable;
  $allin['fldsel']        		  = ""; //
  $allin['limitOffset']   		  = "";
  $allin['returnDebug']   		  = "ALL"; //"sQl" or "returnArray" or "inValues" or "ALL"
  $allin['oneEqualsOne']  		  = true;

  $reton 						            = $instObj->fetchRecs2($allin);

  print_r($reton);
