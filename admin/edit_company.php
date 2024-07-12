<?php
include('../includes/connection.php');

if (isset($_POST['compid'])) {
    $compid = $_POST['compid'];

    $query = "SELECT * FROM company WHERE compid = '$compid'";
    $query_run = mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($query_run)) {
        echo '<form action="update_company.php" method="post">';
        echo '<input type="hidden" name="compid" value="' . htmlspecialchars($row['compid']) . '">';
        echo '<div class="mb-3">';
        echo '<label for="compname" class="form-label">Company Name</label>';
        echo '<input type="text" class="form-control" id="compname" name="compname" value="' . htmlspecialchars($row['compname']) . '">';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="category" class="form-label">Category</label>';
        echo '<input type="text" class="form-control" id="category" name="category" value="' . htmlspecialchars($row['category']) . '">';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="profile" class="form-label">Profile</label>';
        echo '<input type="text" class="form-control" id="profile" name="profile" value="' . htmlspecialchars($row['profile']) . '">';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="branch" class="form-label">Branch</label>';
        echo '<input type="text" class="form-control" id="branch" name="branch" value="' . htmlspecialchars($row['branch']) . '">';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="batch" class="form-label">Batch</label>';
        echo '<input type="text" class="form-control" id="batch" name="batch" value="' . htmlspecialchars($row['batch']) . '">';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="location" class="form-label">Location</label>';
        echo '<input type="text" class="form-control" id="location" name="location" value="' . htmlspecialchars($row['location']) . '">';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="criteria" class="form-label">Criteria</label>';
        echo '<input type="text" class="form-control" id="criteria" name="criteria" value="' . htmlspecialchars($row['criteria']) . '">';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="intern_duration" class="form-label">Intern Duration</label>';
        echo '<input type="text" class="form-control" id="intern_duration" name="intern_duration" value="' . htmlspecialchars($row['intern_duration']) . '">';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="mode" class="form-label">Mode</label>';
        echo '<input type="text" class="form-control" id="mode" name="mode" value="' . htmlspecialchars($row['mode']) . '">';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="offer" class="form-label">Offer</label>';
        echo '<input type="text" class="form-control" id="offer" name="offer" value="' . htmlspecialchars($row['offer']) . '">';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary">Update</button>';
        echo '</form>';
    } else {
        echo "No details found for this company.";
    }
}
?>
