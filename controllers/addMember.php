<?php
// controller for adding a member

include_once "models/Member_Table.class.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // this was a POST request
    $memberTable = new Member_Table($db);
    // try to add the new member
    if ($memberTable->addMember($_POST)) {
        $okMessage = "Lid met success toegevoegd.";
        $okMessage .= "<a href='index.php?page=listBooks'>Keer terug naar de lijst met boeken</a>";
    } else {
        // add member failed so return an error message
        $errorMessage = "Kan de gemeente niet vinden.Gelieve de gegevens te kontroleren.";
        $formData = $_POST;
    }
}

// return a view for this controller
$addMemberView = include_once "views/admin/addMember_html.php";
return $addMemberView;
