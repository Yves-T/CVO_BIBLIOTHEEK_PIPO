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
    <div class=\"col-md-9\">";


    if (isset($okMessage)) {
        $response .= '<div class="alert alert-success">' . $okMessage . ' </div>';
    }

    $response .= "

        <div class=\"thumbnail\">
            <div class=\"caption-full\">";

    $response .= "
                <h3>Details voor autheur: &nbsp;$author->firstname&nbsp;$author->lastname</h3>
                <h4><strong>Autheur biografie:</strong></h4>
                <div>$author->biography</div>";
    if (isset($author->title)) {
        $response .= "
                <div id='bookList'>
                <h4><strong>Boeken:</strong></h4>
                <ul>
                    <li id='$author->id'>$author->title&nbsp;";

        if (!isset($okMessage)) {
            $response .= "<input id='$author->id' type=\"submit\" class=\"btn btn-danger btn-sm delete\"";
            $response .= "value=\"Loskoppelen\">";
        }

        $response .= "
                    </li>
                </ul>
                </div>
                <div id='removeBookOk'>
                <div class=\"alert alert-success\">
                Boek met success losgekoppeld.&nbsp;
                <a href='index.php?page=listAuthors'>Keer terug naar de lijst met autheurs</a>
                </div>
                </div>
                ";
    } else {
        $response .= "Voor deze autheur zijn geen boeken beschikbaar.";

        // form to link author to a book
        $response .= "<h4><span class=\"fa fa-link\"></span> Autheur aan boek koppelen</h4>";
        $response .= "
 <form method='post' action='index.php?page=authorDetail'  enctype='multipart/form-data'>
 <div class=\"form - group\">
 <label>Lijst boeken zonder autheur</label>
    <select class=\"form-control\" name='bookId'>";

        while ($bookWithoutAuthor = $booksWithoutAuthor->fetchObject()) {
            $response .= "<option value='$bookWithoutAuthor->id'>$bookWithoutAuthor->title</option>";
        }

        $response .= "
        </select>
    </div>
    <input type='hidden' name='authorId' value='$author->id'>
    <input type='hidden' name='authorName' value='$author->firstname&nbsp;$author->lastname'>
    <input type='submit' id='submit' class=\"btn btn-warning btn-lg\" value='Koppel dit boek' name='connect-bookauthor' />
    </form>
 ";

    }

    $response .= "
            </div>
        </div>
    </div>
</div>
</div>
";
}

if (!isset($okMessage)) {
// attach a go back button
    $response .= "
<div class=\"container\"><div class='row'>
    <div class=\"col-md-9\">
    <button class='btn btn-default' onclick=\"goBack()\">Ga terug</button>";
    $response .= "<script src='js/goBack.js'></script>
        </div>
    </div>
</div>";
}

$response .= "<script src=\"js/handleBookRemoveFromAuthor.js\"></script>";

// return view content
return $response;
