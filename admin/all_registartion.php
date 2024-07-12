<?php
include('admin_dashboard.php');
// session_start();
include('../includes/connection.php');

// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: admin_login.php');
    exit;
}

// Fetch list of companies
$query_companies = "SELECT * FROM company";
$result_companies = mysqli_query($connection, $query_companies);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/Style.css">
    <style>
        .container{
            margin-left:300px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Registration Details</h2>
        <div class="row">
            <div class="col-md-4">
                <h5>Select a Company:</h5>
                <ul class="list-group">
                    <?php while ($row = mysqli_fetch_assoc($result_companies)) : ?>
                        <li class="list-group-item">
                            <a href="?company_id=<?php echo $row['compid']; ?>"><?php echo $row['compname']; ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <div class="col-md-8">
                <?php
                // Handle selection of a company
                if (isset($_GET['company_id'])) {
                    $company_id = $_GET['company_id'];

                    // Query to fetch registrations for selected company
                    $query_registrations = "SELECT u.*, a.application_date 
                                           FROM applications a 
                                           JOIN user u ON a.user_id = u.USN 
                                           WHERE a.company_id = '$company_id'";
                    $result_registrations = mysqli_query($connection, $query_registrations);

                    if (mysqli_num_rows($result_registrations) > 0) {
                        echo "<h5>Registrations for Selected Company:</h5>";
                        echo "<table class='table'>
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Application Date</th>
                                    </tr>
                                </thead>
                                <tbody>";

                        while ($row = mysqli_fetch_assoc($result_registrations)) {
                            echo "<tr>
                                    <td>{$row['USN']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['mobile']}</td>
                                    <td>{$row['application_date']}</td>
                                  </tr>";
                        }

                        echo "</tbody></table>";
                    } else {
                        echo "<p>No registrations found for this company.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
// Close connection
mysqli_close($connection);
?>
