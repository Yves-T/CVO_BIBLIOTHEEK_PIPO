<?php

include_once "models/Table.class.php";
include_once "utility/SecurePassword.php";

class Admin_Table extends Table
{
    /**
     * Create an admin in the database.
     * @param $email
     * @param $password
     * @throws Exception
     */
    public function create($email, $password)
    {

        $randomSalt = SecurePassword::randomSalt();
        $hash = SecurePassword::createHash($password, $randomSalt);

        $this->checkEmail($email);
        // insert hash and random salt in db
        $sql = "INSERT INTO admin ( salt, password,username ) VALUES( ?, ?, ? )";
        $data = array($randomSalt, $hash, $email);
        $this->makeStatement($sql, $data);
    }

    /**
     * Check if admin email address is already used.
     * @param $email
     * @throws Exception
     */
    private function checkEmail($email)
    {
        $sql = "SELECT COUNT(*) AS count FROM admin WHERE  username=:username";
        $statement = $this->db->prepare($sql);
        $statement->execute(['username' => $email]);
        $row = $statement->fetch();
        $numOfRows = $row['count'];

        if ($numOfRows > 0) {
            $e = new Exception("Error: '$email' is al in gebruik!");
            throw $e;
        }
    }

    /**
     * Verify admin login credentials
     * @param $email
     * @param $password
     * @return bool
     * @throws Exception
     */
    public function checkCredentials($email, $password)
    {
        // look up user
        $sql = "SELECT * FROM admin WHERE username = ?";
        $data = array($email);
        $statement = $this->makeStatement($sql, $data);
        $row = $statement->fetchObject();
        // if no user is found the validation is false
        if (count($row) < 1) {
            return false;
        } else {
            // compare hash and salt with given password. Return true if valid, false otherwise.
            $salt = $row->salt;
            $hash = $row->password;
            return SecurePassword::validatePassword($salt, $hash, $password);
        }
    }
}
