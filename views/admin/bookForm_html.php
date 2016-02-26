<?php
// view for create form for adding a book
$response = "";

if (isset($notOkMessage)) {
    $response .= '<div class="alert alert-danger">' . $notOkMessage . ' </div>';
} else {

$response .= "
<div class='row'>
<div class=\"col-sm-6 col-sm-offset-3\">";

    if (isset($okMessage)) {
        $response .= '<div class="alert alert-success">' . $okMessage . ' </div>';
    }

$response .= "
<h1><span class=\"fa fa-book\"></span> Toevoegen nieuw boek</h1>
";
$response .= "

 <form method='post' action='index.php?page=$pageName'  enctype='multipart/form-data'>
 <div class=\"form-group\">
 
    <fieldset>
    <legend>Boek informatie:</legend>
 
    <!--boek titel-->
    <div class=\"form-group\">
    <label>Boek titel</label>
    <input type='text' name='bookTitle'  class=\"form-control\" data-validation=\"required\" 
    data-validation-error-msg=\"Gelieve de titel van het boek in te vullen!\"";

    if (isset($book->title)) {
        $response .= " value='$book->title'";
    }

    $response.="
    required />
    </div>

    <!--boek price-->
    <div class=\"form-group\">
    <label>Prijs</label>
    <input type='text' name='bookPrice' class=\"form-control\"
    data-validation-error-msg=\"Gelieve een geldige prijs in te vullen.! ( bv : 12,23 ) \"
    data-validation-allowing=\"float\"
     data-validation=\"number required\" ";

    if (isset($book->price)) {
        $response .= " value='$book->price'";
    }

$response .= "
    required />
    </div>
    
    <!--boek image-->
    <div class=\"form-group\">
    <label>Afbeelding boek</label>
    <input type='file' name='bookImage' class=\"form-control\"/>
    </div>

    <!--boek category-->
    <div class=\"form-group\">
    <label>Categorie</label>
    <select class=\"form-control\" name='bookCategory'>";

    // iterate over available categories
    while ($category = $categories->fetchObject()) {
        $response .= "<option value='$category->id'";
        if (isset($book->category_id) && $book->category_id == $category->id) {
            $response .= " selected ";
        }
        $response .= ">$category->category_description</option>";
    }

$response .= "
    </select>
    </div>
    
     <!--boek short comment-->
    <div class=\"form-group\">
    <label>Korte inhoud</label>
    <textarea id='shortCommentEditor' class=\"form-control\" rows=\"3\" name='bookShortDescription' >";

    if (isset($book->shortcontent)) {
        $response .= $book->shortcontent;
    }

$response .="</textarea>
    </div>
    </fieldset>
    
     <fieldset>
    <legend>Autheur informatie:</legend>
    <!--author first name-->
    <div class=\"form-group\">
    <label>Voornaam autheur</label>
    <input type='text' name='authorFirstName'  class=\"form-control\" data-validation=\"required\" 
    data-validation-error-msg=\"Gelieve de voornaam van de autheur in te vullen!\"";

    if (isset($book->firstname)) {
        $response .= " value='$book->firstname'";
    }

$response .= "
    required />
    </div>
    
    <!--author last name-->
    <div class=\"form-group\">
    <label>Achternaam autheur</label>
    <input type='text' name='authorLastName'  class=\"form-control\" data-validation=\"required\" 
    data-validation-error-msg=\"Gelieve de achternaam van de autheur in te vullen!\"";

    if (isset($book->lastname)) {
        $response .= " value='$book->lastname'";
    }

$response .= "
    required />
    </div>
    
     <!--author biography-->
    <div class=\"form-group\">
    <label>Autheur biografie</label>
    <textarea class=\"form-control\" id='authorBiographyEditor' rows=\"3\" name='authorBiography' >";

    if (isset($book->biography)) {
        $response .= $book->biography;
    }

$response .="</textarea>
    </div>
    </fieldset>
    
    <input type='submit' id='submit' class=\"btn btn-warning btn-lg\" value='$buttonText' name='$submitName' />
</form>
<script type='text/javascript' src='js/tinymce/tinymce.min.js'> </script>
<script src='js/initTinyMce.js'></script>
<script src=\"//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js\"></script>
<script src='js/addBookValidation.js'></script>
</div>
</div>
</div>
</div>
";
}
return $response;
