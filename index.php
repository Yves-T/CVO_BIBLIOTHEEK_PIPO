<?php
include_once "models/DB.class.php";

// set application variables
define("LOGINERROR", "Login_error");
$db = DB::get();

// set up page data
include_once 'models/Page_Data.class.php';
$pageData = new Page_Data();
$pageData->title = "Bibliotheek";
$pageData->addCSS('css/style.css');
$pageData->addCSS('css/font-awesome.min.css');
$pageData->addCSS('css/bootstrap.min.css');
$pageData->addCSS('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css');
$pageData->addScript('js/jquery.min.js');
$pageData->addScript('js/bootstrap.min.js');
$pageData->addScript('js/script.js');
$pageData->content = "<h1>$pageData->title</h1>";

include_once "models/Admin_User.class.php";
// create an admin user to handle security
$admin = new Admin_User();

// if user is logging out handle logout form
if (isset($_GET['logout'])) {
    $pageData->content = include_once "controllers/logout.php";
} else {

// load the login controller, which will show the login form
    $pageData->content = include_once "controllers/login.php";


// show admin module only if user is logged in
    if ($admin->isLoggedIn()) {
        $pageData->content .= include_once "views/admin/adminNavigation.php";
        $navigationIsClicked = isset($_GET['page']);
        if ($navigationIsClicked) {
            $controller = $_GET['page'];
        } else {
            $controller = "intro";
        }
        $pathToController = "controllers/$controller.php";
        $pageData->content .= include_once $pathToController;
    }
}

$pageData->content .= include_once "views/admin/footer.php";

// view
$page = include_once "views/page.php";

// view and model
echo $page;
