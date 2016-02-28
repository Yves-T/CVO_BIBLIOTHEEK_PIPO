<?php
// controller for member detail
include_once "models/Member_Table.class.php";
$memberTable = new Member_Table($db);

if (isset($_GET['memberId'])) {
    $member = $memberTable->getMemberById($_GET['memberId'])->fetchObject();
}

// return view for controller
$memberDetailView = include_once "views/admin/memberDetail_html.php";
return $memberDetailView;
