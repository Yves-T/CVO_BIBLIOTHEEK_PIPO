<?php
// controller for updating a book

include_once "models/Category_Table.class.php";
include_once "models/Book_Table.class.php";
include_once "models/Uploader.class.php";

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
    $updateBookFormSubmitted = isset($_POST['update-book']);

    if ($updateBookFormSubmitted) {
        echo "<pre>", var_dump($_POST), "</pre>";
        $bookTable = new Book_Table($db);
        $imageBaseName = "";
        // if there is an image uploaded
        if ($_FILES['bookImage']['size'] > 0) {

            // delete the old one

            $oldBook = $bookTable->getBookDetail($_POST['bookId'])->fetchObject();
            $oldImage = $oldBook->image;
            if (!empty($oldImage) && file_exists("img/" . $oldImage)) {
                unlink("img/" . $oldImage);
            }

            // save it on the server
            $uploader = new Uploader('bookImage');
            $uploader->saveIn("img");
            $uploader->save();

            // create an image name for the db
            $imageBaseName = basename($_FILES['bookImage']['name']);
        }

        $bookTable->updateBook($_POST, $imageBaseName);

        $okMessage = "Boek met success aamgepast. ";
        $okMessage .= "<a href='index.php?page=listBooks'>Keer terug naar de lijst met boeken</a>";
        $book = $bookTable->getBookDetail($_POST['bookId'])->fetchObject();
    }

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
$formTitle = "Updaten nieuw boek";

// return a view for this controller
$updateBook = include_once "views/admin/bookForm_html.php";
return $updateBook;
