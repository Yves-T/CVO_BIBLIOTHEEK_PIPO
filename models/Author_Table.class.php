<?php

include_once "models/Table.class.php";

class Author_Table extends Table
{
    /**
     * Fetch all authors from the database
     */
    public function getAllAuthors()
    {
        $sql = "SELECT * FROM author ORDER BY author.lastname,author.firstname";

        $statement = $this->db->prepare($sql);

        $statement = $this->makeStatement($sql);

        return $statement;
    }

    /**
     * Get details for a given author
     * @param $authorId
     * @return mixed
     */
    public function getAuthorDetail($authorId)
    {
        $sql = "SELECT author.firstname, 
	    author.lastname, 
	    book.title, 
	    author.biography
        FROM book INNER JOIN author ON book.author_id = author.id WHERE author.id = ?";
        $statement = $this->makeStatement($sql, array($authorId));

        return $statement;
    }

    public function addAuthor($data)
    {
        $sql = "INSERT INTO author (firstname,lastname,biography) VALUES(?,?,?)";
        $data = array($data['authorFirstName'], $data['authorLastName'], $data['authorBiography']);
        $this->makeStatement($sql, $data);
        return $this->db->lastInsertId();
    }
}
