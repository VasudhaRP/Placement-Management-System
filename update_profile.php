<?php
session_start();
require 'includes/connection.php';

$usn = $_SESSION['user_id'];
$name = $_POST['name'];
$year = $_POST['year'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];

$sql = "UPDATE user SET name='$name', year='$year', email='$email', mobile='$mobile' WHERE USN='$usn'";

if (mysqli_query($connection, $sql)) {
    header('Location: profile.php');
} else {
    echo "Error updating record: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
