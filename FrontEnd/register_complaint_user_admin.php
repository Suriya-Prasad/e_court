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
    <link rel="stylesheet" type="text/css" href="css/comp_gre.css">
</head>
<body>
    <?php 
        if($_SESSION['employeeID'] == 1){
            include_once "navbars_superadmin.php"; 
        }
        else{
            include_once "navbars_user_admin.php";
        }
    ?>

        <div id="content">
            <div id="co-gr">
                <form>
                    <h2>Create a Complaint/Greviance</h2>
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
<!-- <div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Complaint Related Doc(if any) </label>
<div class="col-sm-6">
<input type="file" name="complaint_file" class="form-control" value="">
</div> -->
                    <button type="submit" id="co-gr-btn" name="submit_complaint" class="btn btn-outline-success">SUBMIT</button>
                </form>
            </div>
        </div>
    
    </div>

    <script>
        var element = document.getElementById("complaints_greviance");
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
    if(isset($_POST['complaint_submit'])){
        $conn = connectDB();
        $employeeID = $_SESSION['employeeID'];
        $category = $_POST['category'];
        $complaintDetails = $_POST['complaint_details'];
        $compfile=$_FILES["complaint_file"]["name"];
        move_uploaded_file($_FILES["complaint_file"]["tmp_name"],"complaintdocs/".$_FILES["complaint_file"]["name"]);
        $query = "INSERT into complaints(employeeID,category,complaintDetails,complaintFile) values('$employeeID','$category','$complaintDetials','$compfile')";
        mysqli_query($conn,$query);
        $sql=mysqli_query($conn,"SELECT complaintNumber from complaints  order by complaintNumber desc limit 1");
        while($row=mysqli_fetch_array($sql)){
            $cmpn=$row['complaintNumber'];
        }
        $complainno = $cmpn;
        echo '<script> alert("Your complain has been successfully filled and your complaintno is  "+"'.$complainno.'")</script>';
    }

?>