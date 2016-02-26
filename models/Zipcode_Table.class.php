<?php

if (strrpos($_SERVER['REQUEST_URI'], '/utility/')) {
    include_once "../models/Table.class.php";
    include_once "../models/Author_Table.class.php";
} else {
    include_once "models/Table.class.php";
    include_once "models/Author_Table.class.php";
}

class Zip_Table extends Table
{

    /**
     * Search zip code
     */
    public function filterByZipCode($searchTerm)
    {
        $sql = "SELECT * FROM zipcode WHERE zipcode  LIKE ?";
        $data = array("%$searchTerm%");
        $statement = $this->makeStatement($sql, $data);
        return $statement;
    }

    /**
     * Search zip code by name.
     */
    public function filterZipCodeByName($searchTerm)
    {
        $sql = "SELECT * FROM zipcode WHERE name LIKE ?";
        $data = array("%$searchTerm%");
        $statement = $this->makeStatement($sql, $data);
        return $statement;
    }

    /**
     * Get zip by city.
     * @param $city
     * @return mixed
     */
    public function getZipCodeByCity($city)
    {
        $sql = "SELECT * FROM zipcode WHERE name = ?";
        $data = array($city);
        $statement = $this->makeStatement($sql, $data);
        return $statement;
    }

    /**
     * Check if city exists
     * @param $city
     * @return mixed
     */
    public function checkCity($city)
    {
        $sql = "SELECT COUNT(*) AS count FROM zipcode WHERE  name=:name";
        $statement = $this->db->prepare($sql);
        $statement->execute(['name' => $city]);
        $row = $statement->fetch();
        $numOfRows = $row['count'];

        return $numOfRows;
    }

    /**
     * Check if zip code exists
     * @param $zipCode
     * @return mixed
     */
    public function checkZipCode($zipCode)
    {
        $sql = "SELECT COUNT(*) AS count FROM zipcode WHERE  zipcode=:zipcode";
        $statement = $this->db->prepare($sql);
        $statement->execute(['zipcode' => $zipCode]);
        $row = $statement->fetch();
        $numOfRows = $row['count'];

        return $numOfRows;
    }

}
