<?php
// controller for author detail

include_once "models/Author_Table.class.php";
include_once "models/Book_Table.class.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // this request was a POST request, so lets connect the book to the author
    $authorId = $_POST['authorId'];
    $bookId = $_POST['bookId'];
    $authorName = $_POST['authorName'];
    $bookTable = new Book_Table($db);
    $bookTable->connectBookToAuthor($authorId, $bookId);

    // fetch the connected book details
    $book = $bookTable->getBookDetail($bookId)->fetchObject();

    // let the user know that the book has been added
    $okMessage = "$book->title is nu gekoppeld aan $book->firstname&nbsp;$book->lastname.";
    $okMessage .= " <a href='index.php?page=listAuthors'>Keer terug naar de lijst met boeken</a>";
} else {
    $authorId = $_GET['authorId'];
}

$authorTable = new Author_Table($db);
// fetch al authors from db
$author = $authorTable->getAuthorDetail($authorId)->fetchObject();
$bookTable = new Book_Table($db);
$booksWithoutAuthor = $bookTable->getBooksWithoutAuthor();

// supply view for browser
$view = include_once "views/admin/author_detail_html.php";
return $view;
