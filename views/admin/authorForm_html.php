<?php
// view for author form

$response = "";

if (isset($notOkMessage)) {
    $response .= '<div class="alert alert-danger">' . $notOkMessage . ' </div>';
} else {

    $response .= "
<div class='row'>
<div class=\"col-sm-6 col-sm-offset-3\">";

    if (isset($okMessage)) {
        $response .= '<div class="alert alert-success">' . $okMessage . ' </div>';
    } else {

    $response .= "
<h1><span class=\"fa fa-pencil\"></span> $formTitle</h1>
";
    $response .= "

 <form method='post' action='index.php?page=$pageName'  enctype='multipart/form-data'>
 ";

    $response .= "
    
     <fieldset>
    <legend>Auteur informatie:</legend>
    <!--author first name-->
    <div class=\"form-group\">
    <label>Voornaam auteur</label>
    <input type='text' name='authorFirstName'  class=\"form-control\" data-validation=\"required\" 
    data-validation-error-msg=\"Gelieve de voornaam van de auteur in te vullen!\"";

    if (isset($book->firstname)) {
        $response .= " value='$book->firstname'";
    }

    $response .= "
    required />
    </div>
    
    <!--author last name-->
    <div class=\"form-group\">
    <label>Achternaam auteur</label>
    <input type='text' name='authorLastName'  class=\"form-control\" data-validation=\"required\" 
    data-validation-error-msg=\"Gelieve de achternaam van de auteur in te vullen!\"";

    if (isset($book->lastname)) {
        $response .= " value='$book->lastname'";
    }

    $response .= "
    required />
    </div>
    
     <!--author biography-->
    <div class=\"form-group\">
    <label>Auteur biografie</label>
    <textarea class=\"form-control\" id='authorBiographyEditor' rows=\"3\" name='authorBiography' >";

    if (isset($book->biography)) {
        $response .= $book->biography;
    }

    $response .= "</textarea>
    </div>
    </fieldset>";
    if (isset($book)) {
        $response .= "<input type='hidden' name='auhorId' value='$book->author_id'>";
        $response .= "<input type='hidden' name='bookId' value='$book->id'>";
    }

    $response .= "
    <input type='submit' id='submit' class=\"btn btn-warning btn-lg\" value='$buttonText' name='$submitName' />
</form>
<script type='text/javascript' src='js/tinymce/tinymce.min.js'> </script>
<script src='js/initAuthorTinyMce.js'></script>
<script src=\"//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js\"></script>
<script src='js/addAuthorValidation.js'></script>
</div>
</div>";
    }
    $response .= "
</div>
</div>
";
}
return $response;
