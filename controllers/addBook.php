<?php
// controller for add book

// fetch categories from the database
include_once "models/Category_Table.class.php";
include_once "models/Book_Table.class.php";
$categoryTable = new Category_Table($db);
$categories = $categoryTable->getAllCategories();


//is form submitted?
$addBookFormSubmitted = isset($_POST['add-book']);

//if it is...
if ($addBookFormSubmitted) {
    echo "<pre>", var_dump($_POST), "</pre>";
    $bookTable = new Book_Table($db);
    $bookTable->addBook($_POST);
}

// init variables for submit
$buttonText = "Toevoegen boek";
$submitName = "add-book";
$pageName = "addBook";

// return a view for this controller
$addBook = include_once "views/admin/bookForm_html.php";
return $addBook;
