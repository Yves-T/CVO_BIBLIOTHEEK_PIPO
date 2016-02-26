<?php

if (strrpos($_SERVER['REQUEST_URI'], '/utility/')) {
    include_once "../models/Table.class.php";
    include_once "../models/Author_Table.class.php";
} else {
    include_once "models/Table.class.php";
    include_once "models/Author_Table.class.php";
}

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
	    book.image,
	    author.lastname
        FROM book INNER JOIN author ON book.author_id = author.id
	    INNER JOIN book_category ON book.category_id = book_category.id WHERE book.id = ?";

        $statement = $this->makeStatement($sql, array($bookId));

        return $statement;
    }

    public function addBook($data,$image)
    {
        try {
            // start transaction
            $this->db->beginTransaction();
            // 1 insert author
            $authorTable = new Author_Table($this->db);
            $newAuthorId = $authorTable->addAuthor($data);

            // 2 insert book
            $sql = "INSERT INTO book  (author_id,title,price,shortcontent,category_id,image) VALUES (?,?,?,?,?,?)";
            $data = array(
                $newAuthorId,
                $data['bookTitle'],
                $data['bookPrice'],
                $data['bookShortDescription'],
                $data['bookCategory'],
                $image
            );
            $this->makeStatement($sql, $data);

            // commit transaction
            $this->db->commit();

            return $this->db->lastInsertId();
        } catch (PDOException $ex) {
            //Something went wrong rollback!
            $this->db->rollBack();
            echo $ex->getMessage();
        }
    }

    /**
     * Delete book with given book id.
     * @param $bookId
     */
    public function deleteBook($bookId)
    {
        try {

            // start transaction
            $this->db->beginTransaction();

            // 1 fetch author id from book to be deleted
            $fetchBookSql = "SELECT book.author_id FROM book WHERE book.id = ?";
            $data = array($bookId);
            $statement = $this->makeStatement($fetchBookSql, $data);
            $bookToDelete = $statement->fetchObject();

            $authorIdToBeDeleted = $bookToDelete->author_id;

            // 2 delete author
            $authorTable = new Author_Table($this->db);
            $authorTable->deleteAuthor($authorIdToBeDeleted);

            // 3 Delete book
            $deleteSql = "DELETE FROM book WHERE id = ?";
            $this->makeStatement($deleteSql, $data);

            // commit transaction
            $this->db->commit();
        } catch (PDOException $ex) {
            //Something went wrong rollback!
            $this->db->rollBack();
            echo $ex->getMessage();
        }
    }

}
