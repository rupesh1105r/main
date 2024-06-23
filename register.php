<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="j.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
    <img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
            <img src="img/bg.svg">
        </div>
        <div class="login-content">
            <form action="register.php" method="POST">
                <img src="img/avatar.svg">
                <h2 class="title">Register</h2>

                <?php
                include("php/config.php");

                if(isset($_POST['submit'])){
                    $username = mysqli_real_escape_string($con, $_POST['username']);
                    $email = mysqli_real_escape_string($con, $_POST['email']);
                    $password = mysqli_real_escape_string($con, $_POST['password']);
                    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
                    $role = mysqli_real_escape_string($con, $_POST['role']);

                    if ($password !== $confirm_password) {
                        echo "<div class='message'><p>Passwords do not match.</p></div><br>";
                        echo "<a href='javascript:self.history.back()' class='btn'>Go back</a>";
                        exit();
                    }

                    $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");
                    if(mysqli_num_rows($verify_query) != 0){
                        echo "<div class='message'><p>This email is already in use. Please use another email.</p></div><br>";
                        echo "<a href='javascript:self.history.back()' class='btn'>Go back</a>";
                    } else {
                        $query = "INSERT INTO users (Username, Email, Password, Role) VALUES ('$username', '$email', '$password', '$role')";
                        if(mysqli_query($con, $query)){
                            echo "<div class='message'><p>Registration successful.</p></div><br>";
                            echo "<a href='login.php' class='btn'>Login now</a>";
                        } else {
                            echo "Error: " . mysqli_error($con);
                        }
                    }
                } else {
                ?>

                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                    <label for="Username"></label><br>
                        <input type="text" class="input" placeholder="username" id="username" name="username" required>
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                    <label for="Email"></label><br>
                        <input type="email" placeholder="Email"class="input" id="email" name="email" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i"> 
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                    <label for="password"></label><br>
                        <input type="password"  placeholder="password" class="input" id="password" name="password" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i"> 
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                    <label for="confirm password"></label><br>
                        <input type="password" placeholder="confirm password" class="input" id="confirm_password" name="confirm_password" required>
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user-tag"></i>
                    </div>
                    <div class="div">
                        <h5>Role</h5>
                        <select class="input" id="role" name="role" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <input type="submit" class="btn" name="submit" value="Register">

                <?php } ?>

            </form>
            <p class="register-link">Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
    <script src="j.js"></script>
</body>
</html>
