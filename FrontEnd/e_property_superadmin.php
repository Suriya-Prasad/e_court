<!DOCTYPE html>
<?php
    include_once "navigation.php";
    include_once "db_connection.php";
    if(strcmp($_SESSION['employee_role'],"super admin")!=0){
        header("Location:home_attendance.php");
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/comp_gre.css">
</head>
<body>
    <?php include_once "navbars_superadmin.php"; ?> 
        <div id="content">
            <div id="co-gr">
                <h2>PROPERTY</h2>
                <div class="align">
                    <div class="label col-lg-5 col-md-5 col-sm-5">
                        <label for="employeeID">EMPLOYEE-ID:</label>
                    </div>
                    <div class="input col-lg-7 col-md-7 col-sm-7">
                    <input type="text" id="employeeID" required name="employeeID" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"/>
                    </div>
                </div>
                <center><button type="submit" id="get_prop_btn" name="get_property" class="btn btn-outline-success">GET PROPERTY</button></center>
            </div>
        </div>
    </div>

    <script>
        var element = document.getElementById("staff_info");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
        var element1 = document.getElementById("property");
        element1.classList.remove("btn-outline-secondary");
        element1.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/sweetalert.min.js"></script>
</body>
</html>
