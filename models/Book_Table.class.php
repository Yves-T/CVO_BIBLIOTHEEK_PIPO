<?php

if (strrpos($_SERVER['REQUEST_URI'], '/utility/')) {
    include_once "../models/Table.class.php";
    include_once "../models/Author_Table.class.php";
} elseif (strrpos($_SERVER['REQUEST_URI'], '/admin/')) {
    include_once "../../models/Table.class.php";
    include_once "../../models/Author_Table.class.php";
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
     * Get all books without an author.
     * @return mixed
     */
    public function getBooksWithoutAuthor()
    {
        $sql = "SELECT * FROM book WHERE author_id IS NULL ORDER BY book.title";

        return $this->makeStatement($sql);
    }

    /**
     * Get book details for a given book id
     * @param $bookId
     * @return mixed
     */
    public function getBookDetail($bookId)
    {
        // check if book has an author. If it hasn't the number of rows is greater than 0
        $countSql = "SELECT COUNT(*) AS count FROM book WHERE id=:bookid AND author_id IS NULL";
        $countStatement = $this->db->prepare($countSql);
        $countStatement->execute(['bookid' => $bookId]);
        $row = $countStatement->fetch();
        $numOfRows = $row['count'];

        // book has no author available, so fetch category and book details only
        if ($numOfRows > 0) {
            $sql = "SELECT book.id,
        book.title,
	    book_category.category_description,
	    book.price,
	    book.isbn,
	    book.shortcontent,
	    book.image,
	    book.category_id
        FROM book INNER JOIN book_category ON book.category_id = book_category.id WHERE book.id = ?";
            return $this->makeStatement($sql, array($bookId));
        } else {
            // book has an author available, so fetch all data
            $sql = "SELECT book.title,
	    author.firstname,
	    book.id,
	    book_category.category_description, 
	    book.price,
	    book.isbn,
	    book.shortcontent,
	    book.image,
	    book.category_id,
	    book.author_id,
	    author.lastname,
	    author.biography
        FROM book INNER JOIN author ON book.author_id = author.id
	    INNER JOIN book_category ON book.category_id = book_category.id WHERE book.id = ?";

            $statement = $this->makeStatement($sql, array($bookId));

            return $statement;
        }
    }

    /**
     * Add book with given image path and book data.
     * @param $data
     * @param $image
     * @return mixed
     */
    public function addBook($formData, $image)
    {
        try {
            // start transaction
            $this->db->beginTransaction();

            // 1 insert book
            $sql = "INSERT INTO book  (title,price,shortcontent,category_id,image,isbn) VALUES (?,?,?,?,?,?)";
            $data = array(
                $formData['bookTitle'],
                $formData['bookPrice'],
                $formData['bookShortDescription'],
                $formData['bookCategory'],
                $image,
                $formData['bookIsbn']
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
            $fetchBookSql = "SELECT book.author_id,book.image FROM book WHERE book.id = ?";
            $data = array($bookId);
            $statement = $this->makeStatement($fetchBookSql, $data);
            $bookToDelete = $statement->fetchObject();

            $authorId = $bookToDelete->author_id;

            if (isset($authorId)) {
                // 2 set author foreign key to null
                $this->removeAuthorFromBook($authorId);
            }

            // 3 Delete book
            $deleteSql = "DELETE FROM book WHERE id = ?";
            $this->makeStatement($deleteSql, $data);

            // commit transaction
            $this->db->commit();

            // return image path from deleted book
            $imageToDelete = $bookToDelete->image;
            return $imageToDelete;
        } catch (PDOException $ex) {
            //Something went wrong rollback!
            $this->db->rollBack();
            echo $ex->getMessage();
        }
    }

    /**
     * Update an existing book with given form data.
     * @param $data
     */
    public function updateBook($formData, $image)
    {
        try {
            // start transaction
            $this->db->beginTransaction();

            $book = $this->getBookDetail($formData['bookId'])->fetchObject();

            // if a book alread has an image and the user has not give another one
            // don't throw it away bu reuse the original image
            if (!empty($book->image) && empty($image)) {
                $image = $book->image;
            }

            // 1 update book
            $updateBookSql = "UPDATE book SET title=?, price=?, shortcontent=?, image=?,category_id=?,isbn=? WHERE id = ?";
            $data = array(
                $formData['bookTitle'],
                $formData['bookPrice'],
                $formData['bookShortDescription'],
                $image,
                $formData['bookCategory'],
                $formData['bookIsbn'],
                $formData['bookId']
            );

            $statement = $this->makeStatement($updateBookSql, $data);

            // commit transaction
            $this->db->commit();

        } catch (PDOException $ex) {
            //Something went wrong rollback!
            $this->db->rollBack();
            echo $ex->getMessage();
        }
    }

    /**
     * Search a book with given search filter and search term
     * @param $searchFilter
     * @param $searchTerm
     */
    public function searchBook($searchFilter, $searchTerm)
    {
        $sql = "SELECT * FROM book WHERE " . $searchFilter . " LIKE ? ORDER BY " . $searchFilter;
        $data = array("%$searchTerm%");
        $statement = $this->makeStatement($sql, $data);
        return $statement;
    }

    /**
     * Connect book to author.
     * @param $authorId
     * @param $bookId
     * @return mixed
     */
    public function connectBookToAuthor($authorId, $bookId)
    {
        $sql = "UPDATE book SET author_id=? WHERE id = ?";
        $data = array($authorId, $bookId);
        return $this->makeStatement($sql, $data);
    }

    /**
     * Remove author from corresponding book.
     * @param $bookId
     */
    public function removeAuthorFromBook($authorId)
    {
        $sql = "UPDATE book SET author_id=NULL WHERE author_id=?";
        $data = array($authorId);
        return $this->makeStatement($sql, $data);
    }

    public function getBooksInCategory()
    {
        $sql = "SELECT book_category.category_description,count(book.category_id) AS count
          FROM book_category
          LEFT JOIN book ON book_category.id = book.category_id
          GROUP BY book_category.id ORDER BY book_category.category_description";

        $statement = $this->makeStatement($sql);

        return $statement;
    }
}
