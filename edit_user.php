<?php
session_start();
if (!isset($_SESSION['valid']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include("php/config.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Fetch user details
    $result = mysqli_query($con, "SELECT * FROM users WHERE id='$id'") or die("Query failed");
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "Error: User not found.";
        exit();
    }

    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $role = mysqli_real_escape_string($con, $_POST['role']);
        
        // Validate and hash password if changed
        $password = mysqli_real_escape_string($con, $_POST['password']);
        if (!empty($password)) {
            // Hash the password before updating
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $update_query = "UPDATE users SET Username='$username', Email='$email', Role='$role', Password='$hashed_password' WHERE id='$id'";
        } else {
            // If password is not changed, update without changing the password
            $update_query = "UPDATE users SET Username='$username', Email='$email', Role='$role' WHERE id='$id'";
        }

        if (mysqli_query($con, $update_query)) {
            header("Location: admin_page.php");
            exit();
        } else {
            echo "Error updating user: " . mysqli_error($con);
        }
    }
} else {
    header("Location: admin_page.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Edit User</h2>
    <form action="edit_user.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($row['Username']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Leave blank to keep current password">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="user" <?php if($row['Role'] == 'user') echo 'selected'; ?>>User</option>
                <option value="admin" <?php if($row['Role'] == 'admin') echo 'selected'; ?>>Admin</option>
            </select>
        </div>
        <button type="submit" name="submit">Update User</button>
    </form>
</body>
</html>
