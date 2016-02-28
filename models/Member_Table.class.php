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

    /**
     * Get all Memmers.
     * @return mixed
     */
    public function getAllMembers()
    {
        $sql = "SELECT
              member.id,
              member.address_id,
              member.firstname,
              member.lastname
          FROM member
          ORDER BY member.lastname ASC, member.firstname ASC";

        return $this->makeStatement($sql);
    }

    /**
     * Update member.
     * @param $memberId
     */
    public function updateMember($memberId, $formData)
    {
        $canCommmit = true;
        try {
            // start transaction
            $this->db->beginTransaction();

            // get address id for this member
            $getAddressSql = "SELECT address_id FROM member WHERE member.id=?";
            $data = array($memberId);
            $member = $this->makeStatement($getAddressSql, $data)->fetchObject();
            $addressId = $member->address_id;

            // 1 update address
            $addressTable = new Address_Table($this->db);
            $isUpdateAddressSucces = $addressTable->updateAddress($formData, $addressId);

            if (!$isUpdateAddressSucces) {
                $canCommmit = false;
            }

            // 2 insert member
            $insertMemberSql = "UPDATE member SET firstname=?,lastname=?,address_id=? WHERE id = ?";
            $data = array(
                $formData['voornaam'],
                $formData['lastName'],
                $addressId,
                $memberId
            );
            $this->makeStatement($insertMemberSql, $data);

            // commit transaction
            if ($canCommmit) {
                $this->db->commit();
                return true;
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

    /**
     * Get member by a given id.
     * @param $memberId
     */
    public function getMemberById($memberId)
    {
        $sql = "SELECT member.id, 
	member.address_id, 
	member.firstname, 
	member.lastname, 
	address.street, 
	address.housenr, 
	zipcode.zipcode, 
	zipcode.name
    FROM member INNER JOIN address ON member.address_id = address.id
	INNER JOIN zipcode ON address.zipcode_id = zipcode.id WHERE member.id = ?";

        $data = array($memberId);

        return $this->makeStatement($sql, $data);
    }

    /**
     * Delete a member
     * @param $memberId
     */
    public function deleteMember($memberId)
    {
        try {
            // start transaction
            $this->db->beginTransaction();

            // 1 get member
            $memberToDelete = $this->getMemberById($memberId)->fetchObject();
            $addressIdToDelete = $memberToDelete->address_id;

            // 2 delete his address
            $addressTable = new Address_Table($this->db);
            $addressTable->deleteAddress($addressIdToDelete);

            // 3 delete member
            $deleteSql = "DELETE FROM member WHERE id=?";
            $data = array($memberId);
            $this->makeStatement($deleteSql, $data);

            // commit transaction
            $this->db->commit();
        } catch (PDOException $ex) {
            //Something went wrong rollback!
            $this->db->rollBack();
            echo $ex->getMessage();
        }
    }

    /**
     * Search a member with given search filter and search term
     * @param $searchFilter
     * @param $searchTerm
     */
    public function searchMember($searchFilter, $searchTerm)
    {
        $sql = "SELECT member.id,
	member.address_id,
	member.firstname,
	member.lastname,
	address.street,
	address.housenr,
	zipcode.zipcode,
	zipcode.name
    FROM member INNER JOIN address ON member.address_id = address.id
	INNER JOIN zipcode ON address.zipcode_id = zipcode.id WHERE " . $searchFilter . " LIKE ?";

        $data = array("%$searchTerm%");
        $statement = $this->makeStatement($sql, $data);
        return $statement;
    }
}
