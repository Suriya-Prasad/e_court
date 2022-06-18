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
    <link rel="stylesheet" type="text/css" href="css/leave_entry.css">
    <script>
    function fillResults(){
        document.getElementById('post_table').style.display = 'block';
        document.getElementById('post_table').innerHTML="<?php GetLeaveRequests();?>";   
    }
    </script>
</head>
<body>
    <?php include_once "navbars_superadmin.php"; ?>
        <div id="content">
            <div id="leave">
                <h2>PENDING REQUESTS</h2>
                <div id="post_table"><script>fillResults();</script></div>
            </div>
        </div>
    </div>

    <script>
        var element = document.getElementById("leave_entry");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js" ></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php

function GetLeaveRequests(){
    $conn = connectDB();  
    $query = "SELECT l.employeeID,l.from_date,l.to_date,l.leave_type,l.reason FROM leave_entry as l WHERE l.status = 'pending'";
    if($result = mysqli_query( $conn, $query)){
        $returnVal = TablePendingLeaveRequests($result);
        mysqli_close($conn);
        return $returnVal;
    }
    else{
        printf("Error: %s\n", mysqli_error($conn));
    }
}

function TablePendingLeaveRequests($result){
    if(mysqli_num_rows($result)==0){
        echo "<center><h2>No Pending Leave Requests</h2></center>";
        return "";
    }
    $row_count = 1;
    echo "<table id='req_table' class='table table-info table-hover'>";
    echo "<tr>";
    echo "<th>Employee ID</th>";
    // echo "<th>Employee Name</th>";
    echo "<th>From date</th>";
    echo "<th>To date</th>";
    echo "<th>Leave Type</th>";
    echo "<th>Reason</th>";
    echo "<th colspan='2'>Action</th>";
    echo "</tr>";
    while ($row=mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['employeeID'] . "</td>";
    // echo "<td>" . $row['employee_name'] . "</td>";
    echo "<td>" . $row['from_date'] . "</td>";
    echo "<td>" . $row['to_date'] . "</td>";
    echo "<td>" . $row['leave_type'] . "</td>";
    echo "<td>" . $row['reason'] . "</td>";
    echo "<td><button type='submit' id='acc' class='btn btn-outline-success'>APPROVE</button></td>";
    echo "<td><button type='submit' id='dec' class='btn btn-outline-danger'>DECLINE</button></td>";
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