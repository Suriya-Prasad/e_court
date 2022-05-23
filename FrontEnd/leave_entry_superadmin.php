<?php
    //Session started for each user login and user ID is extracted to provide user specific functionalities.
    session_start();
    if(!isset ($_SESSION['employeeID'])) {
        header("Location:index.php");    
    } elseif ($_SESSION['employeeID'] > 1) { // if not admin, redirect to user page
        header("Location:leave_entry_user_admin.php");  
    }
    include_once "navigation.php";
?>

<!DOCTYPE html>
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
<<<<<<< Updated upstream
        document.getElementById('post_table').innerHTML="<?php GetSeniority()?>";   
=======
        document.getElementById('post_table').innerHTML="<?php GetLeaveRequests()?>";   
>>>>>>> Stashed changes
    }
    </script>
</head>
<body>
        <?php include_once "navbars.php"; ?>
        <div id="post_table">
            <script>fillResults();</script>
        </div>
    <script>
        var element = document.getElementById("leave_entry");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php
function GetLeaveRequests(){
    $conn = connectDB();     
    $query = "SELECT d.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,MIN(d.from_date) as join_date from employee as e, designation as d WHERE d.employeeID IN(select employeeID from designation where posting ='{$posting}' and to_date is null AND from_date is not null) AND posting = '{$posting}'  AND e.employeeID = d.employeeID GROUP BY employeeID ORDER BY join_date;";
    if($result = mysqli_query( $conn, $query)){
        $returnVal = seniorityTable($result);
        mysqli_close($conn);
        return $returnVal;
        }
    else{
        printf("Error: %s\n", mysqli_error($conn));
    }
}

function seniorityTable($result){
    if(mysqli_num_rows($result)==0){
        return "<script>swal({title:'No pending leave requests',icon:'info'});</script>";
    }
    echo "<br><br>";
    $row_count = 1;
    echo "<table id='req_table' class='table table-info table-hover'>";
    echo "<tr>";
    echo "<th>Employee ID</th>";
    echo "<th>Employee Name</th>";
    echo "<th>Leave Date</th>";
    echo "<th>Day Type</th>";
    echo "<th>Leave Type</th>";
    echo "<th>Reason</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    while ($row=mysqli_fetch_array($result)) {
    echo    "<tr>";
    echo  "<td>" . $row['employeeID'] . "</td>";
    echo  "<td>" . $row['employee_name'] . "</td>";
    echo  "<td>" . $row['join_date'] . "</td>";
    echo "</tr>"; 
    $row_count++;     
    }
    echo "</table>";
}

?>