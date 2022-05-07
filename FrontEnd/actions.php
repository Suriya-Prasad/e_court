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
?>