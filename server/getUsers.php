<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header('Content-Type: text/json');
ini_set('memory_limit', '1024M');
require 'utilities/db.php';
require 'utilities/renderer.php';

if (isset($_GET['uid'])) {
    $tid = $_GET['uid'];
} else if (isset($_POST['uid'])) {
    $tid = $_POST['uid'];
} else {
    //do nothing
}
if (isset($tid)) {
    $sql = "select * from users where  id='{$tid}' ";
} else {
    $sql = "select * from users where status = '1' and (first_name<>'' OR last_name<>'') order by id asc";
}

$dbl = new db();

$data = $dbl->getRowAssoc($sql);

if ($data) {

    $renda = new renderer();

    echo $renda->render("json", $data, "users,<list></list>");

}