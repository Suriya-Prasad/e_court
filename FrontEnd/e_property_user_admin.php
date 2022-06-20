<!DOCTYPE html>
<?php

use LDAP\Result;

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
                <h2>PROPERTY</h2>
                <div class="align">
                    <div class="label col-lg-5 col-md-5 col-sm-5">
                        <label for="property_details"> Description : </label>
                    </div>
                    <div class="input col-lg-7 col-md-7 col-sm-7">
                        <textarea id="property_details" name="property_details" rows="5" cols="55" required></textarea>
                    </div>
                </div>
                <div class="align">
                    <div class="form-group label col-lg-5 col-md-5 col-sm-5">
                        <label class="control-label" for="property_file"> File Upload : </label>
                    </div>    
                    <div class="input col-lg-7 col-md-7 col-sm-7">
                        <input type="file" name="property_file" id="property_file" class="form-control" required>
                    </div>
                </div>
                <center><button type="submit" id="prop_up_btn" name="property_upload" class="btn btn-outline-success">UPLOAD</button></center>
                </form>
            </div>
        </div>
    </div>

    <script>
        var element1 = document.getElementById("property");
        element1.classList.remove("btn-outline-secondary");
        element1.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/sweetalert.min.js"></script>
</body>
</html>

<?php
        if(isset($_POST['property_upload'])){
            $conn = connectDB();
            $employeeID = $_SESSION['employeeID'];
            $propertyDetails = mysqli_real_escape_string($conn,$_POST['property_details']);
            if($_FILES['property_file']['size'] != 0){
            $propertyfile=$_FILES["property_file"]["name"];
            $query = "INSERT into e_property(employeeID,e_property_statementDetails,e_property_statementFile) values('$employeeID','$propertyDetails','$propertyfile')";
                if($result = mysqli_query($conn,$query)){
                    move_uploaded_file($_FILES["property_file"]["tmp_name"],"e_propertydocs/".$_FILES["property_file"]["name"]);
                    $_SESSION['status'] = "Document updated successfully";
                    $_SESSION['status_code'] = "success";
                }
                else{
                    // $_SESSION['status'] = "Something went wrong";
                    // $_SESSION['status_code'] = "warning";
                    echo mysqli_error($conn);
                }
            }
            else{
                $_SESSION['status'] = "You must upload a document";
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