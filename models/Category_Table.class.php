<?php
include_once "models/Table.class.php";

class Category_Table extends Table
{
    /**
     * Fetch all categories from the database
     */
    public function getAllCategories()
    {
        $sql = "SELECT * FROM book_category ORDER BY book_category.category_description";

        $statement = $this->db->prepare($sql);

        $statement = $this->makeStatement($sql);

        return $statement;
    }

}
