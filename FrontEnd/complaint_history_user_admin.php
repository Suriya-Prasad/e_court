<!DOCTYPE html>
<?php
    include_once "navigation.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/attendance.css">
    <script>
        function fillResults(){
            document.getElementById('content').style.display = 'block';   
        }
    </script>
</head>
<body>
    <?php include_once "navbars_user_admin.php";?>

        <div id="content">
           
        </div>
        
    </div>
    <script>
        var element = document.getElementById("complaints_greviance");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
        var element1 = document.getElementById("complaint_history");
        element1.classList.remove("btn-outline-secondary");
        element1.classList.add("btn-secondary");
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php
    echo "<table class='table table-bordered'>";
    echo "<tr>";
    echo "<th>Complaint Number</th>";
    echo "<th>Reg Date</th>";
    echo "<th>Last Updation Date</th>";
    echo "<th>Status</th>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>1</td>";
    echo "<td>2017-03-30 22:22:40</td>";
    echo "<td>2018-09-05 22:38:27</td>";
    echo "<td>Closed</td>";
    echo "</tr>";
    echo "</table>";
?>