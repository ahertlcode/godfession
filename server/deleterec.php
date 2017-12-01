<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header('Content-Type: text/json');
ini_set('memory_limit', '1024M');
require 'utilities/db.php';
require 'utilities/renderer.php';

if (isset($_GET['t_col']) && isset($_GET['t_tb'])) {
    $col = $_GET['t_col'];
    $tb = $_GET['t_tb'];
} else if (isset($_POST['t_col']) && isset($_POST['t_tb'])) {
    $col = $_POST['t_col'];
    $tb = $_POST['t_tb'];
} else {
    //do nothing
}
if (isset($col)) {
    $sql = "update {$tb} set status='0' where  id='{$col}' ";
} else {
}

if (isset($sql)) {
    $dbl = new db();

    $data = $dbl->executeQuery($sql);

    if ($data) {
        $msg = array("status"=>"success", "msg"=>"Successful !");
        
        $renda = new renderer();

        echo $renda->render("json", $msg, "info,<list></list>");

    }
} else {
    $msg = array("status"=>"fail", "msg"=>"Not Done, No data specified !");
    
    $renda = new renderer();

    echo $renda->render("json", $msg, "info,<list></list>");
}