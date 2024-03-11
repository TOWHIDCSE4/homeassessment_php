<?php

class Database
{
    private $conn;

    public function __construct()
    {
        $host = 'localhost';
        $port = 'port'; // default port is 5432
        $username = 'username';
        $password = "password";
        $dbname = 'database';
        $connection_string = "host={$host} port={$port} dbname={$dbname} user={$username} password={$password}";

        $this->conn = pg_connect($connection_string);
        if (!$this->conn) {
            echo "Failed to connect to PostgreSQL";
            exit;
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
?>
