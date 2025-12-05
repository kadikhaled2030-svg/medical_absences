<?php
session_start();
include "../includes/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id'];
$query = "SELECT * FROM absence_requests WHERE student_id = $student_id ORDER BY request_id DESC";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Excuse Requests</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<nav  style="background-color:black; "  class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a style="color:white;" class="navbar-brand" href="submit_request.php">Student Panel</a>
    </div>
    <ul class="nav navbar-nav navbar-left">
      <li  class="active"><a style="background-color:black; color:white;" href="my_requests.php">My Requests</a></li>
      <li><a style="color:white; " href="logout.php">Logout (<?php echo $_SESSION['full_name']; ?>)</a></li>
    
    <li>
            <a style="background-color:black;color: white;" href="../index.php"><i class="fa fa-home"></i> Home</a>
        </li></ul>
  </div>
</nav>

<div class="container" style="margin-top:20px;">
    <h3>My Excuse Requests</h3>
    <table class="table table-bordered table-hover">
        <thead>
            <tr style="background-color:lightgray ;">
                <th>ID</th>
                <th>Absence Date</th>
                <th>Status</th>
                <th>Admin Comment</th>
                <th>Attachment</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['request_id']; ?></td>
                <td><?php echo $row['absence_date']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo nl2br($row['admin_comment']); ?></td>
                <td>
                    <?php if ($row['attachment']): ?>
                        <a href="../uploads/<?php echo $row['attachment']; ?>" target="_blank">View</a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td><?php echo $row['submitted_at']; ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
