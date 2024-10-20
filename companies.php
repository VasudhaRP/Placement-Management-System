<?php
include('user_dashboard.php');
include('includes/connection.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch all companies from the database along with branches and batches
$query = "
    SELECT 
        company.*, 
        GROUP_CONCAT(DISTINCT company_branches.branch SEPARATOR ', ') AS branches,
        GROUP_CONCAT(DISTINCT company_batches.batch SEPARATOR ', ') AS batches
    FROM company
    LEFT JOIN company_branches ON company.compid = company_branches.compid
    LEFT JOIN company_batches ON company.compid = company_batches.compid
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
    <title>All Companies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/Style.css">
    <style>
        .company-details {
            display: none;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <!-- <nav class="navbar navbar-light navbar-custom">
        <div class="container">
            <div class="row w-100" id="header">
                <div class="col-md-4">
                    <h3>Placement Management System</h3>
                </div>
                <div class="col-md-8 text-md-end">
                    <b>Email:</b> Test@gmail.com
                    <span><b>Name:</b> Test User</span>
                </div>
            </div>
        </div>
    </nav> -->
    <!-- End Header -->

    <!-- Main Content -->
    <div class="container mt-4" style="margin-left:230px;">
        <h2 style="margin-top:700px;padding-top:20px;text-align:center;color:#cfc6c6;">All Companies</h2>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title"><?php echo $row['compname']; ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><b>Category:</b> <?php echo $row['category']; ?></p>
                    <p class="card-text"><b>Profile:</b> <?php echo $row['profile']; ?></p>
                    <!-- Add more details as needed -->

                    <!-- More details button -->
                    <button class="btn btn-primary btn-sm more-details-btn" data-id="<?php echo $row['compid']; ?>">More</button>

                    <!-- Company details (hidden by default) -->
                    <div id="company-details-<?php echo $row['compid']; ?>" class="company-details">
                        <p><b>Branches:</b> <?php echo htmlspecialchars($row['branches']); ?></p>
                        <p><b>Batches:</b> <?php echo htmlspecialchars($row['batches']); ?></p>
                        <p><b>Location:</b> <?php echo htmlspecialchars($row['location']); ?></p>
                        <p><b>Criteria:</b> <?php echo htmlspecialchars($row['criteria']); ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <!-- End Main Content -->

    <script>
        $(document).ready(function(){
            $('.more-details-btn').click(function(){
                var compid = $(this).data('id');
                $('#company-details-' + compid).slideToggle();
            });
        });
    </script>
</body>
</html>

<?php
// Close connection
mysqli_close($connection);
?>
