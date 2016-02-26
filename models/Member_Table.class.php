<?php

if (strrpos($_SERVER['REQUEST_URI'], '/utility/')) {
    include_once "../models/Table.class.php";
    include_once "../models/Address_Table.class.php";
} else {
    include_once "models/Table.class.php";
    include_once "models/Address_Table.class.php";
}

class Member_Table extends Table
{

    /**
     * Add member to database.
     */
    public function addMember($formData)
    {
        $canCommmit = true;
        try {
            // start transaction
            $this->db->beginTransaction();
            // 1 insert address
            $addressTable = new Address_Table($this->db);
            $newAddressId = $addressTable->addAddress($formData);

            if ($newAddressId == false) {
                $canCommmit = false;
            }

            // 2 insert member
            $insertMemberSql = "INSERT INTO member (firstname,lastname,address_id) VALUES (?,?,?)";
            $data = array(
                $formData['voornaam'],
                $formData['lastName'],
                $newAddressId
            );
            $this->makeStatement($insertMemberSql, $data);

            // commit transaction
            if ($canCommmit) {
                $this->db->commit();
                return $this->db->lastInsertId();
            } else {
                // the transaction has failed, so rollback
                $this->db->rollBack();
                return false;
            }

        } catch (PDOException $ex) {
            //Something went wrong rollback!
            $this->db->rollBack();
            echo $ex->getMessage();
            return false;
        }
    }

}
