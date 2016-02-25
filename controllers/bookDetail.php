<?php
// controller for book detail
$bookId = $_GET['bookId'];

include_once "models/Book_Table.class.php";
$bookTable = new Book_Table($db);
$book = $bookTable->getBookDetail($bookId)->fetchObject();

$view = include_once "views/admin/book_detail_html.php";
return $view;
