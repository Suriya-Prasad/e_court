<!DOCTYPE html>
<?php
    session_start();
    include_once "db_connection.php";
    if(strcmp($_SESSION['employee_role'],"super admin")!=0){
        header("Location:home_attendance.php");
    }
?>
<html lang="en">
<head></head>
<body>
    
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
    $query = "UPDATE complaints set `status`='$status' where complaintNumber='$complaintnumber'";
    mysqli_query($conn,$query);
    $_SESSION['status'] = "Updated Successfully";
    $_SESSION['status_code'] = "success";
}

?>