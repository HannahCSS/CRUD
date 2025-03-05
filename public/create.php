<?php
// Include necessary files
require_once __DIR__ . "/common.php"; // Sanitization helper to prevent XSS and SQL injection
require_once __DIR__ . "/src/DBconnect.php"; // Database connection setup

// Check if the form was submitted
if (isset($_POST['submit'])) {
    try {
        // Sanitize and store user input
        $new_user = array(
            "firstname" => escape($_POST['firstname']), // Escape input to prevent XSS
            "lastname" => escape($_POST['lastname']),
            "email" => escape($_POST['email']),
            "age" => escape($_POST['age']),
            "location" => escape($_POST['location'])
        );

        // Prepare SQL query for inserting user data
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)", // Dynamic query for inserting into 'users' table
            "users",
            implode(", ", array_keys($new_user)), // Column names
            ":" . implode(", :", array_keys($new_user)) // Named placeholders for prepared statement
        );

        // Prepare and execute the SQL statement
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

        // Display success message
        $successMessage = $new_user['firstname'] . ' successfully added!';
    } catch (PDOException $error) {
        // Display error message if something goes wrong
        echo "Error: " . $error->getMessage();
    }
}

// Include the page header
require "templates/header.php";
?>

<h2>Add a User</h2>

<!-- Display success message if user was added -->
<?php if (!empty($successMessage)) : ?>
    <p style="color: green;"><?php echo $successMessage; ?></p>
<?php endif; ?>

<!-- User input form -->
<form method="post">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname" required>

    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname" required>

    <label for="email">Email Address</label>
    <input type="email" name="email" id="email" required>

    <label for="age">Age</label>
    <input type="number" name="age" id="age">

    <label for="location">Location</label>
    <input type="text" name="location" id="location">

    <input type="submit" name="submit" value="Submit">
</form>

<!-- Link to go back to the home page -->
<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; // Include the footer ?>


