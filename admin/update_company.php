<?php
include('../includes/connection.php');

if (isset($_POST['compid'])) {
    $compid = $_POST['compid'];
    $compname = $_POST['compname'];
    $category = $_POST['category'];
    $profile = $_POST['profile'];
    $branch = $_POST['branch'];
    $batch = $_POST['batch'];
    $location = $_POST['location'];
    $criteria = $_POST['criteria'];
    $intern_duration = $_POST['intern_duration'];
    $mode = $_POST['mode'];
    $offer = $_POST['offer'];

    $query = "UPDATE company SET compname = '$compname', category = '$category', profile = '$profile', branch = '$branch', batch = '$batch', location = '$location', criteria = '$criteria', intern_duration = '$intern_duration', mode = '$mode', offer = '$offer' WHERE compid = '$compid'";

    if (mysqli_query($connection, $query)) {
        echo "Company details updated successfully.";
    } else {
        echo "Error updating company details: " . mysqli_error($connection);
    }
}
?>
