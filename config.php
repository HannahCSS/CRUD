<?php

//Configuration for database connection.
//This file contains the database connection settings and PDO configuration.
 

// Database connection details
$host = "localhost";  
$username = "root";  
$password = "root";  
$dbname = "CRUD";   

// DSN string for MySQL, specifying the host and database name
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8"; 

// PDO options to handle errors, fetch data as associative arrays, and avoid emulated prepares
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Set error mode to exception to handle database errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Set the default fetch mode to associative arrays (for easy access to columns by name)
    PDO::ATTR_EMULATE_PREPARES => false, // Disable emulated prepares to use native MySQL prepared statements
];

try {
    // Create a new PDO instance with the provided DSN and options
    $connection = new PDO($dsn, $username, $password, $options);
} catch (PDOException $error) {
    // Handle any errors that occur during the connection attempt
    echo "Connection failed: " . $error->getMessage();
    exit;
}
?>


