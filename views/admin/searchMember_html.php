<?php

// view for searching a member
$response = "";
$response .= "<div class='row'>
<div class=\"col-sm-6 col-sm-offset-3\">
 <h1><span class=\"fa fa-search\"></span> Zoek een lid</h1>";

$response .= " 

<form method='post' action='index.php?page=searchMember'>
      <div class=\"form-group\">
        <label>Zoeken naar een lid op basis van</label>
        <select name='searchFilter' id='searchTerm' class=\"form-control\" >
        <option value='1'>voornaam</option>
        <option value='2'>achternaam</option>
        <option value='3'>straat</option>
        <option value='4'>plaats</option>
        <option value='5'>postcode</option>
        </select>
       </div>
       
        <div class=\"form-group\">
        <label>Zoekterm</label>
        <input type='text' name='searchTerm'  class=\"form-control\" data-validation=\"required\" 
        data-validation-error-msg=\"Er is geen zoekterm ingevuld\" required/>
        </div>
           
        <input type='submit' class=\"btn btn-warning btn-lg\" value='Zoek lid' name='search-member'/>
</form>
</div>
</div>

<script src=\"//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js\"></script>
<script src='js/createAdminFormValidation.js'></script>
";

// return the view to the browser
return $response;
