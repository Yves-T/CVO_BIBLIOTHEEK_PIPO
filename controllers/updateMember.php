<?php
include_once "models/Member_Table.class.php";

function setErrorMessage()
{
    $notOkMessage = "Kan het lid niet vinden";
    $notOkMessage .= "<a href='index.php?page=memberList'> Keer terug naar de lijst met leden.</a>";
    return $notOkMessage;
}

$memberTable = new Member_Table($db);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $memberId = $_POST['memberId'];
    $updateResult = $memberTable->updateMember($memberId, $_POST);

    if ($updateResult) {
        $okMessage = "Boek met success aamgepast. ";
        $okMessage .= "<a href='index.php?page=memberList'>Keer terug naar de lijst met leden</a>";
    } else {
        $errorMessage = "Er is iets mis met de postcode of de gemeente. Gelieve deze gegevens na te kijken.";
        $formData = $_POST;
    }

    $member = $memberTable->getMemberById($memberId)->fetchObject();

} else {
    // GET request so fetch member details
    echo "<pre>", var_dump($_GET), "</pre>";

    if (isset($_GET['memberId'])) {
        $member = $memberTable->getMemberById($_GET['memberId'])->fetchObject();

        // map db data to form data
        $formData['voornaam'] = $member->firstname;
        $formData['lastName'] = $member->lastname;
        $formData['streetName'] = $member->street;
        $formData['streetNumber'] = $member->housenr;
        $formData['memberCity'] = $member->name;
        $formData['memberZip'] = $member->zipcode;

        if (!isset($member) && !$member) {
            $notOkMessage = setErrorMessage();
        }
    } else {
        $notOkMessage = setErrorMessage();
    }
}

// set up page variables
$formTitle = " Lid updaten";
$buttonText = "Update lid";
$formUrl = "index.php?page=updateMember";

// return a view for this controller
$updateMemberView = include_once "views/admin/addMember_html.php";
return $updateMemberView;
