<?php
include('admin_dashboard.php');
// session_start();
include('../includes/connection.php');

// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: admin_login.php');
    exit;
}

// Handle form submission for editing companies
if (isset($_POST['edit_company'])) {
    $compid = mysqli_real_escape_string($connection, $_POST['compid']);
    $compname = mysqli_real_escape_string($connection, $_POST['compname']);
    $category = mysqli_real_escape_string($connection, $_POST['category']);
    $profile = mysqli_real_escape_string($connection, $_POST['profile']);
    $branches = explode(',', mysqli_real_escape_string($connection, $_POST['branch']));
    $batches = explode(',', mysqli_real_escape_string($connection, $_POST['batch']));
    $location = mysqli_real_escape_string($connection, $_POST['location']);
    $criteria = mysqli_real_escape_string($connection, $_POST['criteria']);
    $intern_duration = mysqli_real_escape_string($connection, $_POST['intern_duration']);
    $mode = mysqli_real_escape_string($connection, $_POST['mode']);
    $offer = mysqli_real_escape_string($connection, $_POST['offer']);

    // Update company details in database
    $query_update = "UPDATE company SET 
                     compname = '$compname', 
                     category = '$category', 
                     profile = '$profile', 
                     location = '$location', 
                     criteria = '$criteria', 
                     intern_duration = '$intern_duration', 
                     mode = '$mode', 
                     offer = '$offer' 
                     WHERE compid = '$compid'";

    $result_update = mysqli_query($connection, $query_update);

    if ($result_update) {
        // Update branches
        $delete_branches_query = "DELETE FROM company_branches WHERE compid='$compid'";
        mysqli_query($connection, $delete_branches_query);
        foreach ($branches as $branch) {
            $branch = trim($branch);
            $branch_query = "INSERT INTO company_branches (compid, branch) VALUES ('$compid', '$branch')";
            mysqli_query($connection, $branch_query);
        }

        // Update batches
        $delete_batches_query = "DELETE FROM company_batches WHERE compid='$compid'";
        mysqli_query($connection, $delete_batches_query);
        foreach ($batches as $batch) {
            $batch = trim($batch);
            $batch_query = "INSERT INTO company_batches (compid, batch) VALUES ('$compid', '$batch')";
            mysqli_query($connection, $batch_query);
        }

        echo "<script>alert('Company details updated successfully.');</script>";
    } else {
        echo "<script>alert('Failed to update company details.');</script>";
    }
}

// Fetch all companies from database
$query_companies = "SELECT * FROM company";
$result_companies = mysqli_query($connection, $query_companies);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Companies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/Style.css">
    <style>
        .container {
            margin-left: 230px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>All Companies</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Company ID</th>
                    <th>Company Name</th>
                    <th>Category</th>
                    <th>Profile</th>
                    <th>Branch</th>
                    <th>Batch</th>
                    <th>Location</th>
                    <th>Criteria</th>
                    <th>Intern Duration</th>
                    <th>Mode</th>
                    <th>Offer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_companies)) : 
                    // Fetch branches for the current company
                    $compid = $row['compid'];
                    $branches_query = "SELECT branch FROM company_branches WHERE compid = '$compid'";
                    $branches_result = mysqli_query($connection, $branches_query);
                    $branches = [];
                    while ($branch_row = mysqli_fetch_assoc($branches_result)) {
                        $branches[] = $branch_row['branch'];
                    }
                    $branches_str = implode(',', $branches);

                    // Fetch batches for the current company
                    $batches_query = "SELECT batch FROM company_batches WHERE compid = '$compid'";
                    $batches_result = mysqli_query($connection, $batches_query);
                    $batches = [];
                    while ($batch_row = mysqli_fetch_assoc($batches_result)) {
                        $batches[] = $batch_row['batch'];
                    }
                    $batches_str = implode(',', $batches);
                ?>
                    <tr>
                        <form method="post" action="">
                            <input type="hidden" name="compid" value="<?php echo $row['compid']; ?>">
                            <td><?php echo $row['compid']; ?></td>
                            <td><input type="text" name="compname" value="<?php echo $row['compname']; ?>"></td>
                            <td><input type="text" name="category" value="<?php echo $row['category']; ?>"></td>
                            <td><input type="text" name="profile" value="<?php echo $row['profile']; ?>"></td>
                            <td><input type="text" name="branch" value="<?php echo htmlspecialchars($branches_str); ?>"></td>
                            <td><input type="text" name="batch" value="<?php echo htmlspecialchars($batches_str); ?>"></td>
                            <td><input type="text" name="location" value="<?php echo $row['location']; ?>"></td>
                            <td><input type="text" name="criteria" value="<?php echo $row['criteria']; ?>"></td>
                            <td><input type="text" name="intern_duration" value="<?php echo $row['intern_duration']; ?>"></td>
                            <td><input type="text" name="mode" value="<?php echo $row['mode']; ?>"></td>
                            <td><input type="text" name="offer" value="<?php echo $row['offer']; ?>"></td>
                            <td><input type="submit" name="edit_company" value="Save" class="btn btn-primary"></td>
                        </form>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close connection
mysqli_close($connection);
?>
  