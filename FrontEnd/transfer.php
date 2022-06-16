<!DOCTYPE html>
<?php
    include_once "navigation.php";
    if(strcmp($_SESSION['employee_role'],"super admin")!=0){
        header("Location:home_attendance.php");
    }
    include_once "db_connection.php";
    $conn = connectDB(); 
    $query2 = "SELECT * FROM courts";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/posting.css">
</head>
<body>
<?php include_once "navbars_superadmin.php";?>

        <div id="content">
        <div id="transfer">
        <center>
            <h2>TRANSFER</h2>
            <form action="" method="POST">
                <label for="employeeID">EMPLOYEE ID: </label>
                <input type="text" id="employeeID" name="employeeID">
                <p>FROM COURT :
                <select id="court-from" name="court_from" class="form-select">
                    <option selected value="none">&lt;--None--&gt;</option>
                    <?php
                    $result = mysqli_query($conn, $query2);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=".$row['courtID'].">".$row['courtName']." , ".$row['courtPlace']."</option>";
                    }
                    ?>
                </select></p>
                <p>TO COURT  :
                <select id="post-to" name="court_to" class="form-select">
                    <option selected value="none">&lt;--None--&gt;</option>
                    <?php
                    $result = mysqli_query($conn, $query2);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=".$row['courtID'].">".$row['courtName']." , ".$row['courtPlace']."</option>";
                    }
                    ?>
                </select></p>
                <div class="label col-lg-4 col-md-6 col-sm-6">
                    <label for="leave_date">RELIVE DATE: </label>
                </div>
                <div class="input col-lg-2 col-md-6 col-sm-6">
                    <input type="date" id="leave_date" required name="relive_date" min="<?php echo date("Y-m-d");?>"/>
                </div>
                <div class="label col-lg-2 col-md-6 col-sm-6">
                    <label for="join_date">JOINING-DATE: </label>
                </div>
                <div class="input col-lg-4 col-md-6 col-sm-6">
                    <input type="date" id="joining_date" required name="join_date" min="<?php echo date("Y-m-d");?>"/>
                </div>
                <button type="submit" name="submit_transfer" class="btn btn-outline-success" onclick="archiveFunction()">SUBMIT</button>
            </form> 
        <center>
        </div>
        </div>
    </div>    
    <script>
        var element = document.getElementById("transfering");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/sweetalert.min.js"></script>
</body>
</html>

<script>
    function archiveFunction() {
    event.preventDefault(); // prevent form submit
    var form = event.target.form; // storing the form
        swal({
            title: "Are you sure?",
            text: "The changes made cannot be revoked!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(
        function(isConfirm){
            if (isConfirm) {
                form.submit();          // submitting the form when user press yes
            } else {
                swal("Cancelled", "No Changes Made", "error");
            }
        });
    }
</script>

<?php

//Function to add an entry to designation table when submit clicked at transfer page
if(isset($_POST['court_to'])){
    $conn = connectDB();
    if($_POST['join_date'] >= $_POST['relive_date']){
        $employeeID = $_POST['employeeID'];
        $court_to = mysqli_real_escape_string($conn,$_POST['court_to']);
        $court_from = mysqli_real_escape_string($conn,$_POST['court_from']);
        $query = "SELECT * from designation where employeeID = {$employeeID} and to_date is null and from_date is not null and courtID='{$court_from}'";
        if(mysqli_num_rows(mysqli_query($conn,$query)) == 1){
            if(strcmp($court_to,$court_from) != 0){
                $query1 = "SELECT * from designation where employeeID = {$employeeID} and to_date is null and from_date is not null";
                if($result = mysqli_query($conn,$query1)){
                    if(mysqli_num_rows($result) == 1 ){
                            $row = mysqli_fetch_row($result);
                            $from_court = $row[2];
                            $from_post = $row[1];
                            $_SESSION['from_court'] = $court_from;
                            $_SESSION['court_to'] = $court_to;
                            $relive_date = $_POST['relive_date'];
                            $join_date = $_POST['join_date'];
                            $_SESSION['from_post'] = $from_post;
                            $_SESSION['post_to'] = $from_post;
                            $relive_date = strtotime(str_replace('.','-',$relive_date));
                            $relive_date = date("Y-m-d",$relive_date);
                            $join_date = strtotime(str_replace('.','-', $join_date));
                            $join_date = date("Y-m-d",$join_date);
                            $_SESSION['relive_date'] = $relive_date;
                            $_SESSION['join_date'] = $join_date;
                            $query1 = "UPDATE designation SET to_date = '{$relive_date}' where employeeID = {$employeeID} and to_date is null and from_date is not null";
                            $query2 = "INSERT INTO designation (employeeID,courtID,postingsID,from_date) VALUES({$employeeID},'{$court_to}','{$from_post}','{$join_date}')";
                            $query3 = "SELECT CONCAT(first_name,' ',last_name)as employee_name FROM employee WHERE employeeID = {$employeeID}";
                            $result2 = mysqli_query($conn,$query3);
                            $row = mysqli_fetch_row($result2);
                            $employeeName = $row[0];
                            $_SESSION['post_transfer_employeeName'] = $employeeName;
                            mysqli_query($conn, $query1);
                            $query_run = mysqli_query($conn,$query2);
                            if($query_run){?>
                            <script>window.location.href = "pdf_generation.php";</script>
                            <?php
                            }
                    }
                    else if(mysqli_num_rows($result) > 1){
                        $_SESSION['status'] = "Transfer order already exist";
                        $_SESSION['status_code'] = "info";
                    }
                }
            }
            else{
                $_SESSION['status'] = "Employee works in the same court to be transfered";
                $_SESSION['status_code'] = "warning";
            }
        }
        else{
            $_SESSION['status'] = "Employee does not work in the selected court";
            $_SESSION['status_code'] = "warning";
        }
    }
    else{
        $_SESSION['status'] = "Joining date must be after or at the relieve date";
        $_SESSION['status_code'] = "warning";
    }
}

include_once "actions.php";
?>