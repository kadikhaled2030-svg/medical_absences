<?php
session_start();
include "../includes/db.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password' AND role='admin'";
    $result = mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['user_id']   = $row['id'];
        $_SESSION['full_name'] = $row['full_name'];
        $_SESSION['role']      = $row['role'];
        header("Location: index.php");
        exit;
    } else {
        $message = "Invalid admin credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container" style="margin-top:50px; max-width:500px;">
    <h2>Admin Login</h2>
    <?php if ($message): ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php endif; ?>
    <form action="" method="post">
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button style= "background-color: darkblue  ;border-color: darkblue;"class="btn btn-danger" type="submit">Login</button>
    </form>
</div>

</body>
</html>
