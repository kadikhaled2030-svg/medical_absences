<nav  style =" background-color: black;   " class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php" style="background-color: black;">Admin Dashboard</a>
    </div>
    <ul class="nav navbar-nav navbar-left">
      <li style="background-color: black;"><a href="requests.php">Requests</a></li>
      <li style="background-color: black;"><a href="logout.php">Logout (<?php echo $_SESSION['full_name']; ?>)</a></li>
      <li style="background-color: black;"><a href="users.php">Users</a></li>
      
      <li>
            <a style="background-color:black;" href="../index.php"><i class="fa fa-home"></i> Home</a>
        </li>
        </ul>  </div>
</nav>

<div class="container" style="margin-top:70px;">
