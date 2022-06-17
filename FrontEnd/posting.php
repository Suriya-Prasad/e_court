<!DOCTYPE html>
<?php
    include_once "navigation.php";
    include_once "db_connection.php";
    if(strcmp($_SESSION['employee_role'],"super admin")!=0){
        header("Location:home_attendance.php");
    }
    $conn = connectDB(); 
    $query1 = "SELECT * FROM postings";
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
        <?php include_once "navbars_superadmin.php"; ?>
        <div id="content">
            <div id="posting">
            <center>
                <form action="" method="POST">
                    <h2>POSTING</h2>
                    <label for="employeeID">EMPLOYEE ID: </label>
                    <input type="text" id="employeeID" name="employeeID">
                    <p>TO COURT  :
                    <select id="post-to" name="court_to" class="form-select">
                        <option selected>&lt;--None--&gt;</option>
                        <?php
                        $result = mysqli_query($conn, $query2);
                        while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=".$row['courtID'].">".$row['courtName']." , ".$row['courtPlace']."</option>";
                        }
                        ?>
                    </select></p>
                    <p>TO POSTING   :
                    <select id="post-to" name="post_to" class="form-select">
                        <option selected>&lt;--None--&gt;</option>
                        <?php
                        $result = mysqli_query($conn, $query1);
                        while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=".$row['postingsID'].">".$row['postingsName']."</option>";
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
                    <button name="submit_posting" class="submit_ajax btn btn-outline-success" onclick="archiveFunction()">SUBMIT</button>
                </form>
            <center>
            </div>
        </div>                
    </div>
    <script>
        var element = document.getElementById("posti");
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

//Function to add an entry to designation table when submit clicked at posting page
    if(isset($_POST['post_to'])){
        $conn = connectDB();
        if($_POST['join_date'] >= $_POST['relive_date']){
            $employeeID = mysqli_real_escape_string($conn,$_POST['employeeID']);
            $court_to = mysqli_real_escape_string($conn,$_POST['court_to']);
            $post_to = mysqli_real_escape_string($conn,$_POST['post_to']);
            $query1 = "SELECT * from designation where employeeID = '{$employeeID}' and to_date is null and from_date is not null";
            if($result = mysqli_query($conn,$query1)){
                if(mysqli_num_rows($result) == 1 ){
                    $row = mysqli_fetch_row($result);
                    $from_court = $row[2];
                    $from_post = $row[1];
                    if(strcmp($post_to,$from_post) != 0){
                        $_SESSION['court_to'] = $court_to; 
                        $_SESSION['post_to'] = $post_to;
                        $relive_date = $_POST['relive_date'];
                        $join_date = $_POST['join_date'];
                        $_SESSION['from_court'] = $from_court;
                        $_SESSION['from_post'] = $from_post;
                        $relive_date = strtotime(str_replace('.','-',$relive_date));
                        $relive_date = date("Y-m-d",$relive_date);
                        $join_date = strtotime(str_replace('.','-', $join_date));
                        $join_date = date("Y-m-d",$join_date);
                        $_SESSION['relive_date'] = $relive_date;
                        $_SESSION['join_date'] = $join_date;
                        $query1 = "UPDATE designation SET to_date = '{$relive_date}' where employeeID = {$employeeID} and to_date is null and from_date is not null";
                        $query2 = "INSERT INTO designation(`employeeID`,`courtID`,`postingsID`,`from_date`) VALUES({$employeeID},'{$court_to}','{$post_to}','{$join_date}')";
                        mysqli_query($conn, $query1);
                        $query_run = mysqli_query($conn,$query2);
                        $query3 = "SELECT CONCAT(first_name,' ',last_name)as employee_name FROM employee WHERE employeeID = {$employeeID}";
                        $result2 = mysqli_query($conn,$query3);
                        $row = mysqli_fetch_row($result2);
                        $employeeName = $row[0];
                        $_SESSION['post_transfer_employeeName'] = $employeeName;
                        if($query_run){?>
                            <script>window.location.href = "pdf_generation.php";</script>
                        <?php
                        }
                    }
                    else{
                        $_SESSION['status'] = "Employee works in the same post to be transfered";
                        $_SESSION['status_code'] = "warning";
                    }
                }
                else if(mysqli_num_rows($result) > 1){
                        $_SESSION['status'] = "Posting order already exist";
                        $_SESSION['status_code'] = "info";
                }
                else{
                        $_SESSION['status'] = "Employee does not exist";
                        $_SESSION['status_code'] = "warning";
                }
            }
        }
        else{
            $_SESSION['status'] = "Joining date must be after or at the relieve date";
            $_SESSION['status_code'] = "warning";
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