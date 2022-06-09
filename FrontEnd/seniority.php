<?php
    include_once "navigation.php";
    include_once "actions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/seniority.css">
    <script>
    function fillResults(){
        document.getElementById('post_table').style.display = 'block';
        document.getElementById('post_table').innerHTML="<?php GetSeniority()?>";   
    }
    </script>
</head>
<body>
    <?php include_once "navbars.php"; ?>

        <div id="content">
        <div id="seniority">
            <center>
                <h2>SENIORITY</h2>
                <form action="" method="POST">
                <p>POST :
                <select id="post" class="form-select" name = "SeniorityForm" onchange="this.form.submit()">
                    <option selected>&lt;--None--&gt;</option>
                    <option value="post 1">Post One</option>
                    <option value="post 2">Post Two</option>
                    <option value="post 3">Post Three</option>
                </select></p>
                </form>
            </center>
            <div id="post_table">
                <script>fillResults();</script>
            </div>
        </div>
        </div>
    </div>

    <script>
        var element = document.getElementById("seniorityb");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
        var element2 = document.getElementById("staff_info");
        element2.classList.remove("btn-outline-secondary");
        element2.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<script src="js/sweetalert.min.js" ></script>

<?php

include_once "db_connection.php";

//Function to handle the seniorirty page
    
function GetSeniority(){
    $conn = connectDB();
    $posting = mysqli_real_escape_string($conn,$_POST["SeniorityForm"]);
    $query = "SELECT d.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,MIN(d.from_date) as join_date from employee as e, designation as d WHERE d.employeeID IN(select employeeID from designation where posting ='{$posting}' and to_date is null AND from_date is not null) AND posting = '{$posting}'  AND e.employeeID = d.employeeID GROUP BY employeeID ORDER BY join_date;";
    if($result = mysqli_query( $conn, $query)){
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
        return "<script>swal({title:'No employee exist in this post',icon:'info'});</script>";
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