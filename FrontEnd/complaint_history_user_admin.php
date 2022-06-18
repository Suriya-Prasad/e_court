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
    <script>
        function fillResults(){
            document.getElementById('content').style.display = 'block';
            document.getElementById('post_table').innerHTML="<?php echo GetResults()?>";    
        }
    </script>
</head>
<body>
    <?php include_once "navbars_user_admin.php";?>

        <div id="content">
            <div id="co-gr">
                <form action="" method="POST">
                <h2>YOUR COMPLAINTS</h2>
                <div id="post_table"><script>fillResults();</script></div>
                </form>
            </div>
        </div>
        
    </div>
    <script>
        var element = document.getElementById("complaints_greviance");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
        var element1 = document.getElementById("complaint_history");
        element1.classList.remove("btn-outline-secondary");
        element1.classList.add("btn-secondary");
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php

function GetResults(){
    if(isset($_POST['complaintNumber'])){
        return GetComplaintDetails();
    }
    else{
        return GetMyComplaints();
    }
}

function GetComplaintDetails(){
    $conn = connectDB();
    $employeeID = $_SESSION['employeeID'];
    $complaintNumber = $_POST['complaintNumber'];
    $query = "SELECT c.* from complaints as c c.employeeID='$employeeID' where c.complaintNumber='".$complaintNumber."'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 0){
        echo "<h3>No Record Found On Complaint Number ".$complaintNumber."</h3>";
        return " ";
    }
    else{
        return ComplaintDetailsTable($result);
    }
}

function GetMyComplaints(){
    $conn = connectDB();
    $employeeID = $_SESSION['employeeID'];
    $query = "SELECT c.complaintNumber,c.status,c.regDate,c.lastUpdationDate from complaints as c where c.employeeID='$employeeID' order by regDate DESC";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 0){
        echo "<h3>No Record Found</h3>";
        return " ";
    }
    else{
        return MyComplaintsTable($result);
    }
}

function MyComplaintsTable($result){
    $row=mysqli_fetch_array($result);
    echo "<table class='table table-bordered'>";
    echo "<tr>";
    echo "<th>COMPLAINT NUMBER</th>";
    echo "<th>REG. DATE</th>";
    echo "<th>LAST WPDATION DATE</th>";
    echo "<th>STATUS</th>";
    echo "<th>ACTION</th>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>".$row['complaintNumber']."</td>";
    echo "<td>".$row['regDate']."</td>";
    echo "<td>".$row['lastUpdationDate']."</td>";
    echo "<td>".$row['status']."</td>";
    echo "<td><button type='submit' id='acc' class='btn btn-outline-success' name='complaintNumber' value=".htmlentities($row['complaintNumber'])."> View Details</button></td>";
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
    echo "<td>Status</td>";
    echo "<td colspan='5'>".$row['status']."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Last Updated</td>";
    echo "<td colspan='5'>".$row['lastUpdationDate']."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Action</td>";
    echo "<td>None</td>";
    echo "</tr>";
    echo "</table>";
}
?>