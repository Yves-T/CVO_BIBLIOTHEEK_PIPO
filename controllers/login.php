<?php
// controller for login form
include_once "models/Admin_Table.class.php";
$view = include_once "views/admin/login_form_html.php";

unset($_SESSION[LOGINERROR]);

$loginFormSubmitted = isset($_POST['log-in']);
if ($loginFormSubmitted) {
//    $admin->login();
    $email = $_POST['email'];
    $password = $_POST['password'];
    //create an object for communicating with the database table
    $adminTable = new Admin_Table($db);
    try {
        //try to login user
        $validLogin = $adminTable->checkCredentials($email, $password);
        if ($validLogin) {
            $admin->login();
        } else {
            $_SESSION[LOGINERROR] = "Login poging mislukt";
            $errorMessage = "Login poging mislukt";
        }
//        $admin->login();
    } catch (Exception $e) {
        //login failed
        echo "<pre>", var_dump($e), "</pre>";
    }
}

if ($admin->isLoggedIn()) {
    $view = "";
}
$errorMessage = "Login poging mislukt";

return $view;