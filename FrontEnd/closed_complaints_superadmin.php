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
        document.getElementById('post_table').innerHTML="<?php echo GetResults()?>";   
    }
    </script>
</head>
<body>
    <?php  include_once "navbars_superadmin.php"; ?>

        <div id="content">
            <div id="co-gr">
                <form action="" method="POST">
                <h2>CLOSED COMPLAINTS</h2>
                <div id="post_table"><script>fillResults();</script></div>
                </form>
            </div>
        </div>
    
    </div>

    <script>
        var element = document.getElementById("complaints_greviance");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
        var element1 = document.getElementById("closed");
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

function GetResults(){
    if(isset($_POST['view_complaint_details'])){
        return GetComplaintDetails();
    }
    else{
        return GetClosedComplaints();
    }
}

function GetComplaintDetails(){
    $conn = connectDB();
    $complaintNumber = $_POST['view_complaint_details'];
    $query = "SELECT c.*,CONCAT(e.first_name,' ',e.last_name)as employee_name from complaints as c join employee as e on e.employeeID=c.employeeID where c.complaintNumber='".$complaintNumber."'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 0){
        echo "<h3>No Record Found On Complaint Number ".$complaintNumber."</h3>";
        return " ";
    }
    else{
        $query = "SELECT cr.remark as remark,cr.status as sstatus,cr.remarkDate as rdate from complaint_remark as cr join complaints as c on c.complaintNumber=cr.complaintNumber where cr.complaintNumber='".$complaintNumber."'";
        $result1 = mysqli_query($conn,$query);
        return ComplaintDetailsTable($result,$result1);
    }
}

function GetClosedComplaints(){
    $conn = connectDB();
    $query = "SELECT c.complaintNumber,c.status,c.regDate,CONCAT(e.first_name,' ',e.last_name)as employee_name from complaints as c join employee as e on e.employeeID=c.employeeID where c.status='closed' order by regDate DESC";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 0){
        echo "<h3>No Record Found</h3>";
        return " ";
    }
    else{
        return ClosedComplaintsTable($result);
    }
}

function ClosedComplaintsTable($result){
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
    echo "<td>closed</td>";
    echo "<td><button type='submit' id='acc' class='btn btn-outline-success' value='".$row['complaintNumber']."' name='view_complaint_details'> View Details</button></td>";
    echo "</tr>";
    echo "</table>";
}

function ComplaintDetailsTable($result,$result1){
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
        echo "<td colspan='5'><a href='../user_admin/complaintdocs/".$row['complaintFile']."' target='_blank'/> View File</a></td>";
    }
    echo "</tr>";
    if(mysqli_num_rows($result1)==0){
        echo "<tr>";
        echo "<th>Remarks</th>";
        echo "<td colspan='5'>No remarks yet</td>";
        echo "</tr>";
    }
    else{
        $row1=mysqli_fetch_array($result1);
        echo "<tr>";
        echo "<th>Remarks</th>";
        echo "<td colspan='3'>".$row1['remark']."</td>";
        echo "<th>Remark Date</th>";
        echo "<td colspan='3'>".$row1['remarkDate']."</td>";
        echo "</tr>";
    }
    echo "<tr>";
    echo "<th>Status</th>";
    echo "<td colspan='5'>closed</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Last Updated</th>";
    echo "<td colspan='5'>".$row['lastUpdationDate']."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>Action</th>";
    echo "<td colspan='5'><button type='submit' name='view_all'>&lt; &lt; VIEW ALL</button></td>";
    echo "</tr>";
    echo "</table>";
}
?>