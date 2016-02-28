<?php
// log in form for admin
$response = "";
$response .= " <nav class=\"navbar navbar-default\">
<div class=\"container-fluid\">
 
     <div class=\"navbar-header\">
        <a class=\"navbar-brand\" href=\"#\"> Bibliotheek</a>
    </div>
   </div><!-- /.container-fluid -->
    </nav>
 
 <div class='row'>
 <div class=\"col-sm-6 col-sm-offset-3\">
 <h1>Welkom bij bibliotheek PIPO</h1>
 <h1><span class=\"fa fa-sign-in\"></span> Inloggen</h1>";

if (isset($_SESSION[LOGINERROR])) {
    $response .= '<div class="alert alert-danger">' . $_SESSION[LOGINERROR] . ' </div>';
    unset($_SESSION[LOGINERROR]);
}

$response .= "

 <form method='post' action='index.php'>
 <div class=\"form-group\">
    <p>Login om toegang te verkrijgen tot de bibiliotheek</p>
    <div class=\"form-group\">
    <label>e-mail</label>
    <input type='text' name='email'  class=\"form-control\" data-validation=\"email\" 
    data-validation-error-msg=\"Er is geen gelig email adres ingevuld!\"
    required />
    </div>
    
    <div class=\"form-group\">
    <label>password</label>
    <input type='password' name='password' class=\"form-control\"
    data-validation-error-msg=\"Er is geen paswoord ingevuld!\"
     data-validation=\"required\" 
    required />
    </div>
    
    <input type='submit'  class=\"btn btn-warning btn-lg\" value='login' name='log-in' />
</form>
<script src=\"//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js\"></script>
<script src='js/createAdminFormValidation.js'></script>
</div>
</div>
";

return $response;
