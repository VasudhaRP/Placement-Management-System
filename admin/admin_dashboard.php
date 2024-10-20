<?php
session_start();
include('../includes/connection.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: admin_login.php');
    exit;
}

// Fetch the logged-in admin's email
$admin_email = $_SESSION['user_id']; // Assuming email is stored in session

// Optional: Validate if email exists in the database (if needed)
$query = "SELECT email FROM admin WHERE email = '$admin_email'";
$result = mysqli_query($connection, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die('Invalid admin session.');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/Style.css">
    <!-- jQuery code -->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#compdetails").click(function(){
                $("#right_sidebar").load("company_details.php");
            });
        });
    </script>
</head>
<body>
   <!-- header starts here -->
   <nav class="navbar navbar-light navbar-custom">
        <div class="container">
            <div class="row w-100" id="header">
                <div class="col-md-4">
                    <h3>Placement Management System</h3>
                </div>
                <div class="col-md-8 text-md-end">
                    <b>Email:</b> <?php echo htmlspecialchars($admin_email); ?>
                    <span><b>Name:</b> admin</span>
                </div>
            </div>
        </div>
    </nav>
    <!-- header ends here -->
    <div class="row">
        <div class="col-md-2" id="left_sidebar">
            <table class="table" id="adminmenu" style="height:60%">
                <tr>
                    <td style="text-align:center;">
                        <a href="admin_company_details.php" type="button" id="compdetails">Company Details</a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <a href="all_registartion.php" type="button">Registration</a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <a href="admin_all_companies.php" type="button">All Companies</a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <a href="student_detail.php" type="button">Student Profile</a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <a href="admin_login.php" type="button">Logout</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-10" id="right_sidebar">
            <!-- This is where the content will be dynamically loaded -->
        </div>
    </div>
</body>
</html>
