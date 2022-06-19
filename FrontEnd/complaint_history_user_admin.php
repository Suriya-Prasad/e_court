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
            document.getElementById('post_table').innerHTML="<?php GetResults()?>";    
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
    if(isset($_POST['view_complaint_details'])){
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
    $row_count = 1;
    echo "<table class='table table-bordered'>";
    echo "<tr>";
    echo "<th>COMPLAINT NUMBER</th>";
    echo "<th>REG. DATE</th>";
    echo "<th>LAST UPDATION DATE</th>";
    echo "<th>STATUS</th>";
    echo "<th>ACTION</th>";
    echo "</tr>";
    while($row=mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td>".$row['complaintNumber']."</td>";
    echo "<td>".$row['regDate']."</td>";
    echo "<td>".$row['lastUpdationDate']."</td>";
    echo "<td>".$row['status']."</td>";
    echo "<td><input type='hidden' id='complaintNumber' name='complaintNumber' value='".$row['complaintNumber']."'><button type='submit' id='acc' class='btn btn-outline-success' name='view_complaint_details'> View Details</button></td>";
    echo "</tr>";
    $row_count++;
    }
    echo "</table>";
}

function ComplaintDetailsTable($result){
    $row=mysqli_fetch_array($result);
    echo "<h4>Complaint Details</h4><br>";
    echo "<table class='table table-bordered'>";
    echo "<tr>";
    echo "<th>Complaint Number</th>";
    echo "<td>".$row['complaintNumber']."</td>";
    echo "<th>Complaint Name</th>";
    echo "<td>".$row['employee_name']."</td>";
    echo "<th>Reg Date</th>";
    echo "<td>".$row['regDate']."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Complaint Details</th>";
    echo "<td colspan='5'>".$row['complaintDetails']."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>File (if-any)</th>";
    if(is_null($row['complaintFile'])){
        echo "<td colspan='5'>No files attached</td>";
    }
    else{
        echo "<td colspan='5'><a href='complaintdocs/".$row['complaintFile']." target='_blank'/> View File</a></td>";
    }
    echo "</tr>";
    echo "<tr>";
    echo "<th>Status</th>";
    echo "<td colspan='5'>".$row['status']."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Last Updated</th>";
    echo "<td colspan='5'>".$row['lastUpdationDate']."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Action</th>";
    echo "<td>None</td>";
    echo "</tr>";
    echo "</table>";
}
?>