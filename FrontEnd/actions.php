<script src="js/sweetalert.min.js"></script>

<?php

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

<?php
    
    //Function to coonect to database
    function connectDB()
    {
        $connection = mysqli_connect("localhost:3306", "root", "", "e_courts");   
    
        if (!$connection) 
        {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        return $connection;
    }


    //Function to add an entry to designation table when submit clicked at posting page
    if(isset($_POST['submit_posting'])){
        $conn = connectDB();
        $employeeID = $_POST['employeeID'];
        $court_to = mysqli_real_escape_string($conn,$_POST['court_to']);
        $post_to = mysqli_real_escape_string($conn,$_POST['post_to']);
        $query1 = "SELECT * from designation where employeeID = {$employeeID} and to_date is null";
        if($result = mysqli_query($conn,$query1)){
            if(mysqli_num_rows($result) == 1 ){
                $query2 = "INSERT INTO designation(`employeeID`,`court`,`posting`) VALUES({$employeeID},'{$court_to}','{$post_to}')";
                $query_run = mysqli_query($conn, $query2);
                if($query_run){
                    $_SESSION['status'] = "Posting order sent successfully";
                    $_SESSION['status_code'] = "success";
                }
            }
            else if(mysqli_num_rows($result) > 1){
                $_SESSION['status'] = "Posting order already exist";
                $_SESSION['status_code'] = "info";
            }
            else{
                $_SESSION['status'] = "Employee does not exist";
                $_SESSION['status_code'] = "warning";
            }
        }
        else{
            $_SESSION['status'] = "Something went wrong";
            $_SESSION['status_code'] = "warning";
        }
    }

     //Function to add an entry to designation table when submit clicked at transfer page
    else if(isset($_POST['submit_transfer'])){
        $conn = connectDB();
        $employeeID = $_POST['employeeID'];
        $court_to = mysqli_real_escape_string($conn,$_POST['court_to']);
        $court_from = mysqli_real_escape_string($conn,$_POST['court_from']);
        $query1 = "SELECT * from designation where employeeID = {$employeeID} and to_date is null";
        if($result = mysqli_query($conn,$query1)){
            $row = mysqli_fetch_row($result);
            $posting = $row[1];
            if(mysqli_num_rows($result) == 1 ){
                if($court_from == $court_to){
                    $_SESSION['status'] = "Employee works in the same court to be transfered";
                    $_SESSION['status_code'] = "warning";
                }
                else{
                    $query2 = "INSERT INTO designation (employeeID,court,posting) VALUES({$employeeID},'{$court_to}','{$posting}')";
                    $query_run =  mysqli_query($conn, $query2);
                    if($query_run){
                        $_SESSION['status'] = "Transfer order sent successfully";
                        $_SESSION['status_code'] = "success";
                    }
                }
            }
            else if(mysqli_num_rows($result) > 1){
                $_SESSION['status'] = "Transfer order already exist";
                $_SESSION['status_code'] = "info";
            }
            else{
                $_SESSION['status'] = "Employee does not work in the selected court";
                $_SESSION['status_code'] = "warning";
            }
        }
        else{
            $_SESSION['status'] = "Something went wrong";
            $_SESSION['status_code'] = "warning";
        }
    }


    //Function to change password
    else if (isset($_POST['submit_change_password'])) {
        $conn = ConnectDB();
        $old_password = mysqli_real_escape_string($conn,$_POST['old_password']);
        $new_password = mysqli_real_escape_string($conn,$_POST['new_password']);
        $confirm_password = mysqli_real_escape_string($conn,$_POST['confirm_password']);
        if($old_password === $new_password){
            $_SESSION['status'] = "New password same as old password";
            $_SESSION['status_code'] = "info";
        }
        else if($new_password != $confirm_password){
            $_SESSION['status'] = "New passwords does not match";
            $_SESSION['status_code'] = "info";
        }
        else{
            $employeeID = $_SESSION['employeeID'];
            $query = "UPDATE employee SET password = '{$new_password}' where employeeID = {$employeeID}";
            $query_run =  mysqli_query($conn,$query);
            if($query_run){
                $_SESSION['status'] = "Password changed successfully";
                $_SESSION['status_code'] = "success";
                header('Location: home_attendance.php');
            }
        }
    }

    //Function to handle the seniorirty page
    
    else if(isset($_POST["SeniorityForm"])) {  
            $conn = connectDB();
            $posting = mysqli_real_escape_string($conn,$_POST["SeniorityForm"]);      
            $query = "SELECT d.employeeID,CONCAT(e.first_name,' ',e.last_name)as employee_name,MIN(d.from_date) as join_date from employee as e, designation as d WHERE d.employeeID IN(select employeeID from designation where posting ='{$posting}' and to_date is null AND from_date is not null) AND posting = '{$posting}'  AND e.employeeID = d.employeeID GROUP BY employeeID ORDER BY join_date;";
            if($result = mysqli_query( $conn, $query)){
                $returnVal = seniorityTable($result);
                mysqli_close($conn);
                return $returnVal;
            }
            else{
                printf("Error: %s\n", mysqli_error($conn));
            }
    }

    //Function to display the seriority of a posting
    function seniorityTable($result){
        if(mysqli_num_rows($result)==0){
            return "<script>swal({title:'No employee exist in this post',icon:'info'});</script>";
        }
        $row_count = 1;
        echo "<table class='table table-info table-hover'>";
        echo "<tr>";
        echo "<th>Employee ID</td>";
        echo "<th>Employee Name</th>";
        echo "<th>Posting joined date</th>";
        // echo "<th>Disciplinary Proceedings</th>";
        echo "</tr>";
        while ($row=mysqli_fetch_array($result)) {
        
        echo    "<tr>";
        echo  "<td>" . $row['employeeID'] . "</td>";
        echo  "<td>" . $row['employee_name'] . "</td>";
        echo  "<td>" . $row['join_date'] . "</td>";
        // echo  "<td>" . $row['disciplinary_proceesing'] . "</td>";
            
        echo "</tr>"; 
        $row_count++;     
        }
        echo "</table>";
    }
?>