<?php

// Include common functions 
require "../common.php";

// Check if a user ID is provided in the GET request for deletion
if (isset($_GET["id"])) {
    try {
        // Include database connection
        require_once '../src/DBconnect.php';

        // Get user ID from URL
        $id = $_GET["id"];

        // Prepare DELETE SQL statement
        $sql = "DELETE FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        // Success message after deletion
        $success = "User " . $id . " successfully deleted";

    } catch (PDOException $error) {
        // Display SQL error message
        echo $sql . "<br>" . $error->getMessage();
    }
}

try {
    // Include database connection
    require_once '../src/DBconnect.php';

    // Prepare SELECT query to retrieve all users
    $sql = "SELECT * FROM users";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

} catch (PDOException $error) {
    // Display SQL error message
    echo $sql . "<br>" . $error->getMessage();
}

// Include the page header
require "templates/header.php"; 
?>

<h2>Delete Users</h2>

<!-- Display success message if a user was deleted -->
<?php if ($success) echo "<p style='color: green;'>$success</p>"; ?>

<!-- Display the list of users in a table -->
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Age</th>
            <th>Location</th>
            <th>Date</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["firstname"]); ?></td>
                <td><?php echo escape($row["lastname"]); ?></td>
                <td><?php echo escape($row["email"]); ?></td>
                <td><?php echo escape($row["age"]); ?></td>
                <td><?php echo escape($row["location"]); ?></td>
                <td><?php echo escape($row["date"]); ?></td>
                <td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Link to navigate back to home -->
<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; // Include the footer ?>

