<?php
//  session_start();
include('user_dashboard.php');
include('includes/connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Function to fetch the user's resume details
function getUserResume($usn, $connection) {
    $select_query = "SELECT * FROM resume WHERE usn = ?";
    $stmt = mysqli_prepare($connection, $select_query);
    mysqli_stmt_bind_param($stmt, 's', $usn);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $resume_data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $resume_data;
}

if (isset($_POST['submit'])) {
    // Get the user's USN from the session
    $usn = $_SESSION['user_id'];

    // Process the uploaded file
    $resume_name = $_FILES['resume']['name'];
    $resume_tmp_name = $_FILES['resume']['tmp_name'];
    $resume_data = file_get_contents($resume_tmp_name); // Convert file to binary data

    // Check if the user already has a resume entry in the database
    $existing_resume = getUserResume($usn, $connection);

    if ($existing_resume) {
        // User already has a resume entry, update the existing one
        $update_query = "UPDATE resume SET resume_name = ?, resume_blob = ? WHERE usn = ?";
        $stmt = mysqli_prepare($connection, $update_query);
        mysqli_stmt_bind_param($stmt, 'sss', $resume_name, $resume_data, $usn);
        mysqli_stmt_send_long_data($stmt, 1, $resume_data); // Send binary data
        mysqli_stmt_execute($stmt);

        // Check if the resume was successfully updated
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Resume updated successfully');</script>";
        } else {
            echo "<script>alert('Failed to update resume');</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        // User doesn't have a resume entry, insert a new one
        $insert_query = "INSERT INTO resume (usn, resume_name, resume_blob) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connection, $insert_query);
        mysqli_stmt_bind_param($stmt, 'ssb', $usn, $resume_name, $resume_data);
        mysqli_stmt_send_long_data($stmt, 2, $resume_data); // Send binary data
        mysqli_stmt_execute($stmt);

        // Check if the resume was successfully uploaded
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Resume uploaded successfully');</script>";
        } else {
            echo "<script>alert('Failed to upload resume');</script>";
        }

        mysqli_stmt_close($stmt);
    }
}

// Check if the user has an existing resume
$resume_data = getUserResume($_SESSION['user_id'], $connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload or Edit Resume</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/Style.css">
    <style>
        .container{
            margin-left:230px;
        }
        form button{
            width:400px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="color:#888;">Upload or Edit Resume</h2>
        <?php if (!empty($resume_data)) : ?>
            <p style="color:#8b7878;">Your current resume: <?php echo $resume_data['resume_name']; ?></p>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="resume" style="color:#888;">Select New Resume (PDF only):</label>
                    <input type="file" class="form-control-file " style="color:#888;" id="resume" name="resume" accept=".pdf" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary" >Upload New Resume</button>
            </form>
        <?php else : ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="resume" style="color:#cfc6c6;">Select Resume (PDF only):</label>
                    <input type="file" class="form-control-file" id="resume" name="resume" accept=".pdf" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary" >Upload Resume</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
