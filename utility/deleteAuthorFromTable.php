<?php

include_once "../models/DB.class.php";
include_once "../models/Book_Table.class.php";
include_once "../models/Author_Table.class.php";

$db = DB::get();

$json = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['id'])) {
        // first remove the FK from book
        $authorId = $_POST['id'];
        $bookTable = new Book_Table($db);
        $bookTable->removeAuthorFromBook($authorId);

        // then delete the author
        $authorTable = new Author_Table($db);
        $authorTable->deleteAuthor($authorId);
    }

    $json = json_encode($_POST);
} else {
    $json = json_encode('NOK');
}

echo $json;
