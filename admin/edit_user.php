<?php
session_start();
include "../includes/db.php";

// حماية الصفحة
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// التأكد من وجود ID
if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit;
}

$id = (int) $_GET['id'];

// جلب بيانات المستخدم
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($connection, $query);
$user = mysqli_fetch_assoc($result);

$message = "";

// عند الضغط على زر التحديث
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $full_name = trim($_POST['full_name']);
    $email     = trim($_POST['email']);
    $role      = $_POST['role'];
    $password  = trim($_POST['password']);

    if (!empty($password)) {
        // إذا كتب الأدمن كلمة مرور جديدة
        $update = "UPDATE users SET
                    full_name = '$full_name',
                    email     = '$email',
                    role      = '$role',
                    password  = '$password'
                   WHERE id = $id";
    } else {
        // إذا لم يكتب كلمة مرور
        $update = "UPDATE users SET
                    full_name = '$full_name',
                    email     = '$email',
                    role      = '$role'
                   WHERE id = $id";
    }

    mysqli_query($connection, $update);
    $message = "User updated successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container" style="margin-top:50px; max-width:600px;">
    <h2>Edit User</h2>

    <?php if ($message): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="post">

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control"
                   value="<?php echo $user['full_name']; ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?php echo $user['email']; ?>" required>
        </div>

        <div class="form-group">
            <label>New Password (leave blank to keep current)</label>
            <input type="text" name="password" class="form-control">
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="student" <?php if ($user['role']=='student') echo 'selected'; ?>>Student</option>
                <option value="admin" <?php if ($user['role']=='admin') echo 'selected'; ?>>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="users.php" class="btn btn-default">Back</a>

    </form>
</div>

</body>
</html>
