<?php

// Fetch and list all users with an option to edit

try {
    require "../common.php"; // Include common functions (e.g., input sanitization)
    require_once '../src/DBconnect.php'; // Include database connection

    // Query to fetch all users
    $sql = "SELECT * FROM users";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    // Display error if query execution fails
    echo " Error fetching users: " . $error->getMessage();
}

?>

<?php require "templates/header.php"; ?>

<h2>Update Users</h2>

<!-- Display users in a table with an edit link -->
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
            <th>Edit</th>
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
                <td><a href="update-single.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Link to return to the home page -->
<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

