<?php
// controller for searching a member
include_once "models/Member_Table.class.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // the form is posted, so load the member list with search results
    $searchFilter = $_POST['searchFilter'];
    $searchTerm = $_POST['searchTerm'];

    // map combo to db column
    switch ($searchFilter) {
        case 1:
            $dbColumn = "firstname";
            break;
        case 2:
            $dbColumn = "lastname";
            break;
        case 3:
            $dbColumn = "street";
            break;
        case 4:
            $dbColumn = "name";
            break;
        case 5:
            $dbColumn = "zipcode";
            break;
        default:
            $dbColumn = "firstname";
    }

    $memberTable = new Member_Table($db);
    $members = $memberTable->searchMember($dbColumn, $searchTerm);

    $searchMemberView = include_once "views/admin/memberList_html.php";
} else {
    // this is a GET request, so show the search form
    $searchMemberView = include_once "views/admin/searchMember_html.php";
}

// return a view for this controller
return $searchMemberView;
