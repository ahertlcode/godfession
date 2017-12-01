<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header('Content-Type: text/json');
ini_set('memory_limit', '1024M');
require 'utilities/db.php';
require 'utilities/renderer.php';

if (isset($_GET['news_id'])) {
    $tid = $_GET['uid'];
} else if (isset($_POST['news_id'])) {
    $tid = $_POST['uid'];
} else {
    //do nothing
}
if (isset($tid)) {
    $sql = "select * from emailtemplates where  id='{$tid}' ";
} else {
    $sql = "select * from emailtemplates order by id asc";
}

$dbl = new db();

$data = $dbl->getRowAssoc($sql);

if ($data) {

    $renda = new renderer();

    echo $renda->render("json", $data, "emails,<list></list>");

}