<?php

// view for author list

$response = "<table class=\"table table-striped\" id=\"allResultsTable\">
    <thead>
    <tr>
        <th>#</th>
        <th>Autheur</th>
    </tr>
    </thead>
    <tbody>";

while ($author = $authors->fetchObject()) {
    $authorDetailLink = "index.php?page=authorDetail&amp;authorId=$author->id";
    $response .= " <tr>";
    $response .= "<td>" . $author->id . "</td>";
    $response .= "<td><a href='" . $authorDetailLink . "'>" . $author->firstname . ' ' . $author->lastname . "</a></td>";
    $response .= " </tr>";
}
$response .= "</tbody>";
$response .= "</table>";
return $response;
