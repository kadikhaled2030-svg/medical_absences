<?php
session_start();
include "../includes/db.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($full_name == "" || $email == "" || $password == "") {
        $message = "All fields are required.";
    } else {
        $query = "INSERT INTO users(full_name, email, password, role) ";
        $query .= "VALUES('$full_name', '$email', '$password', 'student')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $message = "Registration successful. You can login now.";
        } else {
            $message = "Error: " . mysqli_error($connection);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container" style="margin-top:50px; max-width:500px;">
    <h2>Student Registration</h2>
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>
    <form action="" method="post">
        <div class="form-group">
            <label>Full Name:</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button style="background-color: darkblue;border-color: darkblue;" class="btn btn-primary" type="submit">Register</button>
        <a href="login.php" class="btn btn-link">Already have an account? Login</a>
    </form>
</div>

</body>
</html>
