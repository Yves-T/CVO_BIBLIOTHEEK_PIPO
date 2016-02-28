<?php
// view for member list

$response = "";
$response .= '<div class="container">';
$response .= '<h1>Leden lijst</h1>';
$results = [];
while ($member = $members->fetchObject()) {
    array_push($results, $member);
}

if (count($results) < 1) {

    $response .= '<div class="alert alert-warning">' . "Geen resultaten beschikbaar." . ' </div>';
    $response .= "<button class='btn btn-default' onclick=\"goBack()\">Ga terug</button>";
    $response .= '</div>';
    $response .= "<script src='js/goBack.js'></script>";
} else {
    $response .= "
<table class=\"table table-striped\" id=\"allResultsTable\">

    <thead>
    <tr>
        <th>#</th>
        <th>Naam</th>
        <th>Aanpasen</th>
        <th>Verwijderen</th>
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
    $response .= "<a href='index.php?page=addMember' class='btn btn-warning'>Lid toevoegen</a>";
    $response .= "</div>";
    $response .= "<script src=\"js/handleMemberDelete.js\"></script>";
}

// return view to the browser
return $response;
