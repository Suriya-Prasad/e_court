<script src="js/sweetalert.min.js"></script>

<?php
    
    include_once "db_connection.php";
    

    //Function to add an entry to designation table when submit clicked at posting page
    if(isset($_POST['submit_posting'])){
        $conn = connectDB();
        $employeeID = $_POST['employeeID'];
        $court_to = mysqli_real_escape_string($conn,$_POST['court_to']);
        $_SESSION['court_to'] = $court_to; 
        $post_to = mysqli_real_escape_string($conn,$_POST['post_to']);
        $_SESSION['post_to'] = $post_to;
        $query1 = "SELECT * from designation where employeeID = {$employeeID} and to_date is null and from_date is not null";
        $relive_date = $_POST['relive_date'];
        $join_date = $_POST['join_date'];
        $_SESSION['relive_date'] = $relive_date;
        $_SESSION['join_date'] = $join_date;
        if($result = mysqli_query($conn,$query1)){
            $row = mysqli_fetch_row($result);
            $from_court = $row[2];
            $from_post = $row[1];
            $_SESSION['from_court'] = $from_court;
            $_SESSION['from_post'] = $from_post;
            if(mysqli_num_rows($result) == 1 ){
                $relive_date = strtotime(str_replace('.','-',$relive_date));
                $relive_date = date("Y-m-d",$relive_date);
                $join_date = strtotime(str_replace('.','-', $join_date));
                $join_date = date("Y-m-d",$join_date);
                $query1 = "INSERT INTO designation (to_date) VALUES('{$relive_date}') where employeeID = {$employeeID} and to_date is null and from_date is not null";
                $query2 = "INSERT INTO designation(`employeeID`,`court`,`posting`,`from_date`) VALUES({$employeeID},'{$court_to}','{$post_to}','{$join_date}')";
                $query_run = mysqli_query($conn, $query2);
                $query3 = "SELECT CONCAT(first_name,' ',last_name)as employee_name FROM employee WHERE employeeID = {$employeeID}";
                mysqli_query($conn,$query1);
                $result2 = mysqli_query($conn,$query3);
                $row = mysqli_fetch_row($result2);
                $employeeName = $row[0];
                $_SESSION['post_transfer_employeeName'] = $employeeName;
                if($query_run){?>
                    <script>window.location.href = "pdf_generation.php";</script>
                <?php
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
        $_SESSION['court_to'] = $court_to;
        $court_from = mysqli_real_escape_string($conn,$_POST['court_from']);
        $_SESSION['from_court'] = $court_from;
        $query1 = "SELECT * from designation where employeeID = {$employeeID} and to_date is null and from_date is not null";
        $relive_date = date("d.m.Y");
        $join_date = $relive_date;
        $_SESSION['relive_date'] = $relive_date;
        $_SESSION['join_date'] = $join_date;
        if($result = mysqli_query($conn,$query1)){
            $row = mysqli_fetch_row($result);
            $from_court = $row[2];
            $from_post = $row[1];
            $_SESSION['from_post'] = $from_post;
            $_SESSION['post_to'] = $from_post;
            if(mysqli_num_rows($result) == 1 ){
                if($court_from == $court_to){
                    $_SESSION['status'] = "Employee works in the same court to be transfered";
                    $_SESSION['status_code'] = "warning";
                }
                else{
                    $relive_date = strtotime(str_replace('.','-',$relive_date));
                    $relive_date = date("Y-m-d",$relive_date);
                    $join_date = strtotime(str_replace('.','-', $join_date));
                    $join_date = date("Y-m-d",$join_date);
                    $query1 = "UPDATE designation SET to_date = '{$relive_date}' where employeeID = {$employeeID} and to_date is null and from_date is not null";
                    $query2 = "INSERT INTO designation (employeeID,court,posting,from_date) VALUES({$employeeID},'{$court_to}','{$from_post}','{$join_date}')";
                    $query3 = "SELECT CONCAT(first_name,' ',last_name)as employee_name FROM employee WHERE employeeID = {$employeeID}";
                    $result2 = mysqli_query($conn,$query3);
                    $row = mysqli_fetch_row($result2);
                    $employeeName = $row[0];
                    $_SESSION['post_transfer_employeeName'] = $employeeName;
                    mysqli_query($conn,$query1);
                    $query_run =  mysqli_query($conn, $query2);
                    if($query_run){?>
                    <script>window.location.href = "pdf_generation.php";</script>
                    <?php
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
    
    
    //Function to register a new employee
    else if(isset($_POST['submit_registration'])){
        $conn = ConnectDB();
        $employeeID = $_POST['employeeID'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $e_mail = $_POST['e_mail'];
        $phone_number = $_POST['phone_number'];
        $service_joining_date = $_POST['service_joining_date'];
        $date_of_birth = $_POST['date_of_birth'];
        $aadhar_number = $_POST['aadhar_number'];
        $pan_number = $_POST['pan_number'];
        $differently_abled = $_POST['differently_abled'];
        $gender = $_POST['gender'];
        $native_district = $_POST['native_district'];
        $community = $_POST['community'];
        $religion = $_POST['religion'];
        $caste = $_POST['caste'];
        $marital_status = $_POST['marital_status'];
        $spouse_father_name = $_POST['spouse_father_name'];
        $spouse_father_occupation = $_POST['spouse_father_occupation'];
        $spouse_father_current_district = $_POST['spouse_father_current_district'];
        $number_of_children = $_POST['number_of_children'];
        $special_child = $_POST['special_child'];
        $sp_ch_details = $_POST['sp_ch_details'];
        $permanent_address = $_POST['permanent_address'];
        $current_address = $_POST['current_address'];
        $account_holder_name = $_POST['account_holder_name'];
        $ifsc_number = $_POST['ifsc_number'];
        $account_number = $_POST['account_number'];
        $query="SELECT * from employee where employeeID={$employeeID};";
        $result = mysqli_query($conn,$query);       
            if(mysqli_num_rows($result) > 0 ){
                $_SESSION['status'] = "Employee is already registered";
                $_SESSION['status_code'] = "info";
            }
            else {
                $date_of_birth = strtotime(str_replace('.','-',$date_of_birth));
                $date_of_birth = date("Y-m-d",$date_of_birth);
                $service_joining_date = strtotime(str_replace('.','-',$service_joining_date));
                $service_joining_date = date("Y-m-d",$service_joining_date);
                $query1 = "INSERT INTO employee (employeeID, `password`, first_name, last_name, e_mail,phone_number,service_joining_date,date_of_birth,aadhar_number,pan_number,differently_abled,gender,native_district,community,religion,caste,marital_status,permanent_address,current_address,spouse_father_name) VALUES ('{$employeeID}', '{$password}', '{$first_name}', '{$last_name}','{$e_mail}','{$phone_number}','{$service_joining_date}','{$date_of_birth}','{$aadhar_number}','{$pan_number}','{$differently_abled}','{$gender}','{$native_district}','{$community}','{$religion}','{$caste}','{$marital_status}','{$permanent_address}','{$current_address}','{$spouse_father_name}')";
                $query1 .= "INSERT INTO spouse_father_details(employeeID,spouse_father_name,spouse_father_occupation,spouse_father_current_district) VALUES('{$employeeID}','{$spouse_father_name}','{$spouse_father_occupation}','{$spouse_father_current_district}')";
                $query1 .= "INSERT INTO bank_details(employeeID,account_holder_name,account_number,ifsc_number) VALUES('{$employeeID}','{$account_holder_name}','{$account_number}','{$ifsc_number}')";               
                if (!mysqli_multi_query($conn, $query1))
                {
                    $error = mysqli_error($conn);
                    echo $error;
                }
                $_SESSION['status'] = "Registration successfull";
                $_SESSION['status_code'] = "success";
            }     
    }


    //Function to Submit Leave Entry
    else if(isset($_POST['submit_leave_entry'])){
        $conn = ConnectDB();
        $employeeID = $_POST['employeeID'];
        $fisrt_name = $_POST['first_name'];
        $select_day_type = $_POST['select_day_type'];
        $leave_type = $_POST['leave_entry'];
        $leave_date = $_POST['leave_date'];
        $session = $_POST['session'];
        $leave_reason = $_POST['leave_reason'];

        //$query = "INSERT INTO leave_entry(employeeID,reason,from_date,'session',leave_type,select_day_type) VALUES('{$employeeID}','{$leave_reason}','{$leave_date}','{$session}','{$leave_type}, '{$select_day_type}')";

    }

?>

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