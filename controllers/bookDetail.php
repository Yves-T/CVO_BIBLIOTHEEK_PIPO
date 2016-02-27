<?php
// controller for book detail

include_once "models/Book_Table.class.php";
include_once "models/Author_Table.class.php";

$bookTable = new Book_Table($db);
$book = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $bookId = $_POST['bookId'];
    $authorId = $_POST['authorId'];
    $bookTable->connectBookToAuthor($authorId, $bookId);

    // fetch the connected book details
    $bookStatement = $bookTable->getBookDetail($bookId);
    $book = $bookStatement->fetchObject();

    // let the user know that book and author are connected
    $okMessage = "$book->title is nu gekoppeld aan $book->firstname&nbsp;$book->lastname.";
    $okMessage .= " <a href='index.php?page=listBooks'>Keer terug naar de lijst met boeken</a>";
} else {
    $bookId = $_GET['bookId'];
}

if (empty($book)) {
    $book = $bookTable->getBookDetail($bookId)->fetchObject();
}

$authorTable = new Author_Table($db);
$authorsWithoutBooks = $authorTable->getAuthorsWithoutBooks();

$view = include_once "views/admin/book_detail_html.php";
return $view;
