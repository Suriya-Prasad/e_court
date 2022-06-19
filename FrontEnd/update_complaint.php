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
    <script>
        function fillResults(){
            document.getElementById('post_table').style.display = 'block';
            document.getElementById('post_table').innerHTML="<?php GetResults()?>";   
        }
        function basicPopup(url) {
            popupWindow = window.open(url,'popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
        }
    </script>
</head>
<body>
    <?php include_once "navbars_superadmin.php"; ?>

        <div id="content">
            <div id="co-gr">
                
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
    $query = "UPDATE complaints set `status`='$status' where complaintNumber='$complaintnumber'";
    mysqli_query($conn,$query);
    $_SESSION['status'] = "Updated Successfully";
    $_SESSION['status_code'] = "success";
}

?>