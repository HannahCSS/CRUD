<?php
//Open a connection via PDO to create a new database and table with structure.
//This script connects to the MySQL server, creates a database if it doesn't exist,
//and then loads and executes an SQL file to create the required table(s).


// Include configuration to get the database connection settings
require "config.php";

try {
    // Establish a connection to MySQL server (without selecting a database yet)
    // The DSN used here only specifies the host (and optionally the port)
    $connection = new PDO("mysql:host=$host", $username, $password, $options);

    // Attempt to create the database if it doesn't already exist
    // This step ensures that the database is present before trying to interact with it
    $connection->exec("CREATE DATABASE IF NOT EXISTS $dbname");

    // Reconnect with the selected database (now that it has been created, if necessary)
    // This time, the DSN includes the database name
    $connection = new PDO($dsn, $username, $password, $options);

    // Specify the path to the SQL file containing the table structure
    $sqlFile = "data/init.sql";
    
    // Check if the SQL file exists
    if (!file_exists($sqlFile)) {
        throw new Exception("SQL file not found: $sqlFile"); // If the file is missing, throw an error
    }

    // Read the contents of the SQL file
    $sql = file_get_contents($sqlFile);

    // Execute the SQL commands from the file (this creates the table(s) in the database)
    $connection->exec($sql);

    // Output a success message once the database and tables are created
    echo "✅ Database '$dbname' and table(s) created successfully.";
} catch (PDOException $error) {
    // If a PDO exception occurs, display the error message
    echo "<pre>❌ Database error: " . $error->getMessage() . "</pre>";
} catch (Exception $error) {
    // If any other exception occurs, display the error message
    echo "<pre>⚠️ Error: " . $error->getMessage() . "</pre>";
}
?>


