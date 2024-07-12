<?php
session_start();
include('includes/connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM user WHERE USN = '$user_id'";
$user_result = mysqli_query($connection, $user_query);
$user_data = mysqli_fetch_assoc($user_result);

if (isset($_POST['confirmApply'])) {
    if (!empty($_POST['compid'])) {
        $compid = mysqli_real_escape_string($connection, $_POST['compid']);

     
        $apply_query = "INSERT INTO applications (user_id, company_id, application_date) VALUES (?, ?, NOW())";
        $apply_stmt = mysqli_prepare($connection, $apply_query);
        mysqli_stmt_bind_param($apply_stmt, 'ss', $user_id, $compid);

        if (mysqli_stmt_execute($apply_stmt)) {
            
            echo "<script>alert('Application submitted successfully'); window.location.href='user_dashboard.php';</script>";
            exit; 
        } else {
           
            echo "<script>alert('Application submission failed');</script>";
            echo "Error: " . mysqli_error($connection); 
        }

        mysqli_stmt_close($apply_stmt);
    } else {
        echo "<script>alert('Company ID is missing.'); window.location.href='user_dashboard.php';</script>";
        exit; 
    }
}

if (isset($_POST['compid'])) {
    $compid = $_POST['compid'];
    $query = "SELECT * FROM company WHERE compid = '$compid'";
    $query_run = mysqli_query($connection, $query);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .content-wrapper { padding-top: 30px; }
        .registration-form { display: none; margin-top: 20px; }
        h3 { color: bisque; text-align: center; margin-bottom: 20px; }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

<?php
if (isset($query_run) && mysqli_num_rows($query_run) > 0) {
    $row = mysqli_fetch_assoc($query_run);
    echo '<div class="company-details">';
    echo '<h3>Company Details</h3>';
    echo '<div class="form-group">';
    echo '<label>Company Name:</label>';
    echo '<input type="text" class="form-control" value="' . htmlspecialchars($row['compname']) . '" readonly>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Category:</label>';
    echo '<input type="text" class="form-control" value="' . htmlspecialchars($row['category']) . '" readonly>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Profile:</label>';
    echo '<input type="text" class="form-control" value="' . htmlspecialchars($row['profile']) . '" readonly>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Branch:</label>';
    echo '<input type="text" class="form-control" value="' . htmlspecialchars($row['branch']) . '" readonly>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Batch:</label>';
    echo '<input type="text" class="form-control" value="' . htmlspecialchars($row['batch']) . '" readonly>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Location:</label>';
    echo '<input type="text" class="form-control" value="' . htmlspecialchars($row['location']) . '" readonly>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Criteria:</label>';
    echo '<input type="text" class="form-control" value="' . htmlspecialchars($row['criteria']) . '" readonly>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Intern Duration:</label>';
    echo '<input type="text" class="form-control" value="' . htmlspecialchars($row['intern_duration']) . '" readonly>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Mode:</label>';
    echo '<input type="text" class="form-control" value="' . htmlspecialchars($row['mode']) . '" readonly>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Offer:</label>';
    echo '<input type="text" class="form-control" value="' . htmlspecialchars($row['offer']) . '" readonly>';
    echo '</div>';
    echo '<button class="btn btn-primary" id="applyNow">Apply Now</button>';
    echo '</div>';
} else {
    echo '<div class="alert alert-danger">Company details not found.</div>';
}
?>

<div class="registration-form">
    <div class="row">
        <div class="col-md-6 m-auto">
            <center><h3>Student Details</h3></center>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" name="usn" class="form-control" value="<?php echo htmlspecialchars($user_data['USN']); ?>" readonly>
                </div>
                <div class="form-group">
                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user_data['name']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="year" class="form-control" value="<?php echo htmlspecialchars($user_data['year']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="mobileno" class="form-control" value="<?php echo htmlspecialchars($user_data['mobile']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" value="<?php echo htmlspecialchars($user_data['password']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="hidden" name="compid" value="<?php echo htmlspecialchars($compid); ?>">
                    <input type="submit" name="confirmApply" value="Submit" class="btn btn-success">
                </div>
                <center><a href="user_dashboard.php" class="btn btn-info">Back to Dashboard</a></center>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#applyNow').click(function(){
            $('.company-details').hide();
            $('.registration-form').show();
        });
    });
</script>
</body>
</html>