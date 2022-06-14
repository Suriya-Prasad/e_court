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
    <link rel="stylesheet" type="text/css" href="css/posting.css">
</head>
<body>
        <?php include_once "navbars_superadmin.php"; ?>
        <div id="content">
            <div id="posting">
            <center>
                <form action="" method="POST">
                    <h2>QUERY BUILDER</h2>
                    <p>GENDER :
                        <input type="radio" id="gender3" name="gender" value="all"/>
                        <label for="gender3">ALL</label>
                        <input type="radio" id="gender1" required name="gender" value="male"/>
                        <label for="gender1">MALE</label>
                        <input type="radio" id="gender2" name="gender" value="female"/>
                        <label for="gender2">FEMALE</label>
                        <input type="radio" id="gender3" name="gender" value="other"/>
                        <label for="gender3">OTHER</label>
                    </p>
                    <p>COURT  :
                    <select id="post-to" name="court" class="form-select">
                        <option selected value="all">All</option>
                        <option value="court one">Court One</option>
                        <option value="court two">Court Two</option>
                        <option value="court three">Court Three</option>
                    </select></p>
                    <p>POST  :
                    <select id="post-to" name="post" class="form-select">
                        <option selected value="all">All</option>
                        <option value="post 1">Post One</option>
                        <option value="post 2">Post Two</option>
                        <option value="post 3">Post Three</option>
                    </select></p>
                    <button type="submit" name = "submit_query_builder" class="btn btn-outline-success">SUBMIT</button>
                </form>
            <center>
            <div id="post_table"></div>
            </div>
        </div>                
    </div>
    <script>
        var element = document.getElementById("query_builder");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script>
        document.getElementById('post_table').style.display = 'block';
        document.getElementById('post_table').innerHTML="<?php echo GetQueryResults();?>";   
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/sweetalert.min.js" ></script>
</body>
</html>

<?php include_once "db_connection.php"; ?>
<?php 

    //Function to build report for required query
    function GetQueryResults(){
        $conn = connectDB();
        if(!isset($_POST['submit_query_builder'])){
            return " ";
        }
        $post = $_POST['post'];
        $court = $_POST['court'];
        $gender = $_POST['gender'];
        if(strcmp($court,"all") == 0){
            if(strcmp($post,"all") == 0){
                if(strcmp($gender,"all") == 0){
                    $query = "SELECT e.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,e.gender,e.phone_number,e.e_mail,d.posting,d.court FROM employee as e,designation as d WHERE e.employeeID=d.employeeID and d.to_date is null ORDER BY d.court,d.posting,e.gender;";
                }
                else{
                    $query = "SELECT e.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,e.gender,e.phone_number,e.e_mail,d.posting,d.court FROM employee as e,designation as d WHERE (e.employeeID=d.employeeID and d.to_date is null) and e.gender='{$gender}' ORDER BY d.court,d.posting,e.gender;";
                }
            }
            else{
                if(strcmp($gender,"all") == 0){
                    $query = "SELECT e.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,e.gender,e.phone_number,e.e_mail,d.posting,d.court FROM employee as e,designation as d WHERE e.employeeID=d.employeeID and d.to_date is null and d.posting='{$post}' ORDER BY d.court,d.posting,e.gender;";
                }
                else{
                    $query = "SELECT e.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,e.gender,e.phone_number,e.e_mail,d.posting,d.court FROM employee as e,designation as d WHERE (e.employeeID=d.employeeID and d.to_date is null) and e.gender='{$gender}' and d.posting='{$post}' ORDER BY d.court,d.posting,e.gender;";
                }
            }
        }
        else{
            if(strcmp($post,"all") == 0){
                if(strcmp($gender,"all") == 0){
                    $query = "SELECT e.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,e.gender,e.phone_number,e.e_mail,d.posting,d.court FROM employee as e,designation as d WHERE e.employeeID=d.employeeID and d.to_date is null and d.court='{$court}' ORDER BY d.court,d.posting,e.gender;";
                }
                else{
                    $query = "SELECT e.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,e.gender,e.phone_number,e.e_mail,d.posting,d.court FROM employee as e,designation as d WHERE (e.employeeID=d.employeeID and d.to_date is null) and e.gender='{$gender}' and d.court='{$court}' ORDER BY d.court,d.posting,e.gender;";
                }
            }
            else{
                if(strcmp($gender,"all") == 0){
                    $query = "SELECT e.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,e.gender,e.phone_number,e.e_mail,d.posting,d.court FROM employee as e,designation as d WHERE e.employeeID=d.employeeID and d.to_date is null and d.posting='{$post}' and d.court='{$court}' ORDER BY d.court,d.posting,e.gender;";
                }
                else{
                    $query = "SELECT e.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,e.gender,e.phone_number,e.e_mail,d.posting,d.court FROM employee as e,designation as d WHERE (e.employeeID=d.employeeID and d.to_date is null) and e.gender='{$gender}' and d.posting='{$post}' and d.court='{$court}' ORDER BY d.court,d.posting,e.gender;";
                }
            }
        }
        if($result = mysqli_query( $conn, $query)){
            $returnVal = queryTable($result);
            mysqli_close($conn);
            return $returnVal;
        }
        else{
            echo "<h2>SOME ERROR</h2>";
        }
    }

    function queryTable($result){
        if(mysqli_num_rows($result)==0){
            echo "<center><h2>No Results Found</h2></center>";
            return "";
        }
        $row_count = 1;
        echo "<table class='table table-info table-hover'>";
        echo "<tr>";
        echo "<th>Employee ID</th>";
        echo "<th>Employee Name</th>";
        echo "<th>Gender</th>";
        echo "<th>Phone Number</th>";
        echo "<th>Email</th>";
        echo "<th>Posting</th>";
        echo "<th>Current Court</th>";
        echo "</tr>";
        while ($row=mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['employeeID'] . "</td>";
        echo "<td>" . $row['employee_name'] . "</td>";
        echo "<td>" . $row['gender'] . "</td>";
        echo "<td>" . $row['phone_number'] . "</td>";
        echo "<td>" . $row['e_mail'] . "</td>";
        echo "<td>" . $row['posting'] . "</td>";
        echo "<td>" . $row['court'] . "</td>";
        echo "</tr>"; 
        $row_count++;     
        }
        echo "</table>";
    }

?>
