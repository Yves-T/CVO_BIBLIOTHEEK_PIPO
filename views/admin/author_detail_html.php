<?php
// view for book details

// there are no books found. Tell user about it.
if (!isset($author)) {
    $response = "
    <div class=\"alert alert-warning\" role=\"alert\">Er zijn geen details beschikbaar voor deze autheur</div>";
} else {
// book details available, so show them to the user.
    $response = " 
<div class=\"container\">
<div class='row'>
    <div class=\"col-md-9\">

        <div class=\"thumbnail\">
            <div class=\"caption-full\">";

    $response .= "
                <h3>Details voor autheur: &nbsp;$author->firstname&nbsp;$author->lastname</h3>
                <h4><strong>Autheur biografie:</strong></h4>
                <div>$author->biography</div>";
    if (isset($author->title)) {
        $response .= "
                <h4><strong>Boeken:</strong></h4>
                <ul>
                    <li>$author->title</li>
                </ul>";
    } else {
        $response .= "Voor deze autheur zijn geen boeken beschikbaar.";
    }

    $response .= "
            </div>
        </div>
    </div>
</div>
</div>
";
}

// attach a go back button
$response .= "
<div class=\"container\"><div class='row'>
    <div class=\"col-md-9\">
    <button class='btn btn-default' onclick=\"goBack()\">Ga terug</button>";
$response .= "<script src='js/goBack.js'></script>
        </div>
    </div>
</div>";

// return view content
return $response;
