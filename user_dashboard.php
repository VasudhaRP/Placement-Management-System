<?php
session_start();
include('includes/connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$query = "SELECT compid, compname FROM company";
$query_run = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Style.css"> <!-- Load custom CSS after Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    
</head>
<body>
    <!-- header starts here -->
    <nav class="navbar navbar-light  navbar-custom">
        <div class="container">
            <div class="row w-100" id="header">
                <div class="col-md-4">
                    <h3>Placement Management System</h3>
                </div>
                <!-- <div class="col-md-8 text-md-end">
                    <b>Email:</b> Test@gmail.com
                    <span><b>Name:</b> Test User</span>
                </div> -->
            </div>
        </div>
    </nav>
    <!-- header ends here -->
    <div class="row">
        <div class="col-md-2" id="left_sidebar">
            <table class="table">
                <!-- <tr>
                    <td style="text-align:center;">
                        <a href="" type="button">DashBoard</a>
                    </td>
                </tr> -->
                <tr>
                    <td style="text-align:center;">
                        <a href="com_register.php" type="button">Register</a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <a href="registered_companies.php" type="button">Registered Companies</a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <a href="companies.php" type="button">All Companies</a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <a href="profile.php" type="button">Profile</a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <a href="upload_resume.php" type="button">Resume</a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <a href="user_login.php" type="button">Logout</a>
                    </td>
                </tr>
            </table>
        </div>
        
    </div>

</body>
</html>
