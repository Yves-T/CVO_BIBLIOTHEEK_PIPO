<?php
// controller for add book

// fetch categories from the database
include_once "models/Category_Table.class.php";
include_once "models/Book_Table.class.php";
include_once "models/Uploader.class.php";
$categoryTable = new Category_Table($db);
$categories = $categoryTable->getAllCategories();


//is form submitted?
$addBookFormSubmitted = isset($_POST['add-book']);

//if it is...
if ($addBookFormSubmitted) {

    $imageBaseName = "";
    // if there is an image uploaded
    if ($_FILES['bookImage']['size'] > 0) {
        // save it on the server
        $uploader = new Uploader('bookImage');
        $uploader->saveIn("img");
        $uploader->save();

        // create an image name for the db
        $imageBaseName = basename($_FILES['bookImage']['name']);
    }

    $bookTable = new Book_Table($db);
    $bookTable->addBook($_POST, $imageBaseName);

    $okMessage = "Boek met success toegevoegd. ";
    $okMessage .= "<a href='index.php?page=listBooks'>Keer terug naar de lijst met boeken</a>";
}

// init variables for submit
$buttonText = "Toevoegen boek";
$submitName = "add-book";
$pageName = "addBook";

// return a view for this controller
$addBook = include_once "views/admin/bookForm_html.php";
return $addBook;
