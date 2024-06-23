<?php
session_start();
if (!isset($_SESSION['valid']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include("php/config.php");

// Fetch all users from the database
$result = mysqli_query($con, "SELECT * FROM users") or die("Query failed");

if (!$result) {
    echo "Error fetching users: " . mysqli_error($con);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        table td {
            vertical-align: middle;
        }

        .actions {
            text-align: center;
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #f0f0f0;
            color: #333;
        }

        .actions a:hover {
            background-color: #e0e0e0;
        }

        form {
            margin-top: 20px;
            text-align: center;
        }

        button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Manage Users</h1>
    <table border="10">
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Password</th>
            <th>Actions</th>
        </tr>
        <?php 
        while ($row = mysqli_fetch_assoc($result)) { 
        ?>
            <tr>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['role']); ?></td>
                <td><?php echo htmlspecialchars($row['password']); ?></td>
                <td class="actions">
                <a href="delete_user.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a>

                </td>
            </tr>
        <?php } ?>
    </table>
    <form action="login.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
