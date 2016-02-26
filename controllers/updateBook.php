<?php
// controller for updating a book

include_once "models/Category_Table.class.php";
include_once "models/Book_Table.class.php";

function setErrorMessage()
{
    $notOkMessage = "Kan het boek niet vinden";
    $notOkMessage .= "<a href='index.php?page=listBooks'>Keer terug naar de lijst met boeken</a>";
    return $notOkMessage;
}

$categoryTable = new Category_Table($db);
$categories = $categoryTable->getAllCategories();

// if  the user has submitted the update book form
if ($_SERVER['REQUEST_METHOD'] == "POST") {

} else {
    // it was a GET request so fetch book and author details to populate the form

    // if there was a book id, fetch the book details from db
    if (isset($_GET['bookId'])) {
        $bookTable = new Book_Table($db);
        $book = $bookTable->getBookDetail($_GET['bookId'])->fetchObject();
        // if there was no book found set not ok message
        if (isset($book) && !$book) {
            $notOkMessage = setErrorMessage();
        }
    } else {
        $notOkMessage = setErrorMessage();
    }
}

// init variables for submit
$buttonText = "Updaten boek";
$submitName = "update-book";
$pageName = "updateBook";

// return a view for this controller
$updateBook = include_once "views/admin/bookForm_html.php";
return $updateBook;
