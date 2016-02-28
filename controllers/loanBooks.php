<?php
// controller for loan books
include_once "models/Loan_Table.class.php";
$loanTable = new Loan_Table($db);
$lendBooks = $loanTable->getLendBooks();

// return view for loan books
$loanBookViews = include_once "views/admin/loanBooks_html.php";
return $loanBookViews;
