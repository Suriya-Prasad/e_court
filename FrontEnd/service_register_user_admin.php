<!DOCTYPE html>
<?php
    include_once "navigation.php";
    include_once "db_connection.php";
    if(strcmp($_SESSION['employee_role'],"super admin")==0){
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
    <link rel="stylesheet" type="text/css" href="css/service_reg.css">
    <script>
    function fillResults(){
        document.getElementById('post_table').style.display = 'block';
        document.getElementById('post_table').innerHTML="<?php GetServiceRegistry($_SESSION['employeeID'])?>";   
    }
    </script>
</head>
<body>
    <?php include_once "navbars_user_admin.php"; ?>
        <div id="content">
            <div id="sr">
                <h2>VIEW SERVICE REGISTRY</h2>
                <div id="post_table"><script>fillResults();</script> </div>
            </div>
        </div>
    </div>

    <script>
        var element2 = document.getElementById("service_register");
        element2.classList.remove("btn-outline-secondary");
        element2.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js" ></script>
    <script src="js/main.js"></script>
</body>
</html>


<?php

function GetServiceRegistry($employeeID){
    $conn = connectDB();
    $query="SELECT CONCAT(first_name,' ',last_name)as employee_name,service_joining_date from employee where employeeID={$employeeID};";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 1 ){
        $query1 = "SELECT d.from_date,d.to_date,p.postingsName,c.courtName,c.courtPlace from designation as d,postings as p,courts as c where employeeID ={$employeeID} and d.courtID=c.courtID and d.postingsID=p.postingsID ORDER BY from_date;";
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

function service_registryTable($result1,$result,$employeeID){
    if(mysqli_num_rows($result)==0){
        return "<center><h3>No Record Found</h3></center>";
    }
    $row=mysqli_fetch_array($result);
    echo "<h5 class='service_content'>Employee ID : ".$employeeID." </h5>";
    echo "<h5 class='service_content'>Employee Name : ".strtoupper($row['employee_name'])." </h5>";
    echo "<h5 class='service_content'>Service Joining Date : ".$row['service_joining_date']." </h5>";  //display employee name and service joining date here
    $row = mysqli_fetch_array($result1);
    echo "<table class='table table-info table-hover'>";
    echo "<tr>";
    echo "<th>POST</th>";
    echo "<th>COURT</th>";
    echo "<th>JOIN DATE</th>";
    echo "<th>RELIVE DATE</th>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . $row['postingsName'] . "</td>";
    echo "<td>" . $row['courtName']." , ". $row['courtPlace']  . "</td>";
    echo "<td>" . $row['from_date'] . "</td>";
    echo "<td>" . $row['to_date'] . "</td>";
    echo "</tr>";
    echo "</table>";
}
?>

<?php
    if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
        ?>
        <script>
            swal({
                title:"<?php echo $_SESSION['status']; ?>",
                icon:"<?php echo $_SESSION['status_code']; ?>",
                button:"OK",
            });
        </script>
    <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_code']);
    }
?>