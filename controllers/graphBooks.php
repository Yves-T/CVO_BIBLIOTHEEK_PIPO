<?php
// controller for graph view
include_once "models/Book_Table.class.php";

$bookTable = new Book_Table($db);
$booksInCategory = $bookTable->getBooksInCategory();
// return view for this controller
$graphView = include_once "views/admin/books_category_graph_html.php";
return $graphView;