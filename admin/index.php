<?php include "../includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>
<?php
// counts
$total_requests   = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM absence_requests"));
$pending_requests = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM absence_requests WHERE status='Pending'"));
$approved_requests = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM absence_requests WHERE status='Approved'"));
$rejected_requests = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM absence_requests WHERE status='Rejected'"));
?>

<div class="row">
  <div class="col-lg-12">
    <h2>Control Panel Overview</h2>
  </div>
</div>

<div class="row" style="margin-top:20px;">
  <div class="col-md-3">
    <div class="panel panel-primary" >
      <div class="panel-heading text-center">
        <h3 >Total Requests</h3>
      </div>
      <div class="panel-body text-center">
        <span style="font-size:28px; "><?php echo $total_requests; ?></span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="panel panel-warning">
      <div class="panel-heading text-center">
        <h3>In Progress</h3>
      </div>
      <div class="panel-body text-center">
        <span style="font-size:28px;"><?php echo $pending_requests; ?></span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="panel panel-success">
      <div class="panel-heading text-center">
        <h3>Approved</h3>
      </div>
      <div class="panel-body text-center">
        <span style="font-size:28px;"><?php echo $approved_requests; ?></span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="panel panel-danger">
      <div class="panel-heading text-center">
        <h3>Declined</h3>
      </div>
      <div class="panel-body text-center">
        <span style="font-size:28px;"><?php echo $rejected_requests; ?></span>
      </div>
    </div>
  </div>
</div>
<?php include "includes/footer.php"; ?>
