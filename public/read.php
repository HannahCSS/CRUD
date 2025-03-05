<?php
/**
 * Function to query user information based on a given location.
 */

require_once __DIR__ . "/common.php"; // Include common functions 
require_once __DIR__ . "/src/DBconnect.php"; //  database connection

$result = []; // Initialize an empty array to store query results

// Check if the form was submitted
if (isset($_POST['submit'])) {
    try {
        // SQL query to select users based on the provided location
        $sql = "SELECT * FROM users WHERE location = :location";

        // Escape and sanitize user input for security
        $location = escape($_POST['location']);

        // Prepare and execute the SQL statement
        $statement = $connection->prepare($sql);
        $statement->bindParam(':location', $location, PDO::PARAM_STR);
        $statement->execute();

        // Fetch all matching records
        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        // Display error message if the query fails
        echo "Error: " . $error->getMessage();
    }
}

// Include the header template
require "templates/header.php";
?>

<!-- Form to search users by location -->
<h2>Find User Based on Location</h2>

<form method="post">
    <label for="location">Location</label>
    <input type="text" id="location" name="location" required>
    <input type="submit" name="submit" value="View Results">
</form>

<!-- Display results if the form is submitted -->
<?php if (isset($_POST['submit'])): ?>
    <?php if (!empty($result)): ?>
        <h2>Results</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Age</th>
                    <th>Location</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo escape($row["id"]); ?></td>
                        <td><?php echo escape($row["firstname"]); ?></td>
                        <td><?php echo escape($row["lastname"]); ?></td>
                        <td><?php echo escape($row["email"]); ?></td>
                        <td><?php echo escape($row["age"]); ?></td>
                        <td><?php echo escape($row["location"]); ?></td>
                        <td><?php echo escape($row["date"]); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <!-- Display a message if no matching records are found -->
        <p>No results found for <strong><?php echo escape($_POST['location']); ?></strong>.</p>
    <?php endif; ?>
<?php endif; ?>

<!-- Link to navigate back to the home page -->
<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; // Include the footer template ?>


