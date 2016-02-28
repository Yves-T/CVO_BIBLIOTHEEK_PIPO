<?php
// view for loan books
$lendBookResults = [];

$response = "
<div class='container'>
<h1>Lijst met uitgeleende boeken</h1>";

// copy database results to an array
while ($lendBook = $lendBooks->fetchObject()) {
    array_push($lendBookResults, $lendBook);
}

// if there are no results warn user about it.
if (count($lendBookResults) < 1) {
    $response .= '<div class="container">';
    $response .= '<div class="alert alert-warning">';
    $response .= "Geen resultaten beschikbaar. Ga terug naar de <a href='index.php'>hoofdpagina</a>";
    $response .= " of gebruik de navigatiebalk bovenaan om naar een ander scherm te gaan.";
    $response .= ' </div>';
    $response .= '</div>';

} else {
// there are results found, so show them
    $response .= "
<table class=\"table table-striped\" id=\"allResultsTable\">
    <thead>
    <tr>
        <th>Boek titel</th>
        <th>Uitgeleend door</th>
    </tr>
    </thead>
    <tbody>";

    // iterate over results
    foreach ($lendBookResults as $lendBook) {
        $response .= " <tr>";
        $response .= "<td>" . $lendBook->title . "</td>";
        $response .= "<td>" . $lendBook->firstname . ' ' . $lendBook->lastname . "</td>";
        $response .= " </tr>";
    }

    $response .= "</tbody>";
    $response .= "</table>";

}

$response .= "</div>";

// return view to the browser
return $response;
