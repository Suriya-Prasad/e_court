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
            <div id="e_property">
                <div class="align">
                    <form action="" method="POST">
                    <h2>E PROPERTY STATEMENTS</h2>
                    <label for="employeeID"> EMPLOYEE ID </label>
                    <input type="text" id="employeeID" name="employeeID"/>
                    <button type="submit" class="ser_btn btn btn-outline-success">VIEW</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('post_table').style.display = 'block';
        document.getElementById('post_table').innerHTML="<?php GetEPropertyStatements();?>";   
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/sweetalert.min.js"></script>
</body>
</html>

<?php

function GetEPropertyStatements(){
    $conn = connectDB();
    if(!isset($_POST['employeeID'])){
        return " ";
    }
    $employeeID = mysqli_real_escape_string($conn,$_POST['employeeID']);
    $query="SELECT CONCAT(first_name,' ',last_name)as employee_name from employee where employeeID='{$employeeID}';";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 1 ){
        $query1 = "SELECT * from e_property where employeeID ={$employeeID} ORDER BY uploadDate;";
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
        return "<h3>".$employeeID." does not exist</h3>";
    }
    $row=mysqli_fetch_array($result);
    echo "<h5 class='service_content1'>Employee ID : ".$employeeID." </h5>";
    echo "<h5 class='service_content'>Employee Name : ".strtoupper($row['employee_name'])." </h5>";
    $row_count = 1;
    echo "<table class='table table-info table-hover'>";
    echo "<tr>";
    echo "<th>DETAILS</th>";
    echo "<th>FILE</th>";
    echo "<th>UPLOAD DATE</th>";
    echo "</tr>";
    while ($row=mysqli_fetch_array($result1)) {
    echo "<tr>";
    echo "<td>" . $row['e_property_statementDetails'] . "</td>";
    echo "<td colspan='5'><a href='e_propertydocs/".$row['e_property_statementFile']." target='_blank'/> View File</a></td>";
    echo "<td>" . $row['uploadDate'] . "</td>";
    echo "</tr>"; 
    $row_count++;     
    }
    echo "</table>";
}

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