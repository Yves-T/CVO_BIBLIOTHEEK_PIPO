<?php

// view for book list

$response = "<table class=\"table table-striped\" id=\"allResultsTable\">
    <thead>
    <tr>
        <th>#</th>
        <th>Titel</th>
    </tr>
    </thead>
    <tbody>";

while ($book = $books->fetchObject()) {
    $bookDetailLink = "index.php?page=bookDetail&amp;bookId=$book->id";
    $response .= " <tr>";
    $response .= "<td>" . $book->id . "</td>";
    $response .= "<td><a href='" . $bookDetailLink . "'>" . $book->title . "</a></td>";
    $response .= " </tr>";
}
$response .= "</tbody>";
$response .= "</table>";
return $response;
