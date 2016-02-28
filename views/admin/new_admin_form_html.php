<?php

$response = "";
$response .= "<div class='row'>
<div class=\"col-sm-6 col-sm-offset-3\">
 <h1><span class=\"fa fa-plus\"></span> Maak een nieuwe bibliothecaris aan</h1>";
if (isset($adminErrorFormMessage)) {
    $response .= '<div class="alert alert-danger">' . $adminErrorFormMessage . ' </div>';
}

if (isset($adminOKFormMessage)) {
    $response .= '<div class="alert alert-success">' . $adminOKFormMessage;
    $response .= " Ga terug naar de <a href='index.php'>hoofdpagina</a>";
    $response .= " of gebruik de navigatiebalk bovenaan om naar een ander scherm te gaan.";
    $response .= '</div>';
} else {

    $response .= "

<form method='post' action='index.php?page=users'>
      <div class=\"form-group\">
        <label>e-mail</label>
        <input type='text' class=\"form-control\" name='email' data-validation=\"email\" 
        data-validation-error-msg=\"Er is geen gelig email adres ingevuld!\" required/>
       </div>
        <div class=\"form-group\">
        <label>paswoord</label>
        <input type='password' name='password'  class=\"form-control\" data-validation=\"required\" 
        data-validation-error-msg=\"Er is geen paswoord ingevuld!\" required/>
		 
        </div>
           <div class=\"form-group\">
        <label>paswoord controle</label>
        <input type='password' name='password_conf'  data-validation=\"confirmation\"
         data-validation-confirm=\"password\" class=\"form-control\"
           data-validation-error-msg=\"De paswoorden zijn niet gelijk!\"
		  required/>
        </div>
        <input type='submit' class=\"btn btn-warning btn-lg\" value='cre&euml;er admin' name='new-admin'/>
</form>";
}
$response .= "
</div>
</div>

<script src=\"//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js\"></script>
<script src='js/createAdminFormValidation.js'></script>
";

return $response;
