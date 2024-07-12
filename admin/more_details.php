<?php
include('../includes/connection.php');

if (isset($_POST['compid'])) {
    $compid = $_POST['compid'];

    $query = "SELECT * FROM company WHERE compid = '$compid'";
    $query_run = mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($query_run)) {
        echo "<p><strong>Company Name:</strong> " . htmlspecialchars($row['compname']) . "</p>";
        echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
        echo "<p><strong>Profile:</strong> " . htmlspecialchars($row['profile']) . "</p>";
        echo "<p><strong>Branch:</strong> " . htmlspecialchars($row['branch']) . "</p>";
        echo "<p><strong>Batch:</strong> " . htmlspecialchars($row['batch']) . "</p>";
        echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
        echo "<p><strong>Criteria:</strong> " . htmlspecialchars($row['criteria']) . "</p>";
        echo "<p><strong>Intern Duration:</strong> " . htmlspecialchars($row['intern_duration']) . "</p>";
        echo "<p><strong>Mode:</strong> " . htmlspecialchars($row['mode']) . "</p>";
        echo "<p><strong>Offer:</strong> " . htmlspecialchars($row['offer']) . "</p>";
    } else {
        echo "No details found for this company.";
    }
}
?>
