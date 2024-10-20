<?php
    include('includes/connection.php');
    
    if(isset($_POST['userRegistration'])){
        // Query to check if the USN already exists in the database
        $usn = $_POST['usn'];
        $check_query = "SELECT * FROM user WHERE USN='$usn'";
        $check_query_run = mysqli_query($connection, $check_query);
        
        // If USN exists
        if(mysqli_num_rows($check_query_run) > 0){
            echo "<script type='text/javascript'>
            alert('USN already registered. Please log in to access the website.');
            window.location.href='index.php';
            </script>";
        } else {
            // Insert new user into the database
            $query = "INSERT INTO user (USN, name, year, email, mobile, password, Branch, CGPA, 10thmarks, 12thmarks) 
          VALUES ('$_POST[usn]', '$_POST[name]', '$_POST[year]', '$_POST[email]', '$_POST[mobile]', '$_POST[password]', '$_POST[Branch]', $_POST[CGPA], $_POST[tenthmarks], $_POST[twelthmarks])";


            $query_run = mysqli_query($connection, $query);
            
            if($query_run){
                echo "<script type='text/javascript'>
                alert('User registered successfully.');
                window.location.href='index.php';
                </script>";
            } else {
                echo "<script type='text/javascript'>
                alert('Please try again.');
                window.location.href='Register.php';
                </script>";
            }
        }
    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/Style.css">
    <style>
        h3 {
    color:bisque;
    width: 100%;
    text-align: center;
    margin-bottom: 20px; 
    white-space: nowrap; 
    margin-left: -80px;  
}
    </style>
</head>
<body>
    <div class="row">
        <div class="col-md-3 m-auto">
            <center><h3 >User Registration</h3></center>
            <form action="" method="post">
            <div class="form-group">
            <div class="form-group">
                    <input type="text" name="usn" class="form-control" placeholder="Enter USN No." required>
                </div>
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <input type="text" name="year" class="form-control" placeholder="Enter year" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                </div>
                <div class="form-group">
                    <input type="text" name="mobileno" class="form-control" placeholder="Enter Mobile No." required>
                </div>
                <div class="form-group">
                    <input type="text" name="Branch" class="form-control" placeholder="Enter Branch" required>
                </div>
                <div class="form-group">
                    <input type="text" name="CGPA" class="form-control" placeholder="Enter Current CGPA" required>
                </div>
                <div class="form-group">
                    <input type="text" name="tenthmarks" class="form-control" placeholder="Enter 10th marks" required>
                </div>
                <div class="form-group">
                    <input type="text" name="twelthmarks" class="form-control" placeholder="Enter 12th marks." required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="userRegistration" value="Register" class="btn btn-warning">
                </div>
                <div class="form-group">
                <center><a href="index.php" class="btn btn-info" >Go To Home</a></center>
                </div>
            </form>
            
        </div>
    </div>
</body>
</html>