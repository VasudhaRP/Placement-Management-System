<?php
session_start();
include('../includes/connection.php');

if(isset($_POST['AdminLogin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $query_run = mysqli_query($connection, $query);

    if(mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
        $_SESSION['user_id'] = $row['email']; // Assuming 'admin_id' is the column for admin ID
        $_SESSION['role'] = 'admin'; // Set role as admin
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo "<script type='text/javascript'>
        alert('Please enter correct details...');
        window.location.href='admin_login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/Style.css">
    <style>
        h3 {
            color: bisque;
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
            white-space: nowrap;
            margin-left: -20px;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-md-3 m-auto">
            <center><h3>Admin Login</h3></center>
            <form action="" method="post">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="AdminLogin" value="Login" class="btn btn-warning">
                </div>
                <div class="form-group">
                     <a href="../index.php" class="btn btn-info" >Go To Home</a>
                </div>
            
            </form>
        </div>
    </div>
</body>
</html>
