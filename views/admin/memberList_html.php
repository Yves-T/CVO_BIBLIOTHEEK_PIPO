<?php
// view for member list

$response = "";
$results = [];
while ($member = $members->fetchObject()) {
    array_push($results, $member);
}

if (count($results) < 1) {
    $response .= '<div class="alert alert-warning">' . "Geen resultaten beschikbaar." . ' </div>';
} else {
    $response .= "
<div class='container'>
<table class=\"table table-striped\" id=\"allResultsTable\">

    <thead>
    <tr>
        <th>#</th>
        <th>Naam</th>
    </tr>
    </thead>
    <tbody>";
    $resultCounter = 0;
    foreach ($results as $member) {
        $memberDetailLink = "index.php?page=memberDetail&amp;memberId=$member->id";
        $response .= " <tr>";
        $response .= "<td>" . $member->id . "</td>";
        $response .= "<td><a href='" . $memberDetailLink . "'>" . $member->firstname .' '. $member->lastname. "</a></td>";
        $response .= "<td>";
        $response .= " <a href=\"index.php?page=updateMember&memberId=" . $member->id . "\" class=\"btn btn-success\">";
        $response .= "Aanpassen</a>";
        $response .= "</td>";
        $response .= "<td class=\"delete\" id='$member->id'><input id='" . $member->id;
        $response .= "' type=\"submit\" class=\"btn btn-danger\" value=\"verwijderen\"></td>";
        $response .= " </tr>";
        $resultCounter++;
    }
    $response .= "</tbody>";
    $response .= "</table>";
    $response .= "</div>";
    $response .= "<script src=\"js/handleBookDelete.js\"></script>";
}

// return view to the browser
return $response;
