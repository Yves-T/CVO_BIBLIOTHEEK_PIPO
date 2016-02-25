<?php
$navigationIsClicked = isset($_GET['page']);
$currentPage = "personal";

if ($navigationIsClicked) {
    // set the current page that was clicked in the navigation
    $currentPage = $_GET['page'];
}

$response = "
<nav class=\"navbar navbar-default\">
<div class=\"container-fluid\">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class=\"navbar-header\">
        <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
        <span class=\"sr-only\">Toggle navigation</span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        </button>
        <a class=\"navbar-brand\" href=\"#\">Bibliotheek</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
    <ul class=\"nav navbar-nav\">

    <li class=\"dropdown\">
          <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\"
           aria-expanded=\"false\">Boeken <span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\">
            <li><a href='index.php?page=listBooks'>Lijst boeken</a></li>
          </ul>
     </li>

    <li
    ";
$response .= "class='" . (($currentPage == 'personal') ? 'active' : '') . "' ";
$response .= "
    ><a href='index.php?page=personal'>Persoonlijke gegevens</a></li>
    <li
    ";
$response .= "class='" . (($currentPage == 'education') ? 'active' : '') . "' ";
$response .= "
    ><a href='index.php?page=education'>Gevolgde opleidingen</a></li>
    <li
    ";
$response .= "class='" . (($currentPage == 'projects') ? 'active' : '') . "' ";
$response .= "
    ><a href='index.php?page=projects'>Gemaakte projecten</a></li>
    <li>
    <a href='index.php?page=users'>Create admin user</a>
    </li>
    ";

$response .= "
    <li>
    <a href='index.php?logout=true'>Uitloggen</a>
    </li>";

$response .= "
    </ul>

    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>
";

return $response;