<?php
include('user_dashboard.php');
// session_start();
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/Style.css">
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if ($user_data) { ?>
                    <div class="student-details">
                        <h3>Student Registration Details</h3>
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user_data['name']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>USN:</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user_data['USN']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user_data['email']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($user_data['mobile']); ?>" readonly>
                        </div>
                        
                      
                        
               
                    <form method="POST" action="apply.php" style="text-align: left; width: fit-content; margin-left: 0;">
                        <input type="hidden" name="compid" value="<?php echo htmlspecialchars($compid); ?>">
                        <div class="form-group">
                            <input type="checkbox" name="confirmApply" value="1" required> I confirm my application.
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">Apply Now</button>
                        </div>
                    </form>
                    
                <?php } else { ?>
                    <div class="alert alert-danger">Student details not found.</div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
