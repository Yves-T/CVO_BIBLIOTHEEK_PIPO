<?php
// controller for adding an author
include_once "models/Author_Table.class.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // this request was a POST, so persist the new author data
    $authorTable = new Author_Table($db);
    $authorTable->addAuthor($_POST);

    $okMessage = "Autheur met success toegevoegd. ";
    $okMessage .= "<a href='index.php?page=listAuthors'>Keer terug naar de lijst met autheurs</a>";
}

// init variables for submit
$buttonText = "Autheur toevoegen";
$submitName = "add-author";
$pageName = "addAuthor";
$formTitle = "Autheur toevoegen";

// return a view for this controller
$addAuthor = include_once "views/admin/authorForm_html.php";
return $addAuthor;
