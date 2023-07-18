<?php
require_once __DIR__ . '/../../vendor/autoload.php';
class Connection
{
    public static function make(): PDO
    {
        // Load the environment variables from .env file
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        // Get the database credentials from the environment variables
        $dbHost = $_ENV['DB_HOST'];
        $dbName = $_ENV['DB_DATABASE'];
        $dbUsername = $_ENV['DB_USERNAME'];
        $dbPassword = $_ENV['DB_PASSWORD'];

        // Establish the database connection
        return new PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUsername, $dbPassword);
        // Adjust the connection details based on your database setup
    }
}
