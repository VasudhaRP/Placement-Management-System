<?php
include('admin_dashboard.php');
include('../includes/connection.php');
// if ($connection) {
//     echo "Database connected successfully.";
// } else {
//     echo "Database connection failed.";
// }
if (isset($_POST['compRegistration'])) {
    $compid= mysqli_real_escape_string($connection, $_POST['compid']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $category = mysqli_real_escape_string($connection, $_POST['category']);
    $job_profile = mysqli_real_escape_string($connection, $_POST['job_profile']);
    $branch = mysqli_real_escape_string($connection, $_POST['branch']);
    $batch = mysqli_real_escape_string($connection, $_POST['batch']);
    $location = mysqli_real_escape_string($connection, $_POST['location']);
    $criteria = mysqli_real_escape_string($connection, $_POST['criteria']);
    $duration = mysqli_real_escape_string($connection, $_POST['duration']);
    $mode = mysqli_real_escape_string($connection, $_POST['Mode']);
    $offer = mysqli_real_escape_string($connection, $_POST['offer']);

    $query = "INSERT INTO company (compid,compname, category, profile, branch, batch, location, criteria, intern_duration, mode, offer) 
              VALUES ('$compid','$name', '$category', '$job_profile', '$branch', '$batch', '$location', '$criteria', '$duration', '$mode', '$offer')";
     
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo "<script type='text/javascript'>
        alert('Company registered successfully...');
        </script>";
    } else {
        echo "<script type='text/javascript'>
        alert('Please try again..');
        </script>";
        echo "Error: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/Style.css">
    <style>
       
    </style>
</head>
<body>
<div class="container" id="form_container">
<div class="row">
        <div class="col-md-3 m-auto">
            <center><h3 style="color:#cfc6c6;margin-top:30px;" >Company Details</h3></center>
            <form action="" id="compForm" method="post">
            
            <div class="form-group"  >
                    <input type="text" name="compid" class="form-control" placeholder="Company ID" required>
                </div>
            <div class="form-group"  >
                    <input type="text" name="name" class="form-control" placeholder="Company Name" required>
                </div>
                <div class="form-group">
                    <input type="text" name="category" class="form-control" placeholder="Category" required>
                </div>
                <div class="form-group">
                    <input type="text" name="job_profile" class="form-control" placeholder="Job Profile" required>
                </div>
                <div class="form-group">
                    <input type="text" name="branch" class="form-control" placeholder="Eligible branches" required>
                </div>
                <div class="form-group">
                    <input type="text" name="batch" class="form-control" placeholder="Eligible Batch" required>
                </div>
                <div class="form-group">
                    <input type="text" name="location" class="form-control" placeholder="Job Location" required>
                </div>
                <div class="form-group">
                    <input type="text" name="criteria" class="form-control" placeholder="Eligibility Criteria" required>
                </div>
                <div class="form-group">
                    <input type="text" name="duration" class="form-control" placeholder="Internship Duration" >
                </div>
                <div class="form-group">
                    <input type="text" name="Mode" class="form-control" placeholder="Mode of Drive" required>
                </div>
                <div class="form-group">
                    <input type="text" name="offer" class="form-control" placeholder="CTC offered" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="compRegistration" value="Register" class="btn btn-warning">
                </div>
                <!-- <div class="form-group">
                <center><a href="index.php" class="btn btn-info" ">Go To Home</a></center>
                </div> -->
            </form>
            
        </div>
        </div>
    </div>
</body>
</html>