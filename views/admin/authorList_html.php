<?php

// view for author list

$response = "
<div class='container'>
<table class=\"table table-striped\" id=\"allResultsTable\">
    <thead>
    <tr>
        <th>#</th>
        <th>Autheur</th>
        <th>Aanpassen</th>
        <th>Verwijderen</th>
    </tr>
    </thead>
    <tbody>";

while ($author = $authors->fetchObject()) {
    $authorDetailLink = "index.php?page=authorDetail&amp;authorId=$author->id";
    $response .= " <tr>";
    $response .= "<td>" . $author->id . "</td>";
    $response .= "<td><a href='" . $authorDetailLink . "'>" . $author->firstname . ' ' . $author->lastname . "</a></td>";
    $response .= "<td>";
    $response .= " <a href=\"index.php?page=updateAuthor&authorId=" . $author->id . "\" class=\"btn btn-success\">";
    $response .= "Aanpassen</a>";
    $response .= "</td>";
    $response .= "<td class=\"delete\" id='$author->id'><input id='" . $author->id;
    $response .= "' type=\"submit\" class=\"btn btn-danger\" value=\"verwijderen\"></td>";
    $response .= " </tr>";
}
$response .= "</tbody>";
$response .= "</table>";
$response .= "</div>";
$response .= "<script src=\"js/handleAuthorDelete.js\"></script>";
return $response;
