<?php
session_start();
include('includes/connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch the logged-in user's email
$user_email = $_SESSION['user_id'];

// Check if a resume is already uploaded
$query = "SELECT resume FROM users WHERE email = '$user_email'";
$result = mysqli_query($connection, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($connection));
}

$row = mysqli_fetch_assoc($result);
$resume_filename = $row['resume'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Resume</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/Style.css">
    <style>
        .container {
            margin-left: 230px;
        }
        .resume-viewer {
            width: 100%;
            height: 500px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload Resume</h2>

        <?php if ($resume_filename): ?>
            <div class="alert alert-info" role="alert">
                <strong>Existing Resume:</strong>
            </div>
            <!-- Display the resume PDF if available -->
            <iframe class="resume-viewer" src="uploads/<?php echo htmlspecialchars($resume_filename); ?>" frameborder="0"></iframe>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                No resume uploaded. Please upload your resume below.
            </div>
        <?php endif; ?>

        <form action="upload_resume_process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="resume" style="color:#cfc6c6;">Select Resume (PDF only):</label>
                <input type="file" class="form-control-file" id="resume" name="resume" accept=".pdf" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</body>
</html>
