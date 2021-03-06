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
    <link rel="stylesheet" type="text/css" href="css/leave_entry.css">
    <script>
    function fillResults(){
        document.getElementById('post_table').style.display = 'block';
        document.getElementById('post_table').innerHTML="<?php GetLeaveStatus($_SESSION['employeeID'])?>";   
    }
    </script>
</head>
<body>
    <?php include_once "navbars_user_admin.php"; ?>
        <div id="content">
            <div id="leave">
                <form action="" method="POST">
                <h2>LEAVE ENTRY</h2>
                <div class="label col-lg-4 col-md-6 col-sm-3">
                    <label for="select_dt">SELECT-DAY-TYPE: </label>
                </div>
                <div class="input col-lg-2 col-md-6 col-sm-3">
                    <select id="select_dt" name = "select_day_type" required class="form-select">
                        <option selected>&lt;--None--&gt;</option>
                        <option value="forenoon">Forenoon</option>
                        <option value="afternoon">Afternoon</option>
                        <option value="fullday">Full Day</option>
                        <option value="continuousday">Continuous Days</option>
                    </select>
                </div>
                <div  class="label col-lg-2 col-md-6 col-sm-3">
                    <label for="leave_ty">LEAVE-TYPE: </label>
                </div>
                <div class="input col-lg-4 col-md-6 col-sm-3">
                    <select id="leave_ty" name = "leave_type" required class="form-select">
                        <option selected>&lt;--None--&gt;</option>
                        <option value="leave">Leave</option>
                        <option value="medical">Medical</option>
                        <option value="exemption">Exemption</option>
                    </select>
                </div>
                <div class="label col-lg-4 col-md-6 col-sm-3">
                    <label for="l_date">FROM-DATE: </label>
                </div>
                <div class="input col-lg-2 col-md-6 col-sm-3">
                    <input type="date" id="l_date" name="from_date" required min="<?php echo date("Y-m-d");?>">
                </div>
                <div class="label col-lg-2 col-md-6 col-sm-3">
                    <label for="to_date">TO-DATE: </label>
                </div>
                <div class="input col-lg-4 col-md-6 col-sm-3">
                    <input type="date" id="to_date" name="to_date" required min="<?php echo date("Y-m-d");?>">
                </div>
                <center><button type="submit" name = "submit_leave_entry" id="l_btn" class="btn btn-outline-success">APPLY</button></center>
                </form>
                <div id="post_table"><script>fillResults();</script> </div>
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

//Function to Submit Leave Entry
if(isset($_POST['submit_leave_entry'])){
    $conn = ConnectDB();
    $select_day_type = $_POST['select_day_type'];
    $leave_type = $_POST['leave_type'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $from_date = strtotime(str_replace('.','-',$from_date));
    $from_date = date("Y-m-d",$from_date);
    $to_date = strtotime(str_replace('.','-',$to_date));
    $to_date = date("Y-m-d",$to_date);
    $leave_reason = "";
    $status = "pending";
    if($to_date >= $from_date){
        if((strcmp($select_day_type,'forenoon') == 0) || (strcmp($select_day_type,'afternoon') == 0 ) || (strcmp($select_day_type,'fullday') == 0 )){
            if($to_date == $from_date){
                $query="SELECT * from leave_entry where (employeeID='{$_SESSION['employeeID']}' and from_date = '{$from_date}' and to_date = '{$to_date}' and day_type = '{$select_day_type}')";
                $result = mysqli_query($conn,$query);
                if(mysqli_num_rows($result) > 0 ){
                    $_SESSION['status'] = "Employee is already registered";
                    $_SESSION['status_code'] = "info";
                }
                else{
                    $query = "INSERT INTO leave_entry(employeeID,reason,from_date,to_date,leave_type,day_type,`status`) VALUES('{$_SESSION['employeeID']}','{$leave_reason}','{$from_date}','{$to_date}','{$leave_type}','{$select_day_type}','{$status}')";
                    if(! mysqli_query($conn,$query)){
                        $error = mysqli_error($conn);
                        echo $error;
                    }
                    else{
                        $_SESSION['status'] = "Leave Requested";
                        $_SESSION['status_code'] = "success";
                    }
                }
            }
            else{
                $_SESSION['status'] = "Invalid number of days selected";
                $_SESSION['status_code'] = "warning";
            }
        }
        else{
            if($to_date > $from_date){
                $query="SELECT * from leave_entry where (employeeID='{$_SESSION['employeeID']}' and from_date = '{$from_date}' and to_date = '{$to_date}' and day_type = '{$select_day_type}')";
                $result = mysqli_query($conn,$query);
                if(mysqli_num_rows($result) > 0 ){
                    $_SESSION['status'] = "Employee is already registered";
                    $_SESSION['status_code'] = "info";
                }
                else{
                    $query = "INSERT INTO leave_entry(employeeID,reason,from_date,to_date,leave_type,day_type,`status`) VALUES('{$_SESSION['employeeID']}','{$leave_reason}','{$from_date}','{$to_date}','{$leave_type}','{$select_day_type}','{$status}')";
                    if(! mysqli_query($conn,$query)){
                        $error = mysqli_error($conn);
                        echo $error;
                    }
                    else{
                        $_SESSION['status'] = "Leave Requested";
                        $_SESSION['status_code'] = "success";
                    }
                }
            }
            else{
                $_SESSION['status'] = "Invalid number of days selected";
                $_SESSION['status_code'] = "warning";
            }    
        }
    }
    else{
        $_SESSION['status'] = "Invalid number of days selected";
        $_SESSION['status_code'] = "warning";
    }
}

function GetLeaveStatus($employeeID){
    $conn = connectDB();    
    $query = "SELECT from_date,to_date,leave_type,reason,`status` FROM leave_entry WHERE employeeID = {$employeeID} ORDER BY from_date DESC";
    if($result = mysqli_query( $conn, $query)){
        $returnVal = TableLeaveStatus($result);
        mysqli_close($conn);
        return $returnVal;
    }
    else{
        printf("Error: %s\n", mysqli_error($conn));
    }
}

function TableLeaveStatus($result){
    if(mysqli_num_rows($result)==0){
        echo "<h1>No pending requests</h1>";
        return " ";
    }
    $row_count = 1;
    echo "<table id='req_table' class='table table-info table-hover'>";
    echo "<tr>";
    echo "<th>From date</th>";
    echo "<th>To date</th>";
    echo "<th>Leave Type</th>";
    echo "<th>Reason</th>";
    echo "<th>Status</th>";
    echo "</tr>";
    while ($row=mysqli_fetch_array($result)) {
    echo  "<tr>";
    echo  "<td>" . $row['from_date'] . "</td>";
    echo  "<td>" . $row['to_date'] . "</td>";
    echo  "<td>" . $row['leave_type'] . "</td>";
    echo  "<td>" . $row['reason'] . "</td>";
    echo  "<td>" . $row['status'] . "</td>";
    echo  "</tr>"; 
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