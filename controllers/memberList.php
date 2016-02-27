<?php
// controller for member list
include_once "models/Member_Table.class.php";

$memberTable = new Member_Table($db);
$members = $memberTable->getAllMembers();

// return a view for this controller
$memberListView = include_once "views/admin/memberList_html.php";
return $memberListView;
