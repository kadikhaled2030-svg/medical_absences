<?php
session_start();
include "../includes/db.php";

// حماية الصفحة
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// حذف المستخدم
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $query = "DELETE FROM users WHERE id = $id";
    mysqli_query($connection, $query);
    header("Location: users.php");
    exit;
}

$query = "SELECT * FROM users ORDER BY id DESC";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users Management</title>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container" style="margin-top:30px;">

    <h2>Users Management</h2>

    <a href="add_user.php" class="btn btn-primary" style="margin-bottom:10px;">
        + Add New User
    </a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr style="background-color: lightgray;">
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['full_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['role']; ?></td>

                <!-- زر التعديل -->
                <td>
                    <a href="edit_user.php?id=<?php echo $row['id']; ?>" 
                       class="btn btn-warning btn-sm">
                       Edit
                    </a>
                </td>

                <!-- زر الحذف -->
                <td>
                    <a href="users.php?delete=<?php echo $row['id']; ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure you want to delete this user?');">
                       Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
