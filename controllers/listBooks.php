<?php
// controller for book list
include_once "models/Book_Table.class.php";
$bookTable = new Book_Table($db);
$books = $bookTable->getAllBooks();
$bookList = include_once "views/admin/bookList_html.php";
return $bookList;
