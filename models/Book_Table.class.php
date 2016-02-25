<?php

include_once "models/Table.class.php";

class Book_Table extends Table
{

    /**
     * Fetch all books from the database
     */
    public function getAllBooks()
    {
        $sql = "SELECT * FROM book ORDER BY book.title";

        $statement = $this->db->prepare($sql);

        $statement = $this->makeStatement($sql);

        return $statement;
    }

    /**
     * Get book details for a given book id
     * @param $bookId
     * @return mixed
     */
    public function getBookDetail($bookId)
    {
        $sql = "SELECT book.title, 
	    author.firstname, 
	    book_category.category_description, 
	    book.price, 
	    book.shortcontent, 
	    author.lastname
        FROM book INNER JOIN author ON book.author_id = author.id
	    INNER JOIN book_category ON book.category_id = book_category.id WHERE book.id = ?";

        $statement = $this->makeStatement($sql, array($bookId));

        return $statement;
    }
}