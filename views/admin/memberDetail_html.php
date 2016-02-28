<?php
// view for member detail

if (!isset($member)) {
    $response = "
    <div class=\"alert alert-warning\" role=\"alert\">Er zijn geen details beschikbaar voor dit lid.
    <a href='index.php?page=memberList'>Keer terug naar de ledenlijst</a></div>";
} else {
    $response = " 
<div class=\"container\">
<div class='row'>
    <div class=\"col-md-9\">";

    $response .= "

        <div class=\"thumbnail\">
            <div class=\"caption-full\">";

    $response .= "
                <h3>Details voor lid: &nbsp;$member->firstname&nbsp;$member->lastname</h3>
                <h4><strong>Adres</strong></h4>
                <dl>
                    <dt>Straat</dt>
                    <dd>$member->street&nbsp;$member->housenr</dd>
                    <dt>Woonplaats</dt>
                    <dd>$member->zipcode&nbsp;$member->name</dd>
</dl>";

    $response .= "
            </div>
        </div>
    </div>
</div>
</div>
";
}

// return the view to the browser
return $response;
