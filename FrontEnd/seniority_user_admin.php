<!DOCTYPE html>
<?php
    include_once "navigation.php";
    include_once "actions.php";
    $conn = connectDB(); 
    $query1 = "SELECT * FROM postings";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/seniority.css">
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
            <div id="seniority">
                <center>
                    <h2>SENIORITY</h2>
                    <form action="" method="POST">
                    <p>POST :
                    <select id="post" class="form-select" name = "SeniorityForm" onchange="this.form.submit()">
                        <option selected>&lt;--None--&gt;</option>
                        <?php
                        $result = mysqli_query($conn, $query1);
                        while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=".$row['postingsID'].">".$row['postingsName']."</option>";
                        }
                        ?>
                    </select></p>
                    </form>
                </center>
                <div id="post_table"></div>
            </div>
        </div>
    </div>

    <script>
        var element = document.getElementById("senior");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script>
        document.getElementById('post_table').style.display = 'block';
        document.getElementById('post_table').innerHTML="<?php GetSeniority()?>";
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js" ></script>
    <script src="js/main.js"></script>
</body>
</html>


<?php

//Function to handle the seniorirty page
    
function GetSeniority(){
    $conn = connectDB();
    if(!isset($_POST["SeniorityForm"])){
        return " ";
    }
    $posting = mysqli_real_escape_string($conn,$_POST["SeniorityForm"]);
    $query = "SELECT d.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,MIN(d.from_date) as join_date from employee as e, designation as d WHERE d.employeeID IN(select employeeID from designation where postingsID = '{$posting}' and to_date is null AND from_date is not null) AND postingsID = '{$posting}'  AND e.employeeID = d.employeeID  AND e.employeeID NOT IN(SELECT employeeID from disciplinary_proceeding where end_date is null) GROUP BY employeeID ORDER BY join_date;";
    $query1 = "SELECT postingsName FROM postings where postingsID = $posting";
    if($result = mysqli_query( $conn, $query)){
        $result1 = mysqli_query($conn,$query1);
        $row = mysqli_fetch_array($result1);
        $posting = $row['postingsName'];
        $returnVal = seniorityTable($result,$posting);
        mysqli_close($conn);
        return $returnVal;
    }
    else{
        printf("Error: %s\n", mysqli_error($conn));
    }
}

//Function to display the seriority of a posting
function seniorityTable($result,$posting){
    if(mysqli_num_rows($result)==0){
        echo "<h2>".strtoupper($posting)."</h2><br>";
        echo "<center><h3>No Active Employee or Employee Undergoing Disciplinary Proceedings</h3></center>";
        return "";
    }
    echo "<h2>".strtoupper($posting)."</h2><br>";
    $row_count = 1;
    echo "<table class='table table-info table-hover'>";
    echo "<tr>";
    echo "<th>Employee ID</th>";
    echo "<th>Employee Name</th>";
    echo "<th>Posting joined date</th>";
    echo "</tr>";
    while ($row=mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['employeeID'] . "</td>";
    echo "<td>" . $row['employee_name'] . "</td>";
    echo "<td>" . $row['join_date'] . "</td>";
    echo "</tr>"; 
    $row_count++;     
    }
    echo "</table>";
}

?>