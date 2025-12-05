<?php
$connection = mysqli_connect("localhost", "root", "", "medical_absences");

if (!$connection) {
    die("Database connection failed");
}
?>