<?php

include_once "../models/DB.class.php";
include_once "../models/Book_Table.class.php";

$db = DB::get();

$json = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['id'])) {
        $bookTable = new Book_Table($db);
        $imageToDelete = $bookTable->deleteBook($_POST['id']);
        // if there is an image to the book attached, delete it.
        if (isset($imageToDelete) && !empty($imageToDelete)) {
            unlink('../img/' . $imageToDelete);
        }
    }

    $json = json_encode($_POST);
} else {
    $json = json_encode('NOK');
}

echo $json;
