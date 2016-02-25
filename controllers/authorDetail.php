<?php
// controller for author detail
$authorId = $_GET['authorId'];

include_once "models/Author_Table.class.php";
$authorTable = new Author_Table($db);
// fetch al authors from db
$author = $authorTable->getAuthorDetail($authorId)->fetchObject();

// supply view for browser
$view = include_once "views/admin/author_detail_html.php";
return $view;
