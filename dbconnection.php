<?php
class Database
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'hubvenue';
    protected $connection = "";

    function connect()
    {
        $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);

        return $this->connection;
    }
}