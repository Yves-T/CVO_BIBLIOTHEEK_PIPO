<?php
// controller for creating a new admin
include_once "models/Admin_Table.class.php";


//is form submitted?
$createNewAdmin = isset($_POST['new-admin']);

//if it is...
if ($createNewAdmin) {
    //grab form input
    $newEmail = $_POST['email'];
    $newPassword = $_POST['password'];
    $adminTable = new Admin_Table($db);
    try {
        //try to create a new admin user
        $adminTable->create($newEmail, $newPassword);
        //tell user how it went
        $adminOKFormMessage = "Er is een nieuwe admin aangemaakt voor $newEmail!";
    } catch (Exception $e) {
        //if operation failed, tell user what went wrong
        $adminErrorFormMessage = $e->getMessage();
    }
}

$newAdminForm = include_once "views/admin/new_admin_form_html.php";
return $newAdminForm;