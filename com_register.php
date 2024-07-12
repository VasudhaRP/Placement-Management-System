<?php 
include('user_dashboard.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/Style.css">
    <style>
        .company-details {
            /* border: 1px solid #ccc; */
            padding: 15px;
            margin-top: 150px;
            margin-left:250px;
            padding:20px;
            width:200px;
        }

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
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <label><h3>Select Company:</h3></label>
                        <select id="companySelect" class="form-control">
                            <option value="">--Select--</option>
                            <?php
                                include('includes/connection.php');
                                $query = "SELECT compid, compname FROM company";
                                $query_run = mysqli_query($connection, $query);
                                if(mysqli_num_rows($query_run) > 0){
                                    while($row = mysqli_fetch_assoc($query_run)){
                                        echo '<option value="'.$row['compid'].'">'.$row['compname'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="companyDetails">
                <!-- Company details will be displayed here -->
            </div>
        </div>
    </div>
</body>
</html>