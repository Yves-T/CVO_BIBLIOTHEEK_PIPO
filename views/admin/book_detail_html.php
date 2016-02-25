<?php
// view for book details

include_once "utility/formatFunctions_inc.php";

// there are no books found. Tell user about it.
if (!isset($book)) {
    $response = "
    <div class=\"alert alert-warning\" role=\"alert\">Er zijn geen details beschikbaar voor dit boek</div>";
} else {
// book details available, so show them to the user.
    $response = " 
<div class=\"container\">
<div class='row'>
    <div class=\"col-md-9\">

        <div class=\"thumbnail\">
            <div class=\"caption-full\">
                <h3 class=\"pull-right\">&euro;&nbsp;";
    $response .= convertDecimalPoint($book->price);
    $response .= "</h4>
                <h3>Boek titel: $book->title</h3>
                <p><strong>Autheur:</strong>&nbsp;$book->firstname&nbsp;$book->lastname</p>
                <p><strong>Categorie:</strong>&nbsp;$book->category_description</p>
                <h4>Korte omschrijving</h4>
                <div>$book->shortcontent</div>
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
return $response;