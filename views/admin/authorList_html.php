<?php

// view for author list
$response = '<div class="container">';
$response .= '<h1>Lijst met autheurs</h1>';

$results = [];
while ($author = $authors->fetchObject()) {
    array_push($results, $author);
}

if (count($results) < 1) {
    $response .= '<div class="container">';
    $response .= '<div class="alert alert-warning">';
    $response .= "Geen resultaten beschikbaar. Ga terug naar de <a href='index.php'>hoofdpagina</a>";
    $response .= " of gebruik de navigatiebalk bovenaan om naar een ander scherm te gaan.";
    $response .= ' </div>';
    $response .= '</div>';
} else {
$response .= "
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

foreach ($results as $author) {
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
$response .= "<a href='index.php?page=addAuthor' class='btn btn-warning'>Autheur toevoegen</a>";
}
$response .= "</div>";
$response .= "<script src=\"js/handleAuthorDelete.js\"></script>";
return $response;
