<?php
// view for adding a member

$response = "";
$response .= "<div class='row'>
<div class=\"col-sm-6 col-sm-offset-3\">
 <h1><span class=\"fa fa-user\"></span> $formTitle</h1>";

if (isset($okMessage)) {
    $response .= '<div class="alert alert-success">' . $okMessage . ' </div>';
}

if (isset($errorMessage)) {
    $response .= '<div class="alert alert-danger">' . $errorMessage . ' </div>';
}

if (isset($notOkMessage)) {
    $response .= '<div class="alert alert-danger">' . $notOkMessage . ' </div>';
}


$response .= "

<form method='post' action='$formUrl'>
      <div class=\"form-group\">
        <label>Voornaam</label>
        <input type='text' class=\"form-control\" name='voornaam' data-validation=\"required\"";

if (isset($formData['voornaam'])) {
    $response .= " value = " . $formData['voornaam'];
}

$response .= "
        data-validation-error-msg=\"Gelieve een voornaam in te vullen!\" required/>
       </div>

        <div class=\"form-group\">
        <label>Achternaam</label>
        <input type='text' name='lastName'  class=\"form-control\" data-validation=\"required\"";

if (isset($formData['lastName'])) {
    $response .= " value = " . $formData['lastName'];
}

$response .= "
        data-validation-error-msg=\"Gelieve een achternaam in te vullen!\" required/>
        </div>
        
        <div class=\"form-group\">
        <label>Straat naam</label>
        <input type='text' name='streetName' class=\"form-control\" data-validation=\"required\"";

if (isset($formData['streetName'])) {
    $response .= " value = " . $formData['streetName'];
}

$response .= "
        data-validation-error-msg=\"Gelieve een straatnaam in te vullen!\" required/>
        </div>
        
        <div class=\"form-group\">
        <label>Huisnummer</label>
        <input type='text' name='streetNumber' class=\"form-control\" data-validation=\"required number\"";

if (isset($formData['streetNumber'])) {
    $response .= " value = " . $formData['streetNumber'];
}

$response .= "
        data-validation-error-msg=\"Gelieve een huisnummer in te vullen!\" required/>
        </div>
        
        <div class=\"form-group\">
        <label>Gemeente</label>
        <input type='text' name='memberCity'  data-validation=\"required\"
          class=\"form-control\" id='membeCity'
           data-validation-error-msg=\"Gelieve een gemeente in te vullen!\"";

if (isset($formData['memberCity'])) {
    $response .= " value = " . $formData['memberCity'];
}

$response .= "
		  required/>
        </div>

        <div class=\"form-group\">
        <label>Postcode</label>
        <input type='text' name='memberZip'  data-validation=\"required number length\"
          class=\"form-control\" id='memberZip' data-validation-length=\"4-4\"";

if (isset($formData['memberZip'])) {
    $response .= " value = " . $formData['memberZip'];
}

$response .= "
           data-validation-error-msg=\"Gelieve een geldige postcode in te vullen!\"
		  required/>
        </div>";

if (isset($member)) {
    $response .= "<input type='hidden' name='memberId' value='$member->id'>";
}

$response .= "
        
        
        <input type='submit' class=\"btn btn-warning btn-lg\" value='$buttonText' name='new-member'/>
</form>
</div>
</div>

<script src=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js\"></script>
<script src='js/createAdminFormValidation.js'></script>
<script src='js/zipAutoComplete.js'></script>
";

return $response;