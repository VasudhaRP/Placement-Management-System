<?php
include('../includes/connection.php');

if (isset($_GET['usn'])) {
    $usn = $_GET['usn'];

    // Fetch resume details from database
    $query = "SELECT resume_name, resume_blob FROM resume WHERE usn = '$usn'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $resume_name = $row['resume_name'];
        $resume_blob = $row['resume_blob'];

        // Set headers for file download
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"" . basename($resume_name) . "\"");
        header("Content-Length: " . strlen($resume_blob));

        // Output the file
        echo $resume_blob;
        exit;
    } else {
        echo "Resume not found.";
    }
} else {
    echo "Invalid request.";
}
?>
