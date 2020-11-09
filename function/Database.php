<?php
class Database
{
    // Database const
    const HOST = "localhost";
    const USER = "root";
    const PASS = "";
    const DB = "db_tennis";

    // Database property
    public $db;

    // Making connection using __construct
    public function __construct()
    {
        // Mysqli object
        $this->db = new mysqli(self::HOST, self::USER, self::PASS, self::DB);

        // Return database object
        return $this->db;
    }
}
