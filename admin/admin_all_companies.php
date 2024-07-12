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
    $compid = $_POST['compid'];
    $compname = $_POST['compname'];
    $category = $_POST['category'];
    $profile = $_POST['profile'];
    $branch = $_POST['branch'];
    $batch = $_POST['batch'];
    $location = $_POST['location'];
    $criteria = $_POST['criteria'];
    $intern_duration = $_POST['intern_duration'];
    $mode = $_POST['mode'];
    $offer = $_POST['offer'];

    // Update company details in database
    $query_update = "UPDATE company SET 
                     compname = '$compname', 
                     category = '$category', 
                     profile = '$profile', 
                     branch = '$branch', 
                     batch = '$batch', 
                     location = '$location', 
                     criteria = '$criteria', 
                     intern_duration = '$intern_duration', 
                     mode = '$mode', 
                     offer = '$offer' 
                     WHERE compid = '$compid'";

    $result_update = mysqli_query($connection, $query_update);

    if ($result_update) {
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
        .container{
            margin-left:230px;
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
                <?php while ($row = mysqli_fetch_assoc($result_companies)) : ?>
                    <tr>
                        <form method="post" action="">
                            <input type="hidden" name="compid" value="<?php echo $row['compid']; ?>">
                            <td><?php echo $row['compid']; ?></td>
                            <td><input type="text" name="compname" value="<?php echo $row['compname']; ?>"></td>
                            <td><input type="text" name="category" value="<?php echo $row['category']; ?>"></td>
                            <td><input type="text" name="profile" value="<?php echo $row['profile']; ?>"></td>
                            <td><input type="text" name="branch" value="<?php echo $row['branch']; ?>"></td>
                            <td><input type="text" name="batch" value="<?php echo $row['batch']; ?>"></td>
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
