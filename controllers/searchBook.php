<?php
// controller for search book
include_once "models/Book_Table.class.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // the form is posted, so load the book list with search results
    $searchFilter = $_POST['searchFilter'];
    $searchTerm = $_POST['searchTerm'];

    switch ($searchFilter) {
        case 1:
            $dbColumn = "title";
            break;
        case 2:
            $dbColumn = "shortcomment";
            break;
        case 3:
            $dbColumn = "isbn";
            break;
        default:
            $dbColumn = "title";
    }

    $bookTable = new Book_Table($db);
    $books = $bookTable->searchBook($dbColumn, $searchTerm);

    $searchBookView = include_once "views/admin/bookList_html.php";
} else {
    // this is a GET request, so show the search form
    $searchBookView = include_once "views/admin/searchForm_html.php";
}


// return a view for this controller
return $searchBookView;
