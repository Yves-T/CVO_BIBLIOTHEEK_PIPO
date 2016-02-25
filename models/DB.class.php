<?php

class DB
{
    private static $instance = null;

    /**
     * If there is no database connection, create and return one.
     * @return null|PDO
     */
    public static function get()
    {
        if (self::$instance == null) {

            $dsn = "sqlite:models/bibliotheek.db";

            $pdoOptions = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );

            try {
                // set connection
                self::$instance = new PDO($dsn, '', '', $pdoOptions);
            } catch (PDOException $e) {
                // Handle this properly
                throw $e;
            }
        }
        return self::$instance;
    }
}
