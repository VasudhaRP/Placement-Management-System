<?php
include('admin_dashboard.php');
include('../includes/connection.php');

// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: admin_login.php');
    exit;
}

// Fetch all students' details
$query_students = "SELECT * FROM user";
$result_students = mysqli_query($connection, $query_students);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profiles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/Style.css">
    <style>
        .stud-det {
            margin-top: 160vh; 
            margin-left:200px;
            padding: 20px; 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">Placement Management System</a>
          </div>
    </nav>
    
    <div class="container mt-4">
        <div class="stud-det ">
            <h2 style="padding-top:30px; margin-left:200px;color:#cfc6c6;">All Student Profiles</h2>
            <?php while ($row = mysqli_fetch_assoc($result_students)) : ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><b>Email:</b> <?php echo $row['email']; ?></p>
                        <p class="card-text"><b>Mobile:</b> <?php echo $row['mobile']; ?></p>
                        
                        <!-- Display applications -->
                        <h6>Applications:</h6>
                        <ul>
                            <?php
                            // Fetch applications for current student
                            $user_id = $row['USN'];
                            $query_applications = "SELECT company.compname, company.category, company.profile 
                                                  FROM applications
                                                  INNER JOIN company ON applications.company_id = company.compid 
                                                  WHERE applications.user_id = '$user_id'";
                            $result_applications = mysqli_query($connection, $query_applications);

                            if (mysqli_num_rows($result_applications) > 0) {
                                echo "<ul>";
                                while ($app_row = mysqli_fetch_assoc($result_applications)) {
                                    echo "<li>{$app_row['compname']} : {$app_row['category']} - {$app_row['profile']}</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "<p>Currently not enrolled for any companies.</p>";
                            }
                            ?>
                        </ul>
                        <!-- End of applications -->

                        <!-- Fetch resume details -->
                        
<h6>Resume:</h6>
<?php
$query_resume = "SELECT * FROM resume WHERE usn = '$user_id'";
$result_resume = mysqli_query($connection, $query_resume);

if (mysqli_num_rows($result_resume) > 0) {
    $resume_row = mysqli_fetch_assoc($result_resume);
    $resume_name = $resume_row['resume_name'];
    echo "<a href='download_resume.php?usn=$user_id'>Download Resume</a>";
} else {
    echo "<p>No resume uploaded.</p>";
}
?>

                        
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    
</body>
</html>

<?php

mysqli_close($connection);
?>
