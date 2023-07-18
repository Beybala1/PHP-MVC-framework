<?php
require_once __DIR__ . '/../app/database/Connection.php';

class Model
{
    protected PDO $connection;
    public function __construct()
    {
        $this->connection = Connection::make();
    }
}
