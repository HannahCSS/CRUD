<?php
// Include the configuration file that holds the database connection settings
require_once 'C:/MAMP/htdocs/CRUD/config.php'; 

try {
    // Create a new PDO connection using the DSN, username, password, and options
    $connection = new PDO($dsn, $username, $password, $options);

    // Output message to confirm successful database connection
    echo 'DB connected';

} catch (\PDOException $e) {
    // If the connection fails, catch the PDO exception and display an error message
    // The error message from PDO is thrown along with the exception code for debugging purposes
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
