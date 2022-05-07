<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
        $result = mysqli_query($conn,$query1);
        if(mysqli_num_rows($result) == 1 ){
            $query2 = "INSERT INTO designation(`employeeID`,`court`,`posting`) VALUES({$employeeID},'{$court_to}','{$post_to}')";
            mysqli_query($conn, $query2);
            echo "<script>swal({title:'Mail sent successfully!',icon:'success'});</script>";
        }
        if(mysqli_num_rows($result) > 1){
            echo "<script>swal({title:'Employee promotion order already exist!',icon:'info'});</script>";
        }
        else{
            echo "<script>swal({title:'No active employee!',icon:'info'});</script>";
        }
    }

     //Function to add an entry to designation table when submit clicked at transfer page
    else if(isset($_POST['submit_transfer'])){
        $conn = connectDB();
        $employeeID = $_POST['employeeID'];
        $court_to = mysqli_real_escape_string($conn,$_POST['court_to']);
        $court_from = mysqli_real_escape_string($conn,$_POST['court_from']);
        $query1 = "SELECT * from designation where employeeID = {$employeeID} and to_date is null";
        $result = mysqli_query($conn,$query1);
        $row = mysqli_fetch_row($result);
        $posting = $row[1];
        if(mysqli_num_rows($result) == 1 ){
            $query2 = "INSERT INTO designation (employeeID,court,posting) VALUES({$employeeID},'{$court_to}','{$posting}')";
            mysqli_query($conn, $query2) or die(mysqli_error($conn));
            echo "<script>swal({title:'Mail sent successfully!',icon:'success'});</script>";
        }
        else if(mysqli_num_rows($result) > 1){
            echo "<script>swal({title:'Employee transfer order already exist!',icon:'info'});</script>";
        }
        else{
            echo "<script>swal({title:'No active Employee!',icon:'info'});</script>";
        }
    }

    //Function to handle the seniorirty page
    else if(isset($_POST["SeniorityForm"])) {
        $posting = mysqli_real_escape_string($conn,$_POST["SeniorityForm"]);
        $conn = connectDB();      
        $query = "SELECT employeeID,employee_name,current_court,disciplinary_proceeeesgs from employee as e, designation as d, disciplinary_proceeding as ds where e.employeeID IN (select employeeID from desgination where posting = '{$posting}' and (to_date is null and from_date is not null))";

        if($result == mysqli_query( $conn, $query)){
            $returnVal = seniorityTable($result);
            mysqli_close($conn);
            return $returnVal;
        }
        else{
            printf("Error: %s\n", mysqli_error($conn));
        }
    }

    //Function to change password
    else if (isset($_POST['submit_change_password'])) {
        $conn = ConnectDB();
        $old_password = mysqli_real_escape_string($conn,$_POST['old_password']);
        $new_password = mysqli_real_escape_string($conn,$_POST['new_password']);
        $confirm_password = mysqli_real_escape_string($conn,$_POST['confirm_password']);
        if($old_password === $new_password){
            echo "<script>swal({title:'New password is same as old password',icon:'info'});</script>";
        }
        else if($new_password != $confirm_password){
            echo "<script>swal({title:'New password does not match',icon:'info'});</script>";
        }
        else{
            $employeeID = $_SESSION['employeeID'];
            $query = "UPDATE employee SET password = '{$new_password}' where employeeID = {$employeeID}";
            mysqli_query($conn,$query) or die($conn);
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
        echo "<th>S.No</td>";
        echo "<th>Name</th>";
        echo "<th>Current Court</th>";
        echo "<th>Disciplinary Proceedings</th>";
        echo "</tr>";
        while ($row=mysqli_fetch_array($result)) {
        
        echo    "<tr>";
        echo  "<td>" . (string)$row_count . "</td>";
        echo  "<td>" . $row['employee_name'] . "</td>";
        echo  "<td>" . $row['court'] . "</td>";
        echo  "<td>" . $row['disciplinary_proceesing'] . "</td>";
            
        echo "</tr>"; 
        $row_count++;     
        }
        echo "</table>";
    }
?>