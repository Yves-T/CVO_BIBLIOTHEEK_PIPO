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
    <div class=\"col-md-9\">";

    if (isset($okMessage)) {
        $response .= '<div class="alert alert-success">' . $okMessage . ' </div>';
    }

    $response .= "

        <div class=\"thumbnail\">
            <div class=\"caption-full\">
                <h3 class=\"pull-right\">&euro;&nbsp;";
    $response .= convertDecimalPoint($book->price);
    $response .= "</h4>
                <h3>Boek titel: $book->title</h3>
                ";
    if (!empty($book->image)) {
        $response .= "<img src='img/$book->image' alt='boek afbeelding'  width=\"100\">";
    }

    if (isset($book->firstname)) {
        $response .= "
                <p id='$book->author_id'><strong>Auteur:</strong>&nbsp;$book->firstname&nbsp;$book->lastname&nbsp;";

        if (!isset($okMessage)) {
            $response .= "<input id='$book->author_id' type=\"submit\" class=\"btn btn-danger btn-sm delete\"";
            $response .= "value=\"Loskoppelen\">";
        }

        $response .= "</p>

                <div id='removeBookOk'>
                <div class=\"alert alert-success\">
                Auteur met success losgekoppeld.&nbsp;
                <a href='index.php?page=listBooks'>Keer terug naar de lijst met boeken</a>
                </div>
                </div>
";
    } else {
        $response .= "<p><strong>Auteur:</strong> Er is geen auteur voor dit boek bekend op dit moment.</p>";
        $authorsWithoutBookResults = [];
        while ($authorWithoutBook = $authorsWithoutBooks->fetchObject()) {
            array_push($authorsWithoutBookResults, $authorWithoutBook);
        }

        // if there are authors without books, offer a choice
        if (count($authorsWithoutBookResults) > 0) {

        // form to link book to an author
        $response .= "<h4><span class=\"fa fa-link\"></span> Boek aan een auteur koppelen</h4>";
        $response .= "
 <form method='post' action='index.php?page=bookDetail'  enctype='multipart/form-data'>
 <div class=\"form-group\">
 <label>Lijst boeken zonder auteur</label>
    <select class=\"form-control\" name='authorId'>";

        foreach($authorsWithoutBookResults as $authorWithoutBook) {
            $response .= "<option value='$authorWithoutBook->id'>";
            $response .= "$authorWithoutBook->firstname&nbsp;$authorWithoutBook->lastname</option>";
        }

        $response .= "
        </select>
    </div>
    <input type='hidden' name='bookId' value='$book->id'>
    <input type='submit' id='submit' class=\"btn btn-warning btn-lg\" value='Koppel deze auteur' name='connect-authorbook' />
    </form>
 ";
        }

    }

    $response .= "
                <p><strong>Categorie:</strong>&nbsp;$book->category_description</p>
                <p><strong>ISBN nummer:</strong>&nbsp;$book->isbn</p>
                <h4>Korte omschrijving</h4>
                <div>$book->shortcontent</div>
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

return $response;