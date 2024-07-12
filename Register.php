<?php
    include('includes/connection.php');
    if(isset($_POST['userRegistration'])){
        $query="insert into user values('$_POST[usn]','$_POST[name]','$_POST[year]','$_POST[email]','$_POST[mobileno]','$_POST[password]')";
        $query_run=mysqli_query($connection,$query);
        if($query_run){
            echo "<script type='text/javascript'>
            alert('User registered Suucessfully...');
            window.location.href='index.php';
            </script>
            ";
        }
        else{
            echo "<script type='text/javascript'>
            alert('Please try again..');
            window.location.href='Register.php';
            </script>
            ";
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
                    <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="userRegistration" value="Register" class="btn btn-warning">
                </div>
                <div class="form-group">
                <center><a href="index.php" class="btn btn-info" ">Go To Home</a></center>
                </div>
            </form>
            
        </div>
    </div>
</body>
</html>