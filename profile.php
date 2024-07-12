<?php
include('user_dashboard.php');
// session_start();

require 'includes/connection.php';

// Assuming user is logged in and their USN is stored in the session
$usn = $_SESSION['user_id'];

$sql = "SELECT * FROM user WHERE USN='$usn'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   
</head>
<body>
    <div class="profile-container">
        <h1>Student Profile</h1>
        <div class="profile-details">
            <p><strong>USN:</strong> <?php echo $row['USN']; ?></p>
            <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
            <p><strong>Year:</strong> <?php echo $row['year']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Mobile:</strong> <?php echo $row['mobile']; ?></p>
        </div>
        <button onclick="document.getElementById('editForm').style.display='block'">Edit</button>
    </div>

    <div id="editForm" class="modal">
        <form class="modal-content" action="update_profile.php" method="POST">
            <div class="container">
                <h2>Edit Profile</h2>
                <label for="name"><b>Name</b></label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

                <label for="year"><b>Year</b></label>
                <input type="text" name="year" value="<?php echo $row['year']; ?>" required>

                <label for="email"><b>Email</b></label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

                <label for="mobile"><b>Mobile</b></label>
                <input type="text" name="mobile" value="<?php echo $row['mobile']; ?>" required>

                <button type="submit">Save Changes</button>
                <button type="button" onclick="document.getElementById('editForm').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
