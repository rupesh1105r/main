<?php
session_start();
if(!isset($_SESSION['valid']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
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

        p {
            text-align: center;
            font-size: 18px;
        }

        a {
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #0056b3;
        }

        form {
            text-align: center;
        }

        button {
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Welcome, Admin <?php echo $_SESSION['username']; ?></h1>
    <p>This is the admin home page.</p>
    <a href="admin_page.php">Manage Users</a>
    <form action="login.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
