<?php

// view for book list

$response = "<table class=\"table table-striped\" id=\"allResultsTable\">
    <thead>
    <tr>
        <th>#</th>
        <th>Titel</th>
        <th>Verwijderen</th>
    </tr>
    </thead>
    <tbody>";

while ($book = $books->fetchObject()) {
    $bookDetailLink = "index.php?page=bookDetail&amp;bookId=$book->id";
    $response .= " <tr>";
    $response .= "<td>" . $book->id . "</td>";
    $response .= "<td><a href='" . $bookDetailLink . "'>" . $book->title . "</a></td>";
    $response .= "<td class=\"delete\" id='$book->id'><input id='" . $book->id . "' type=\"submit\" class=\"btn btn-danger\" value=\"verwijderen\"></td>";
    $response .= " </tr>";
}
$response .= "</tbody>";
$response .= "</table>";
$response .= "<script src=\"js/handleBookDelete.js\"></script>";
return $response;
