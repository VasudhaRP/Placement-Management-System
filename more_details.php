<?php
include('includes/connection.php');

if (isset($_POST['compid'])) {
    $compid = mysqli_real_escape_string($connection, $_POST['compid']);
    $query = "SELECT * FROM company WHERE compid = '$compid'";
    $query_run = mysqli_query($connection, $query);

    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Company Details</title>';
    echo '<link rel="stylesheet" type="text/css" href="css/styles.css">';
    echo '</head>';
    echo '<body>';

    if (mysqli_num_rows($query_run) > 0) {
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
        echo '</div>';
    } else {
        echo '<div class="alert alert-danger">Company details not found.</div>';
    }
    echo '</body>';
    echo '</html>';
}
?>

