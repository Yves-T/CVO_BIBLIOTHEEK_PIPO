<?php
// controller for author list
include_once "models/Author_Table.class.php";
$authorTable = new Author_Table($db);
$authors = $authorTable->getAllAuthors();
$authorList = include_once "views/admin/authorList_html.php";
return $authorList;
