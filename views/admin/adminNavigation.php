<?php
$navigationIsClicked = isset($_GET['page']);
$currentPage = "schrijvers";

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
        <a class=\"navbar-brand\" href=\"index.php\">Bibliotheek pipo</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
    <ul class=\"nav navbar-nav\">

    <li class=\"dropdown
     ";
$bookDropDown = $currentPage == 'listBooks' || $currentPage == 'bookDetail' || $currentPage == 'addBook'
    || $currentPage == 'loanBooks';
$response .= (($bookDropDown) ? ' active' : '');

$response .= "\">
          <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\"
           aria-expanded=\"false\">Boeken <span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\">
            <li><a href='index.php?page=listBooks'>Lijst boeken</a></li>
            <li><a href='index.php?page=addBook'>Boek toevoegen</a></li>
            <li><a href='index.php?page=searchBook'>Boek zoeken</a></li>
            <li><a href='index.php?page=loanBooks'>Lijst met uitgeleende boeken</a></li>
            <li><a href='index.php?page=graphBooks'>Grafiek aantal boeken per categorie</a></li>
          </ul>
     </li>
    ";

$response .= "<li class=\"dropdown";

$writersDropDown = $currentPage == 'listAuthors' || $currentPage == 'authorDetail' || $currentPage == "addAuthor";
$response .= (($writersDropDown) ? ' active' : '');

$response .= "\">
          <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\"
           aria-expanded=\"false\">Auteur <span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\">
            <li><a href='index.php?page=listAuthors'>Lijst auteurs</a></li>
            <li><a href='index.php?page=addAuthor'>Auteur toevoegen</a></li>
          </ul>
     </li>";

$response .= "<li class=\"dropdown";
$memberDropDown = $currentPage == 'addMember' || $currentPage == 'memberList' || $currentPage == "searchMember";
$response .= (($memberDropDown) ? ' active' : '');

$response .= "\">
          <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\"
           aria-expanded=\"false\">Leden <span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\">
            <li><a href='index.php?page=memberList'>Lijst met leden</a></li>
            <li><a href='index.php?page=addMember'>Voeg lid toe</a></li>
            <li><a href='index.php?page=searchMember'>Lid zoeken</a></li>
          </ul>
     </li>";


$createAdminActive = ($currentPage == 'users') ? 'active' : '';

$response .= "
     <li class='$createAdminActive'>
        <a href='index.php?page=users'>Cre&euml;er bibliothecaris</a>
    </li>
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