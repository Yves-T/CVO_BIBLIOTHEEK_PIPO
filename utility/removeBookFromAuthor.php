<?php

include_once "../models/DB.class.php";
include_once "../models/Book_Table.class.php";

$db = DB::get();

$json = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['id'])) {
        // disconnect author from book
        $bookTable = new Book_Table($db);
        $bookTable->removeAuthorFromBook($_POST['id']);
    }

    $json = json_encode($_POST);
} else {
    $json = json_encode('NOK');
}

echo $json;
