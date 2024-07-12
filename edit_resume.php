<?php
session_start();
include('includes/connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Function to delete the old resume file
function deleteOldResume($usn, $connection) {
    $select_query = "SELECT resume_path FROM resume WHERE usn = ?";
    $stmt = mysqli_prepare($connection, $select_query);
    mysqli_stmt_bind_param($stmt, 's', $usn);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $resume_path);

    if (mysqli_stmt_fetch($stmt)) {
        unlink($resume_path); // Delete the file from the server
    }

    mysqli_stmt_close($stmt);
}

if (isset($_POST['submit'])) {
    // Get the user's USN from the session
    $usn = $_SESSION['user_id'];

    // Check if there's an existing resume, and delete it
    deleteOldResume($usn, $connection);

    // Process the uploaded file
    $resume_name = $_FILES['resume']['name'];
    $resume_tmp_name = $_FILES['resume']['tmp_name'];
    $resume_path = 'uploads/' . $resume_name;

    // Move the uploaded file to the uploads directory
    if (move_uploaded_file($resume_tmp_name, $resume_path)) {
        // Prepare the insert statement
        $insert_query = "INSERT INTO resume (usn, resume_name, resume_path) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($connection, $insert_query);

        // Bind parameters and execute the statement
        mysqli_stmt_bind_param($stmt, 'sss', $usn, $resume_name, $resume_path);
        mysqli_stmt_execute($stmt);

        // Check if the resume was successfully uploaded
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>alert('Resume uploaded successfully');</script>";
        } else {
            echo "<script>alert('Failed to upload resume');</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Failed to move uploaded file');</script>";
    }
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
</head>
<body>
    <div class="container">
        <h2>Upload or Edit Resume</h2>
        <?php if (!empty($resume_data)) : ?>
            <p>Your current resume: <?php echo $resume_data['resume_name']; ?></p>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="resume">Select New Resume (PDF only):</label>
                    <input type="file" class="form-control-file" id="resume" name="resume" accept=".pdf" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Upload New Resume</button>
            </form>
            <br>
            <form action="edit_resume.php" method="post">
                <button type="submit" class="btn btn-secondary">Edit Resume</button>
            </form>
        <?php else : ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="resume">Select Resume (PDF only):</label>
                    <input type="file" class="form-control-file" id="resume" name="resume" accept=".pdf" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Upload Resume</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
