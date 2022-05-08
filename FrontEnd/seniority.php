<?php
    //Session started for each user login and user ID is extracted to provide user specific functionalities.
    session_start();
    if(! isset ($_SESSION['employeeID'])) {
        header("Location:index.php");    
    }
    include "navigation.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/home_attendance.css">
    <link rel="stylesheet" type="text/css" href="css/seniority.css">
    <!-- <script>
    function fillResults(){
        document.getElementById('post_table').style.display = 'block';
        document.getElementById('post_table').innerHTML="";   
    }
    </script> -->
</head>
<body>
    <?php include "navbars.php"; ?>

        <div id="content">

            <center>
                <br><br>
                <form action="actions.php" method="POST">
                <p>POST :
                <select id="post" class="form-select" name = "SeniorityForm" onchange="this.form.submit()">
                    <option selected>&lt;--None--&gt;</option>
                    <option value="post 1">Post One</option>
                    <option value="post 2">Post Two</option>
                    <option value="post 3">Post Three</option>
                </select></p>
                </form>
            </center>
            <br>
            <div id="post_table">
                <!-- <script>fillResults();</script> -->
            </div>
        </div>
    </div>
    </form>    
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php include "actions.php"; ?>