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
    
    include_once "db_connection.php";

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
?>