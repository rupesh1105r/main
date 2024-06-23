<?php
session_start();

include("php/config.php");

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Select the user from the database
    $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' AND Password='$password'") or die("Query failed");

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);

        // Initialize session variables
        $_SESSION['valid'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];

        // Redirect based on role
        if($row['role'] == 'admin') {
            header("location: admin_home.php");
        } else {
            header("location: user_home.php");
        }
        exit();
    } else {
        echo "<div class='message'><p>Wrong username or password.</p></div><br>";
        echo "<a href='login.php' class='btn'>Go back</a>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="j.css">
</head>
<body>

<img class="wave" src="img/wave.png">
<div class="container">
    <div class="img">
        <img src="img/bg.svg">
    </div>
    <div class="login-content">
        <form action="login.php" method="POST">
            <img src="img/avatar.svg">
            <div class="login-container">
                <h2>Login</h2>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="input" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="input" name="password" required>
                </div>
                <button type="submit" name="submit">Login</button>
            </div>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</div>

</body>
</html>
