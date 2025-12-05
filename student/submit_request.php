<?php
session_start();
include "../includes/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit;
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id   = $_SESSION['user_id'];
    $absence_date = $_POST['absence_date'];
    $reason       = mysqli_real_escape_string($connection, $_POST['reason']);

    $attachment_name = null;

    if (!empty($_FILES['attachment']['name'])) {
        $attachment_name = time() . "_" . basename($_FILES['attachment']['name']);
        $target_path = "../uploads/" . $attachment_name;
        move_uploaded_file($_FILES['attachment']['tmp_name'], $target_path);
    }

    if ($absence_date == "" || $reason == "") {
        $message = "Date and reason are required.";
    } else {
        $query = "INSERT INTO absence_requests (student_id, absence_date, reason, attachment, status) ";
        $query .= "VALUES ($student_id, '$absence_date', '$reason', " . ($attachment_name ? "'$attachment_name'" : "NULL") . ", 'Pending')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $message = "Your excuse has been submitted successfully.";
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
    <title>Submit Medical Excuse</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<nav style="background-color:black;" class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a style="color:white"    class="navbar-brand" href="submit_request.php">Student Panel</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a style="color:white" href="my_requests.php">My Requests</a></li>
      <li><a  style="color:white" href="logout.php">Logout (<?php echo $_SESSION['full_name']; ?>)</a></li>
      <li>
            <a style="background-color:black; color:white;" href="../index.php"><i class="fa fa-home"></i> Home</a>
        </li>
    </ul>

  </div>
</nav>

<div class="container" style="margin-top:20px; max-width:700px;">
    <h3>Submit Medical Excuse</h3>
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Absence Date:</label>
            <input type="date" name="absence_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Reason </label>
            <textarea name="reason" class="form-control" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label>Attachment (Medical report, PDF/Image) - optional:</label>
            <input type="file" name="attachment" class="form-control">
        </div>
        <button type="submit" class="btn btn-success" style="background-color: darkblue; border-color: darkblue;">Submit Excuse</button>
    </form>
</div>

</body>
</html>
