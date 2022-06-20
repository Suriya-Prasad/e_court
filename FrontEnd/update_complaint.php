<!DOCTYPE html>
<?php
    session_start();
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
            <div id="co-gr">
                <form action="" method="POST">
                <div class="align">
                    <div class="label col-lg-5 col-md-5 col-sm-5">
                        <label for="comp_status"> Category : </label>
                    </div>
                    <div class="input col-lg-7 col-md-7 col-sm-7">
                        <select id="comp_status" name ="status" required class="form-select">
                            <option selected>Select Status</option>
                            <option value="in process">In Process</option>
                            <option value="not processed">Not Processed</option>
                            <option value="closed">Closed</option>
                        </select>
                    </div>
                </div>
                <div class="align">
                    <div class="label col-lg-5 col-md-5 col-sm-5">
                        <label for="co_up_remark"> Remark : </label>
                    </div>
                    <div class="input col-lg-7 col-md-7 col-sm-7">
                        <textarea id="co_up_remark" name="remark" rows="10" cols="55" required></textarea>
                    </div>
                </div>
                <button type="submit" class="ser_btn btn btn-outline-success" name="submit_update_complaint">SUBMIT</button>
                <br><br>
                <button type="button" class="ser_btn btn btn-outline-danger" onclick="window.close()">BACK TO MAIN window</button>
                </form>
            </div>
        </div>
    
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js" ></script>
    <script src="js/main.js"></script>
</body>
</html>


<?php

if(isset($_post['submit_update_complaint'])){
    $conn = connectDB();
    $complaintNumber=$_GET['cid'];
    $status = $_POST['status'];
    $remark = mysqli_real_escape_string($conn,$_POST['remark']);
    $query = "INSERT into complaint_remark(complaintNumber,`status`,remark) values('$complaintNumber','$status','$remark')";
    mysqli_query($conn,$query);
    $query = "UPDATE complaints set `status`='$status' where complaintNumber='$complaintNumber'";
    mysqli_query($conn,$query);
    $_SESSION['status'] = "Updated Successfully";
    $_SESSION['status_code'] = "success";
}

?>