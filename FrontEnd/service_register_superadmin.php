<!DOCTYPE html>
<?php
    include_once "navigation.php";
    include_once "actions.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/seniority.css">
</head>
<body>
    <?php include_once "navbars.php"; ?> 
        <div id="content">
            <div id="sr_sa">
                <form action="" method="POST">
                    <label for="employeeID">EMPLOYEE ID: </label>
                    <input type="text" id="employeeID" name="employeeID"/>
                    <button type="submit" class="btn btn-outline-success">VIEW</button>
                </form>
                <div id="post_table"></div>
            </div>    
        </div>
    </div>

    <script>
        var element = document.getElementById("staff_info");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
        var element2 = document.getElementById("service_register");
        element2.classList.remove("btn-outline-secondary");
        element2.classList.add("btn-secondary");
    </script>
    <script>
        document.getElementById('post_table').style.display = 'block';
        document.getElementById('post_table').innerHTML="<?php GetServiceRegistry();?>";   
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<script src="js/sweetalert.min.js" ></script>
<?php

include_once "db_connection.php";

function GetServiceRegistry(){
    $conn = ConnectDB();
    if(!isset($_POST['employeeID'])){
        return "candyman";
    }
    $employeeID = $_POST['employeeID'];
    $query="SELECT CONCAT(first_name,' ',last_name)as employee_name,service_joining_date from employee where employeeID={$employeeID};";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 1 ){
        $query1 = "SELECT * from designation where employeeID ={$employeeID} ORDER BY from_date;";
        if($result1 = mysqli_query( $conn, $query1)){
            $returnVal = service_registryTable($result1,$result,$employeeID);
            mysqli_close($conn);
            return $returnVal;
        }
        else{
            $_SESSION['status'] = "Something went wrong";
            $_SESSION['status_code'] = "info";
        }
    }
    else{
        $_SESSION['status'] = "Employee does not exist";
        $_SESSION['status_code'] = "warning";
    }
}

//Function to display the seriority of a posting
function service_registryTable($result1,$result,$employeeID){
    if(mysqli_num_rows($result)==0){
        return "<script>swal({title:'No employee record found',icon:'info'});</script>";
    }
    $row=mysqli_fetch_array($result);
    echo "<h2>Employee ID : ".$employeeID." </h2><br>";
    echo "<h2>Employee Name : ".strtoupper($row['employee_name'])." </h2><br>";
    echo "<h2>Service Joining Date : ".$row['service_joining_date']." </h2><br>";  //display employee name and service joining date here
    $row_count = 1;
    echo "<table class='table table-info table-hover'>";
    echo "<tr>";
    echo "<th>POST</th>";
    echo "<th>COURT</th>";
    echo "<th>JOIN DATE</th>";
    echo "<th>RELIVE DATE</th>";
    echo "</tr>";
    while ($row=mysqli_fetch_array($result1)) {
    echo "<tr>";
    echo "<td>" . $row['posting'] . "</td>";
    echo "<td>" . $row['court'] . "</td>";
    echo "<td>" . $row['from_date'] . "</td>";
    echo "<td>" . $row['to_date'] . "</td>";
    echo "</tr>"; 
    $row_count++;     
    }
    echo "</table>";
}

?>