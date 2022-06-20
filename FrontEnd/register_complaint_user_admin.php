<!DOCTYPE html>
<?php
    include_once "navigation.php";
    include_once "actions.php";
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
    <link rel="stylesheet" type="text/css" href="css/comp_gre.css">
</head>
<body>
    <?php include_once "navbars_user_admin.php"; ?>

        <div id="content">
            <div id="co-gr">
                <form action="" method="POST" enctype="multipart/form-data">
                    <h2>File A Complaint/Greviance</h2>
                    <div class="align">
                        <div class="label col-lg-5 col-md-5 col-sm-5">
                            <label for="subject"> Category : </label>
                        </div>
                        <div class="input col-lg-7 col-md-7 col-sm-7">
                            <input type="text" id="subject" name="category" required />
                        </div>
                    </div>
                    <div class="align">
                        <div class="label col-lg-5 col-md-5 col-sm-5">
                            <label for="co_gr_desc"> Description (max 2000 words) : </label>
                        </div>
                        <div class="input col-lg-7 col-md-7 col-sm-7">
                            <textarea id="co_gr_desc" name="complaint_details" rows="10" cols="55" required maxlength="2000"></textarea>
                        </div>
                    </div>
                    <div class="align">
                        <div class="form-group label col-lg-5 col-md-5 col-sm-5">
                            <label class="control-label" for="complaint_file">Complaint Related Doc (IF ANY) </label>
                        </div>    
                        <div class="input col-lg-7 col-md-7 col-sm-7">
                            <input type="file" name="complaint_file" id="complaint_file" class="form-control">
                        </div>
                    </div>
                    <center><button type="submit" id="co-gr-btn" name="submit_complaint" class="btn btn-outline-success">SUBMIT</button></center>
                </form>
            </div>
        </div>
    
    </div>

    <script>
        var element = document.getElementById("complaints_greviance");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
        var element1 = document.getElementById("file_complaint");
        element1.classList.remove("btn-outline-secondary");
        element1.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js" ></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php 
    if(isset($_POST['submit_complaint'])){
        $conn = connectDB();
        $employeeID = $_SESSION['employeeID'];
        $category = mysqli_real_escape_string($conn,$_POST['category']);
        $complaintDetails = mysqli_real_escape_string($conn,$_POST['complaint_details']);
        $query = "SELECT * from complaints order by complaintNumber DESC limit 1";
        $row = mysqli_fetch_array(mysqli_query($conn,$query));
        $complaintNumber = $row['complaintNumber'] + 1;
        if($_FILES['complaint_file']['size'] == 0){
            $query = "INSERT into complaints(employeeID,category,complaintDetails,`status`) values('{$employeeID}','{$category}','{$complaintDetails}','not processed')";
        }
        else{
            $compfile=$_FILES["complaint_file"]["name"];
            $compfile=$complaintNumber."_".$compfile;
            move_uploaded_file($_FILES["complaint_file"]["tmp_name"],"complaintdocs/".$compfile);
            $query = "INSERT into complaints(employeeID,category,complaintDetails,complaintFile,`status`) values('{$employeeID}','{$category}','{$complaintDetails}','{$compfile}','not processed')";
        }
        mysqli_query($conn,$query);
        $sql=mysqli_query($conn,"SELECT complaintNumber from complaints  order by complaintNumber desc limit 1");
        while($row=mysqli_fetch_array($sql)){
            $cmpn=$row['complaintNumber'];
        }
        $complainno = $cmpn;
        $_SESSION['status'] = "This is your complaint number : ".$complainno;
        $_SESSION['status_code'] = "success";
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