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
    <link rel="stylesheet" type="text/css" href="css/leave_entry.css">
    <script>
    function fillResults(){
        document.getElementById('post_table').style.display = 'block';
        document.getElementById('post_table').innerHTML="<?php GetLeaveStatus($_SESSION['employeeID'])?>";   
    }
    </script>
</head>
<body onload="fillResults()">
    <?php include_once "navbars_user_admin.php"; ?>
        <div id="content">
            <div id="leave">
                <form action="" method="POST">
                <h2>LEAVE ENTRY</h2>
                <div class="label col-lg-4 col-md-6 col-sm-3">
                    <label for="select_dt">SELECT-DAY-TYPE: </label>
                </div>
                <div class="input col-lg-2 col-md-6 col-sm-3">
                    <select id="select_dt" name = "select_day_type" class="form-select">
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
                    <select id="leave_ty" name = "leave_type" class="form-select">
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
                    <input type="date" id="l_date" name="from_date">
                </div>
                <div class="label col-lg-2 col-md-6 col-sm-3">
                    <label for="to_date">TO-DATE: </label>
                </div>
                <div class="input col-lg-4 col-md-6 col-sm-3">
                    <input type="date" id="to_date" name="to_date">
                </div>
                <center><button type="submit" name = "submit_leave_entry" id="l_btn" class="btn btn-outline-success">APPLY</button></center>
                </form>
                <div id="post_table"></div>
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
    <script src="js/main.js"></script>
</body>
</html>

<script src="js/sweetalert.min.js" ></script>

<?php

include_once "db_connection.php";

function GetLeaveStatus($employeeID){
    $conn = connectDB();    
    $query = "SELECT from_date,to_date,leave_type,reason,`status` FROM leave_entry WHERE employeeID = {$employeeID}";
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
        return "<h1>NO pending requests</h1>";
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

?>