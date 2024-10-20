<?php
include('user_dashboard.php');
include('includes/connection.php');

// Assuming session contains user_id
$user_id = $_SESSION['user_id']; 

// Fetch student details
$student_query = "SELECT Branch, year, CGPA FROM user WHERE USN = '$user_id'";
$student_result = mysqli_query($connection, $student_query);
$student_data = mysqli_fetch_assoc($student_result);

// Debugging: Print the student data
// echo "<p>Debug: Student Data: " . print_r($student_data, true) . "</p>";

$student_branch = $student_data['Branch'];
$student_batch = $student_data['year'];
$student_cgpa = $student_data['CGPA'];

// Check if branch is retrieved correctly
if(empty($student_branch)) {
    echo "Error: Student branch is empty.";
} else {
    // Fetch companies the student has already applied to
    $applied_companies_query = "SELECT company_id FROM applications WHERE user_id = '$user_id'";
    $applied_companies_result = mysqli_query($connection, $applied_companies_query);
    $applied_companies = [];

    if (mysqli_num_rows($applied_companies_result) > 0) {
        while ($row = mysqli_fetch_assoc($applied_companies_result)) {
            $applied_companies[] = $row['company_id'];
        }
    }

    // Construct query based on applied companies
    if (!empty($applied_companies)) {
        $applied_companies_list = "'" . implode("','", $applied_companies) . "'";
        $query = "SELECT DISTINCT c.compid, c.compname 
                  FROM company c
                  JOIN company_branches cb ON c.compid = cb.compid
                  JOIN company_batches cbh ON c.compid = cbh.compid
                  WHERE c.compid NOT IN ($applied_companies_list)
                  AND cb.branch = '$student_branch'
                  AND cbh.batch = '$student_batch'
                  AND CAST(c.criteria AS DECIMAL(3,2)) <= $student_cgpa";
    } else {
        $query = "SELECT DISTINCT c.compid, c.compname 
                  FROM company c
                  JOIN company_branches cb ON c.compid = cb.compid
                  JOIN company_batches cbh ON c.compid = cbh.compid
                  WHERE cb.branch = '$student_branch'
                  AND cbh.batch = '$student_batch'
                  AND CAST(c.criteria AS DECIMAL(3,2)) <= $student_cgpa";
    }

    // Debugging: Print the query
    // echo "<p>Debug SQL Query: $query</p>";

    $query_run = mysqli_query($connection, $query);
    if (!$query_run) {
        echo "Error in query: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Style.css">
    <style>
        .company-details h3 {
            text-align: center;
            margin-bottom: 20px;
            white-space: nowrap; 
            text-overflow: ellipsis; 
        }

        button{
            width:200px;
        }
    </style> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#companySelect").change(function(){
                var compid = $(this).val();
                if (compid !== "") {
                    $.ajax({
                        url: "get_comp.php",
                        method: "POST",
                        data: { compid: compid },
                        success: function(data) {
                            $("#companyDetails").html(data);
                        }
                    });
                } else {
                    $("#companyDetails").html("");
                }
            });
        });
    </script>
</head>
<body>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form>
                    <div class="form-group">
                        <label for="companySelect"><h3>Select Company:</h3></label>
                        <select id="companySelect" class="form-control">
                            <option value="">--Select--</option>
                            <?php
                            if (isset($query_run) && mysqli_num_rows($query_run) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    echo '<option value="'.$row['compid'].'">'.$row['compname'].'</option>';
                                }
                            } else {
                                echo '<option value="">No companies available</option>';
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12" id="companyDetails">
                <!-- Company details will be displayed here -->
            </div>
        </div>
    </div>
</body>
</html>
