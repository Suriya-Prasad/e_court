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
    <link rel="stylesheet" type="text/css" href="css/discip_pro.css">
    <script>
    function fillResults(){
        document.getElementById('post_table').style.display = 'block';
        document.getElementById('post_table').innerHTML="<?php echo GetResults()?>";   
    }
    </script>
</head>
<body>
    <?php include_once "navbars_superadmin.php"; ?> 
        <div id="content">
            <div id="dis_pro">
                <h2>DISCIPLINARY PROCEEDINGS</h2>
                <form action="" method="POST">
                    <label for="employeeID">EMPLOYEE ID: </label>
                    <input type="text" id="employeeID" name="employeeID"/>
                    <span id="dis_btn_center">
                        <button type="submit" class="disc_btn1 btn btn-outline-success" id="submit_disciplinary_proceedings" name="submit_disciplinary_proceedings">VIEW</button>
                        <button type="submit" class="disc_btn2 btn btn-outline-success" id="all_disciplinary_proceedings" name="all_disciplinary_proceedings">VIEW ALL</button>
                    </span>
                </form>
                <div id="post_table"><script>fillResults();</script></div>
            </div>    
        </div>
    </div>

    <script>
        var element = document.getElementById("disciplinary_proceedings");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/sweetalert.min.js"></script>
</body>
</html>

<?php

function AllDisciplinaryProceedings(){
    $conn = ConnectDB();
    $query="SELECT d.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,d.disciplinary_proceeding_court_name,d.disciplinary_proceeding_details,d.start_date,d.end_date from employee as e,disciplinary_proceeding as d where e.employeeID=d.employeeID and d.end_date is null";
    $query1="SELECT d.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,d.disciplinary_proceeding_court_name,d.disciplinary_proceeding_details,d.start_date,d.end_date from employee as e,disciplinary_proceeding as d where e.employeeID=d.employeeID and d.end_date is not null";
    $result1 = mysqli_query($conn,$query1);
    if($result = mysqli_query( $conn, $query)){
        $returnVal = AllDisciplinaryProceedingsTable($result,$result1);
        mysqli_close($conn);
        return $returnVal;
    }
    else{
        printf("Error: %s\n", mysqli_error($conn));
    }
}

function SpecificDisciplinaryProceedings(){
    $conn = ConnectDB();
    $employeeID = $_POST['employeeID'];
    if(is_null($employeeID)){
        $_SESSION['status'] = "Enter a Valid Employee ID";
        $_SESSION['status_code'] = "warning";
    }
    $query = "SELECT CONCAT(e.first_name,' ',e.last_name)as employee_name from employee as e where employeeID='{$employeeID}';";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 1 ){
        $query1 ="SELECT d.disciplinary_proceeding_court_name,d.disciplinary_proceeding_details,d.start_date,d.end_date from disciplinary_proceeding as d where d.employeeID='{$employeeID}';";
        if($result1 = mysqli_query( $conn, $query1)){
            $returnVal = SpecificDisciplinaryProceedingsTable($result,$result1,$employeeID);
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


//Function to display the disciplinary proceedings

function AllDisciplinaryProceedingsTable($result,$result1){
    if(mysqli_num_rows($result)==0){
        echo "<center><h5 class='disc_head1'>No Active Record Found</h5></center>";
    }
    else{
        echo "<center><h5 class='disc_head1'>Active Proccedings</h5></center><br>";
        $row_count = 1;
        echo "<table class='table table-info table-hover'>";
        echo "<tr>";
        echo "<th>Employee ID</th>";
        echo "<th>Employee Name</th>";
        echo "<th>Recent Court</th>";
        echo "<th>Case Start Date</th>";
        echo "<th>Case End Date</th>";
        echo "<th>Details</th>";
        echo "</tr>";
        while ($row=mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['employeeID'] . "</td>";
            echo "<td>" . $row['employee_name'] . "</td>";
            echo "<td>" . $row['disciplinary_proceeding_court_name'] . "</td>";
            echo "<td>" . $row['start_date'] . "</td>";
            echo "<td>" . $row['end_date'] . "</td>";
            echo "<td>" . $row['disciplinary_proceeding_details'] . "</td>";
            echo "</tr>"; 
            $row_count++;     
        }
        echo "</table>";
    }
    if(mysqli_num_rows($result1)==0){
        echo "<center><h5 class='disc_head'>No Completed Record Found</h5></center>";
    }
    else{
        echo "<center><h5 class='disc_head'>Completed Proceedings</h5></center><br>";
        $row_count = 1;
        echo "<table class='table table-info table-hover'>";
        echo "<tr>";
        echo "<th>Employee ID</th>";
        echo "<th>Employee Name</th>";
        echo "<th>Recent Court</th>";
        echo "<th>Case Start Date</th>";
        echo "<th>Case End Date</th>";
        echo "<th>Details</th>";
        echo "</tr>";
        while ($row=mysqli_fetch_array($result1)) {
            echo "<tr>";
            echo "<td>" . $row['employeeID'] . "</td>";
            echo "<td>" . $row['employee_name'] . "</td>";
            echo "<td>" . $row['disciplinary_proceeding_court_name'] . "</td>";
            echo "<td>" . $row['start_date'] . "</td>";
            echo "<td>" . $row['end_date'] . "</td>";
            echo "<td>" . $row['disciplinary_proceeding_details'] . "</td>";
            echo "</tr>"; 
            $row_count++;     
        }
        echo "</table>";
    }
}

function SpecificDisciplinaryProceedingsTable($result,$result1,$employeeID){
        $row=mysqli_fetch_array($result);
        echo "<h5 class='service_content1'>Employee ID : ".$employeeID." </h5>";
        echo "<h5 class='service_content'>Employee Name : ".strtoupper($row['employee_name'])." </h5>";
        if(mysqli_num_rows($result1)==0){
            echo "<center><h5 class='service_content1>No Disciplinary Record Found</h5></center><br>";
        }
        else{
            $row_count = 1;
            echo "<table class='table table-info table-hover'>";
            echo "<tr>";
            echo "<th>Case Start Date</th>";
            echo "<th>Case End Date</th>";
            echo "<th>Recent Court</th>";
            echo "<th>Details</th>";
            echo "<th>Status</th>";
            echo "</tr>";
            while ($row=mysqli_fetch_array($result1)) {
                echo "<tr>";
                echo "<td>" . $row['start_date'] . "</td>";
                echo "<td>" . $row['end_date'] . "</td>";
                echo "<td>" . $row['disciplinary_proceeding_court_name'] . "</td>";
                echo "<td>" . $row['disciplinary_proceeding_details'] . "</td>";
                if(is_null($row['end_date'])){
                    echo "<td>Active</td>";    
                }
                else{
                    echo "<td>Completed</td>";
                }
                echo "</tr>";
                $row_count ++;
            }
            echo "</table>";
        }
}

function GetResults(){
    if(isset($_POST['submit_disciplinary_proceedings'])){
        return SpecificDisciplinaryProceedings();
    }
    else{
        return AllDisciplinaryProceedings();
    }
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