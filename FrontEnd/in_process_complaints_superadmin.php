<!DOCTYPE html>
<?php
    include_once "navigation.php";
    include_once "actions.php";
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
    </script>
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
                <form action="" method="POST">
                <h2>IN PROCESS COMPLAINTS</h2>
                <div id="post_table"><script>fillResults();</script></div>
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

function GetResults(){
    if(isset($_POST['complaintNumber'])){
        return GetComplaintDetails();
    }
    else{
        return GetInProcessComplaints();
    }
}

function GetComplaintDetails(){
    $conn = connectDB();
    $complaintNumber = $_POST['complaintNumber'];
    $query = "SELECT c.*,CONCAT(e.first_name,' ',e.last_name)as employee_name from complaints as c join employee as e on e.employeeID=c.employeeID where c.complaintNumber='".$complaintNumber."'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 0){
        echo "<h3>No Record Found On Complaint Number ".$complaintNumber."</h3>";
        return " ";
    }
    else{
        return ComplaintDetailsTable($result);
    }
}

function GetInProcessComplaints(){
    $conn = connectDB();
    $query = "SELECT c.complaintNumber,c.status,c.regDate,CONCAT(e.first_name,' ',e.last_name)as employee_name from complaints as c join employee as e on e.employeeID=c.employeeID where c.status='in process' order by regDate DESC";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 0){
        echo "<h3>No Records Found</h3>";
        return " ";
    }
    else{
        return InProcessComplaintsTable($result);
    }
}

function InprocessComplaintsTable($result){
    $row=mysqli_fetch_array($result);
    echo "<table class='table table-info table-hover'>";
    echo "<tr>";
    echo "<th>COMPLAINT NUMBER</th>";
    echo "<th>PERSON NAME</th>";
    echo "<th>REG. DATE</th>";
    echo "<th>STATUS</th>";
    echo "<th>ACTION</th>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . $row['complaintNumber'] . "</td>";
    echo "<td>" . $row['employee_name']. "</td>";
    echo "<td>" .  $row['regDate'] . "</td>";
    echo "<td>in process</td>";
    echo "<td><button type='submit' id='acc' class='btn btn-outline-success' name='view_complaint_details' value=".htmlentities($row['complaintNumber'])."> View Details</button></td>";
    echo "</tr>";
    echo "</table>";
}

function ComplaintDetailsTable($result){
    $row=mysqli_fetch_array($result);
    echo "<h4>Complaint Details</h4>";
    echo "<table class='table table-bordered'>";
    echo "<tr>";
    echo "<td>Complaint Number</td>";
    echo "<td>".$row['complaintNumber']."</td>";
    echo "<td>Complaint Name</td>";
    echo "<td>".$row['employee_name']."</td>";
    echo "<td>Reg Date</td>";
    echo "<td>".$row['regDate']."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Complaint Details</td>";
    echo "<td colspan='5'>".$row['complaintDetails']."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>File (if-any)</td>";
    echo "<td colspan='5'>".$row['complaintFiles']."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Final Status</td>";
    echo "<td colspan='5'>in process</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Action</td>";
    echo "<td><button>Take Action</button></td>";
    // echo "<td colspan='4'><button>View User Details</button></td>";
    echo "</tr>";
    echo "</table>";
}
?>