<?php
// session_start();
include('user_dashboard.php');
include('includes/connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch the companies the user has applied to along with branches and batches
$query = "
    SELECT 
        company.compname, 
        company.category, 
        company.profile, 
        GROUP_CONCAT(DISTINCT company_branches.branch SEPARATOR ', ') AS branches,
        GROUP_CONCAT(DISTINCT company_batches.batch SEPARATOR ', ') AS batches,
        company.location, 
        company.criteria, 
        company.intern_duration, 
        company.mode, 
        company.offer
    FROM applications
    INNER JOIN company ON applications.company_id = company.compid
    LEFT JOIN company_branches ON company.compid = company_branches.compid
    LEFT JOIN company_batches ON company.compid = company_batches.compid
    WHERE applications.user_id = '$user_id'
    GROUP BY company.compid
";
$result = mysqli_query($connection, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Companies</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/Style.css">
</head>
<style>
    .container {
        margin-left: 230px;
    }
</style>
<body>
    <div class="container">
        <h2>Registered Companies</h2>
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Category</th>
                        <th>Profile</th>
                        <th>Branches</th>
                        <th>Batches</th>
                        <th>Location</th>
                        <th>Criteria</th>
                        <th>Intern Duration</th>
                        <th>Mode</th>
                        <th>Offer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['compname']); ?></td>
                            <td><?php echo htmlspecialchars($row['category']); ?></td>
                            <td><?php echo htmlspecialchars($row['profile']); ?></td>
                            <td><?php echo htmlspecialchars($row['branches']); ?></td>
                            <td><?php echo htmlspecialchars($row['batches']); ?></td>
                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                            <td><?php echo htmlspecialchars($row['criteria']); ?></td>
                            <td><?php echo htmlspecialchars($row['intern_duration']); ?></td>
                            <td><?php echo htmlspecialchars($row['mode']); ?></td>
                            <td><?php echo htmlspecialchars($row['offer']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info">You have not applied to any companies yet.</div>
        <?php } ?>
    </div>
</body>
</html>
