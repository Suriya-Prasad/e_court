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
    <script>
    function fillResults(){
        document.getElementById('post_table').style.display = 'block';
        document.getElementById('post_table').innerHTML="<?php GetClosedComplaints()?>";   
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
                <form>
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
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js" ></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php

function GetClosedComplaints(){
    $conn = connectDB();
    $query = "SELECT c.complaintNumber,c.status,c.regDate,CONCAT(e.first_name,' ',e.last_name)as employee_name from complaints as c join employee as e on e.employeeid=c.employeeId where c.status='closed'";
    
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 0){
        echo "<h3>No Records Found</h3>";
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
    echo "<td><a href='complaint-details.php?cid=".htmlentities($row['complaintNumber'])."> View Details</a></td>";
    echo "</tr>";
    echo "</table>";
}
?>