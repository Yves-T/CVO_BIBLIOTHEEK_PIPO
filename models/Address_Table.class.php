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
        $foundZips = $this->validateZip($formData);

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

    private function validateZip($formData)
    {
        $zipCodeTable = new Zip_Table($this->db);
        // 1 check if zip code exists
        return $zipCodeTable->checkCity($formData['memberCity']);
    }

    /**
     * Update address.
     * @param $formData
     */
    public function updateAddress($formData, $addressId)
    {
        $zipCodeTable = new Zip_Table($this->db);
        // 1 check if zip code exists
        $foundZips = $this->validateZip($formData);

        // if zip exists start updating
        if ($foundZips > 0) {
            $foundZip = $zipCodeTable->getZipCodeByCity($formData['memberCity']);
            $updateAddressSql = "UPDATE address SET housenr=?,street=?,zipcode_id=? WHERE id = ?";
            $data = array(
                $formData['streetNumber'],
                $formData['streetName'],
                $foundZip->fetchObject()->id,
                $addressId
            );
            $this->makeStatement($updateAddressSql, $data);

            return true;
        } else {
            // zip is not valid, so return false
            return false;
        }
    }
}
