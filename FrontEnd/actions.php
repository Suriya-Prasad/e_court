<script src="js/sweetalert.min.js"></script>

<?php
    
    include_once "db_connection.php";
    

    //Function to add an entry to designation table when submit clicked at posting page
    if(isset($_POST['submit_posting'])){
        $conn = connectDB();
        if($_POST['join_date'] >= $_POST['relive_date']){
            $employeeID = $_POST['employeeID'];
            $court_to = mysqli_real_escape_string($conn,$_POST['court_to']);
            $post_to = mysqli_real_escape_string($conn,$_POST['post_to']);
            $query1 = "SELECT * from designation where employeeID = {$employeeID} and to_date is null and from_date is not null";
            if($result = mysqli_query($conn,$query1)){
                $row = mysqli_fetch_row($result);
                $from_court = $row[2];
                $from_post = $row[1];
                if(strcmp($post_to,$from_post) != 0){
                    $_SESSION['court_to'] = $court_to; 
                    $_SESSION['post_to'] = $post_to;
                    $_SESSION['relive_date'] = $_POST['relive_date'];
                    $_SESSION['join_date'] = $_POST['join_date'];
                    $_SESSION['from_court'] = $from_court;
                    $_SESSION['from_post'] = $from_post;
                    if(mysqli_num_rows($result) == 1 ){
                        $relive_date = strtotime(str_replace('.','-',$relive_date));
                        $relive_date = date("Y-m-d",$relive_date);
                        $join_date = strtotime(str_replace('.','-', $join_date));
                        $join_date = date("Y-m-d",$join_date);
                        $query1 = "UPDATE designation SET to_date = '{$relive_date}' where employeeID = {$employeeID} and to_date is null and from_date is not null";
                        $query2 = "INSERT INTO designation(`employeeID`,`court`,`posting`,`from_date`) VALUES({$employeeID},'{$court_to}','{$post_to}','{$join_date}')";
                        mysqli_query($conn, $query1);
                        $query_run = mysqli_query($conn,$query2);
                        $query3 = "SELECT CONCAT(first_name,' ',last_name)as employee_name FROM employee WHERE employeeID = {$employeeID}";
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
                    $_SESSION['status'] = "Employee works in the same post to be transfered";
                    $_SESSION['status_code'] = "warning";
                }
            }
        }
        else{
            $_SESSION['status'] = "Joining date must be after or at the relieve date";
            $_SESSION['status_code'] = "warning";
        }
    }

     //Function to add an entry to designation table when submit clicked at transfer page
    else if(isset($_POST['submit_transfer'])){
        $conn = connectDB();
        if($_POST['join_date'] >= $_POST['relive_date']){
            $employeeID = $_POST['employeeID'];
            $court_to = mysqli_real_escape_string($conn,$_POST['court_to']);
            $court_from = mysqli_real_escape_string($conn,$_POST['court_from']);
            if(strcmp($court_to,$court_from) != 0){
                $query1 = "SELECT * from designation where employeeID = {$employeeID} and to_date is null and from_date is not null";
                if($result = mysqli_query($conn,$query1)){
                    $row = mysqli_fetch_row($result);
                    $from_court = $row[2];
                    $from_post = $row[1];
                    if(mysqli_num_rows($result) == 1 ){
                            $_SESSION['from_court'] = $court_from;
                            $_SESSION['court_to'] = $court_to;
                            $_SESSION['relive_date'] = $_POST['relive_date'];
                            $_SESSION['join_date'] = $_POST['join_date'];
                            $_SESSION['from_post'] = $from_post;
                            $_SESSION['post_to'] = $from_post;
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
                            mysqli_query($conn, $query1);
                            $query_run = mysqli_query($conn,$query2);
                            if($query_run){?>
                            <script>window.location.href = "pdf_generation.php";</script>
                            <?php
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
            }
            else{
                $_SESSION['status'] = "Employee works in the same court to be transfered";
                $_SESSION['status_code'] = "warning";
            }
        }
        else{
            $_SESSION['status'] = "Joining date must be after or at the relieve date";
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
                $query1 = "INSERT INTO employee (employeeID, `password`, first_name, last_name, e_mail,phone_number,service_joining_date,date_of_birth,aadhar_number,pan_number,differently_abled,gender,native_district,community,religion,caste,marital_status,permanent_address,current_address,spouse_father_name) VALUES ('{$employeeID}', '{$password}', '{$first_name}', '{$last_name}','{$e_mail}','{$phone_number}','{$service_joining_date}','{$date_of_birth}','{$aadhar_number}','{$pan_number}','{$differently_abled}','{$gender}','{$native_district}','{$community}','{$religion}','{$caste}','{$marital_status}','{$permanent_address}','{$current_address}','{$spouse_father_name}');";
                $query1 .= "INSERT INTO spouse_father_details(employeeID,spouse_father_name,spouse_father_occupation,spouse_father_current_district) VALUES('{$employeeID}','{$spouse_father_name}','{$spouse_father_occupation}','{$spouse_father_current_district}');";
                $query1 .= "INSERT INTO bank_details(employeeID,account_holder_name,account_number,ifsc_number) VALUES('{$employeeID}','{$account_holder_name}','{$account_number}','{$ifsc_number}');";               
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
        $select_day_type = $_POST['select_day_type'];
        $leave_type = $_POST['leave_type'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $leave_reason = "";
        $status = "pending";
        $query="SELECT * from leave_entry where (employeeID='{$_SESSION['employeeID']}' and from_date = '{$from_date}' and to_date = '{$to_date}' and day_type = '{$select_day_type}')";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) > 0 ){
            $_SESSION['status'] = "Employee is already registered";
            $_SESSION['status_code'] = "info";
        }
        else{
            $query = "INSERT INTO leave_entry(employeeID,reason,from_date,to_date,leave_type,day_type,`status`) VALUES('{$_SESSION['employeeID']}','{$leave_reason}','{$from_date}','{$to_date}','{$leave_type}','{$select_day_type}','{$status}')";
            if(! mysqli_query($conn,$query)){
                $error = mysqli_error($conn);
                echo $error;
            }
            else{
                $_SESSION['status'] = "Leave Requested";
                $_SESSION['status_code'] = "success";
            }
        }
    }

    //Function to build report for required query
    else if(isset($_POST['submit_query_builder'])){
        $conn = connectDB();
        $post = $_POST['posting'];
        $court = $_POST['court'];
        $gender = $_POST['gender'];
        if(strcmp($court,"all")){
            if(strcmp($post,"all")){
                if(strcmp($post,"all")){
                    
                }
            }
        }
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