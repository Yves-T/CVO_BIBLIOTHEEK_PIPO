<?php

if (strrpos($_SERVER['REQUEST_URI'], '/utility/')) {
    include_once "../models/Table.class.php";
    include_once "../models/Zipcode_Table.class.php";
} else {
    include_once "models/Table.class.php";
    include_once "models/Zipcode_Table.class.php";
}

class Address_Table extends Table
{

    /**
     * Add member to database
     */
    public function addAddress($formData)
    {
        $zipCodeTable = new Zip_Table($this->db);
        // 1 check if zip code exists
        $foundZips = $zipCodeTable->checkCity($formData['memberCity']);

        // if it exists look up the id for the zip and add the member address
        if ($foundZips > 0) {
            // 2 look up zip id
            $foundZip = $zipCodeTable->getZipCodeByCity($formData['memberCity']);

            // 3 insert address
            $insertAddressSql = "INSERT INTO address (housenr,street,zipcode_id) VALUES (?,?,?)";
            $data = array(
                $formData['streetNumber'],
                $formData['streetName'],
                $foundZip->fetchObject()->id
            );
            $this->makeStatement($insertAddressSql, $data);

            return $this->db->lastInsertId();
        } else {
            // city check failed so return false
            return false;
        }
    }
}
