<?php

include_once "../models/DB.class.php";
include_once "../models/Member_Table.class.php";

$db = DB::get();

$json = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['id'])) {
        // delete member
        $memberTable = new Member_Table($db);
        $memberTable->deleteMember($_POST['id']);
    }

    $json = json_encode($_POST);
} else {
    $json = json_encode('NOK');
}

echo $json;
