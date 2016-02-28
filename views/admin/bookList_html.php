<?php

// view for book list
$results = [];
while ($book = $books->fetchObject()) {
    array_push($results, $book);
}

if (count($results) < 1) {
    $response .= '<div class="container">';
    $response .= '<div class="alert alert-warning">' . "Geen resultaten beschikbaar." . ' </div>';
    $response .= "<button class='btn btn-default' onclick=\"goBack()\">Ga terug</button>";
    $response .= '</div>';
    $response .= "<script src='js/goBack.js'></script>";
} else {
    $response = "
    <div class='container'>
    <table class=\"table table-striped\" id=\"allResultsTable\">
    <thead>
    <tr>
        <th>#</th>
        <th>Titel</th>
        <th>Aanpassen</th>
        <th>Verwijderen</th>
    </tr>
    </thead>
    <tbody>";
    $resultCounter = 0;
    foreach ($results as $book) {
        $bookDetailLink = "index.php?page=bookDetail&amp;bookId=$book->id";
        $response .= " <tr>";
        $response .= "<td>" . $book->id . "</td>";
        $response .= "<td><a href='" . $bookDetailLink . "'>" . $book->title . "</a></td>";
        $response .= "<td>";
        $response .= " <a href=\"index.php?page=updateBook&bookId=" . $book->id . "\" class=\"btn btn-success\">";
        $response .= "Aanpassen</a>";
        $response .= "</td>";
        $response .= "<td class=\"delete\" id='$book->id'><input id='" . $book->id . "' type=\"submit\" class=\"btn btn-danger\" value=\"verwijderen\"></td>";
        $response .= " </tr>";
        $resultCounter++;
    }
    $response .= "</tbody>";
    $response .= "</table>";
    $response .= "<a href='index.php?page=addBook' class='btn btn-warning'>Boek toevoegen</a>";
    $response .= "</div>";
    $response .= "<script src=\"js/handleBookDelete.js\"></script>";
}

return $response;
