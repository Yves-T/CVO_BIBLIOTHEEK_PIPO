<?php
// controller for update author
include_once "models/Author_Table.class.php";

$authorTable = new Author_Table($db);

$authorId = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    echo "<pre>", var_dump($_POST), "</pre>";
    $authorId = $_POST['auhorId'];
    $authorTable->updateAuthor($_POST);

    $okMessage = "Auteur met success aangepast. ";
    $okMessage .= "<a href='index.php?page=listAuthors'>&nbsp;Keer terug naar de lijst met auteurs</a>";
} else {
    $authorId = $_GET['authorId'];
}

$book = $authorTable->getAuthorDetail($authorId)->fetchObject();
$book->author_id = $book->id;

// init variables for submit
$buttonText = "Auteur updaten";
$submitName = "update-author";
$pageName = "updateAuthor";
$formTitle = "Auteur updaten";

// return view for this controller
$updateAuthorView = include_once "views/admin/authorForm_html.php";
return $updateAuthorView;
