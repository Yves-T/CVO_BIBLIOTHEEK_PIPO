<?php

if (strrpos($_SERVER['REQUEST_URI'], '/utility/')) {
    include_once "../models/Table.class.php";
} else {
    include_once "models/Table.class.php";
}

class Loan_Table extends Table
{
    /**
     * Get all lend books
     * @return mixed
     */
    public function getLendBooks()
    {
        $sql = "SELECT book.title, 
	  member.firstname, 
	  member.lastname
      FROM loan INNER JOIN book ON loan.book_id = book.id
	  INNER JOIN member ON loan.member_id = member.id
      WHERE  book.loan_status = 1";

        return $this->makeStatement($sql);
    }
}
