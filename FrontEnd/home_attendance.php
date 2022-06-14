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
        function dp(){
            let x = document.getElementById('dp_inp').style.display;
            if (x == "none")
                document.getElementById("dp_inp").style.display = "block";
            else
                document.getElementById("dp_inp").style.display = "none";
        }

        function fillResults(){
            document.getElementById('content').style.display = 'block';   
        }
    </script>
</head>
<body>
        <?php 
        if($_SESSION['employeeID'] == 1){
            include_once "navbars_superadmin.php"; 
        }
        else{
            include_once "navbars_user_admin.php";
        }
        ?>


        <div id="content">
            <div id="attendance">
            <h2>ATTENDANCE</h2>
            <script>fillResults();</script>
            <label for="date">DATE: </label>
            <input type="date" id="date" name="date" max="<?php echo date("Y-m-d");?>">
            <table id="op_table" class="table table-info table-hover">
                <tr>
                    <th>S.No</th><th>Date</th><th>Name</th><th>Id</th><th>Attendance</th><th>Time</th>
                </tr>
                <tr>
                    <td>1</td><td>25/04/2022</td><td>Vishwa</td><td>2353463642</td><td>NO</td><td>10:33</td>
                </tr>
                <tr>
                    <td>2</td><td>25/04/2022</td><td>Suganya</td><td>2353111642</td><td>YES</td><td>10:12</td>
                </tr>
                <tr>
                    <td>3</td><td>25/04/2022</td><td>Ganesh</td><td>2311163642</td><td>YES</td><td>9:54</td>
                </tr>
                <tr>
                    <td>4</td><td>25/04/2022</td><td>Arul</td><td>2353463111</td><td>YES</td><td>9:30</td>
                </tr>
            </table>
            </div>
        </div>

        
    </div>
    <script>
        var element = document.getElementById("attend");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php include_once "actions.php"; ?>