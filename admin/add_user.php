<?php
session_start();
include "../includes/db.php";

// منع الدخول لغير الأدمن
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $email     = trim($_POST['email']);
    $password  = trim($_POST['password']);
    $role      = $_POST['role'];

    if ($full_name == "" || $email == "" || $password == "") {
        $message = "All fields are required.";
    } else {
        $query = "INSERT INTO users (full_name, email, password, role)
                  VALUES ('$full_name', '$email', '$password', '$role')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $message = "User added successfully!";
        } else {
            $message = "Error: " . mysqli_error($connection);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New User</title>
    <link rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container" style="max-width:600px; margin-top:50px;">
    <h2>Add New User</h2>

    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="text" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create User</button>
        <a href="index.php" class="btn btn-default">Back</a>
    </form>
</div>

</body>
</html>
