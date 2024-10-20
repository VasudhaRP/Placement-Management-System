<?php
include('includes/connection.php');

if (isset($_POST['compid'])) {
    $compid = mysqli_real_escape_string($connection, $_POST['compid']);
    
    // Fetch company details along with branch and batch
    $query = "
        SELECT 
            company.*, 
            GROUP_CONCAT(DISTINCT company_branches.branch SEPARATOR ', ') AS branches, 
            GROUP_CONCAT(DISTINCT company_batches.batch SEPARATOR ', ') AS batches
        FROM 
            company
        LEFT JOIN 
            company_branches ON company.compid = company_branches.compid
        LEFT JOIN 
            company_batches ON company.compid = company_batches.compid
        WHERE 
            company.compid = '$compid'
        GROUP BY 
            company.compid
    ";
    
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
        echo '<div class="company-details-container">';
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
        echo '<label>Branches:</label>';
        echo '<input type="text" class="form-control" value="' . htmlspecialchars($row['branches']) . '" readonly>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label>Batches:</label>';
        echo '<input type="text" class="form-control" value="' . htmlspecialchars($row['batches']) . '" readonly>';
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
        echo '<form method="POST" action="apply.php">';
        echo '<input type="hidden" name="compid" value="' . htmlspecialchars($row['compid']) . '">';
        echo '<button type="submit" class="btn btn-primary">Apply Now</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="alert alert-danger">Company details not found.</div>';
    }
} else {
    echo '<div class="alert alert-danger">Invalid request.</div>';
}

// Close connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/Style.css">
    <style>
        body {
            /* background-color: #f8f9fa;  */
            padding-top: 60px; /* Space for top menubar */
        }
        .company-details-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 70vh; /* Center vertically */
        }
        .company-details {
            background-color: rgb(69, 120, 161);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary {
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<!-- Your top menubar HTML here -->

</body>
</html>
