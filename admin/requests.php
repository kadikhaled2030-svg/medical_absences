<?php include "../includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

<?php
// Handle approve/reject
if (isset($_GET['approve'])) {
    $id = (int) $_GET['approve'];
    $query = "UPDATE absence_requests SET status='Approved' WHERE request_id=$id";
    mysqli_query($connection, $query);
    header("Location: requests.php");
    exit;
}
if (isset($_GET['reject'])) {
    $id = (int) $_GET['reject'];
    $query = "UPDATE absence_requests SET status='Rejected' WHERE request_id=$id";
    mysqli_query($connection, $query);
    header("Location: requests.php");
    exit;
}

$query = "SELECT ar.*, u.full_name, u.email
          FROM absence_requests ar
          JOIN users u ON ar.student_id = u.id
          ORDER BY ar.request_id DESC";
$result = mysqli_query($connection, $query);
?>

<div class="row">
  <div class="col-lg-12">
    <h2>Manage Absence Requests</h2>
    <table class="table table-bordered table-hover" style="margin-top:20px;">
      <thead>
        <tr style="background-color: lightgray;">
          <th>ID</th>
          <th>Student</th>
          <th>Email</th>
          <th>Absence Date</th>
          <th>Status</th>
          <th>Reason</th>
          <th>Attachment</th>
          <th>Submitted</th>
          <th>Approve</th>
          <th>Reject</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?php echo $row['request_id']; ?></td>
          <td><?php echo $row['full_name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['absence_date']; ?></td>
          <td><?php echo $row['status']; ?></td>
          <td style="max-width:250px;"><?php echo nl2br($row['reason']); ?></td>
          <td>
            <?php if ($row['attachment']): ?>
              <a href="../uploads/<?php echo $row['attachment']; ?>" target="_blank">View</a>
            <?php else: ?>
              -
            <?php endif; ?>
          </td>
          <td><?php echo $row['submitted_at']; ?></td>
          <td>
            <a href="requests.php?approve=<?php echo $row['request_id']; ?>" class="btn btn-success btn-sm">Approve</a>
          </td>
          <td>
            <a href="requests.php?reject=<?php echo $row['request_id']; ?>" class="btn btn-danger btn-sm"
               onclick="return confirm('Are you sure to reject this request?');">Reject</a>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include "includes/footer.php"; ?>
