<!DOCTYPE html>
<?php
    include_once "navigation.php";
    include_once "db_connection.php";
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
    <link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
        <?php include_once "navbars_superadmin.php"; ?>


        <div id="content">
            <div id="register">
            <h2>REGISTRATION</h2>
            <form action="" method="POST">
                <div class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="employeeID">EMPLOYEE-ID:</label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="employeeID" required name="employeeID" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"/>
                </div>
                <div class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="password">PASSWORD: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="password" id="password" required name="password"/>
                </div>
                <div class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="fname">FIRST-NAME: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="fname" required name="first_name"/>
                </div>
                <div class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="lname">LAST-NAME: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="lname" required name="last_name"/>
                </div>
                <div  class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="emailID">E-MAIL: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="email" id="emailID" required name="e_mail"/>
                </div>
                <div  class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="phone_num">PHONE-NUMBER: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="phone_num" required name="phone_number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"/>
                </div>
                <div  class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="service_joinDate">SERVICE-JOIN-DATE: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="date" id="service_joinDate" required name="service_joining_date"/>
                </div>
                <div class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="dob">DATE-OF-BIRTH: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="date" id="dob" required name="date_of_birth"/>
                </div>
                <div  class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="aadhar_num">AADHAR-NUMBER: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="aadhar_num" required name="aadhar_number"/>
                </div>
                <div class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="pan_num">PAN-NUMBER: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="pan_num" required name="pan_number"/>
                </div>
                <div class="label col-lg-3 col-md-6 col-sm-3">
                    <label>DIFFERENTLY-ABLED: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <div><input type="radio" id="diff_abled1" required name="differently_abled"/>
                    <label for="diff_abled1">YES</label></div>
                    <div><input type="radio" id="diff_abled2" name="differently_abled"/>
                    <label for="diff_abled2">NO</label></div>
                </div>
                <div class="label col-lg-3 col-md-6 col-sm-3">
                    <label>GENDER: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <div><input type="radio" id="gender1" required name="gender"/>
                    <label for="gender1">MALE</label></div>
                    <div><input type="radio" id="gender2" name="gender"/>
                    <label for="gender2">FEMALE</label></div>
                    <div><input type="radio" id="gender3" name="gender"/>
                    <label for="gender3">OTHER</label></div></p>
                </div>
                <div  class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="native_district">NATIVE-DISTRICT: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="native_district" required name="native_district"/>
                </div>
                <div  class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="community">COMMUNITY: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="community" required name="community"/>
                </div>
                <div  class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="religion">RELIGION: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="religion" required name="religion"/>
                </div>
                <div  class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="cast">CASTE: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="cast" required name="caste"/>
                </div>
                <div  class="label col-lg-3 col-md-6 col-sm-3">
                    <label>MARITAL-STATUS: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <div><input type="radio" id="marital_status1" required name="marital_status"/>
                    <label for="status1">YES</label></div>
                    <div><input type="radio" id="marital_status2" name="marital_status"/>
                    <label for="status2">NO</label></div>
                </div>
                <div class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="s_f_name">SPOUSE/FATHER-NAME: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="s_f_name" required name="spouse_father_name"/>
                </div>
                <div  class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="s_f_occupation">SPOUSE/FATHER-OCCUPATION: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="s_f_occupation" required name="spouse_father_occupation"/>
                </div>
                <div  class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="s_f_curr_district">SPOUSE/FATHER-DISTRICT: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="s_f_curr_district" required name="spouse_father_current_district"/>
                </div>
                <div class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="num_child">NUMBER-OF-CHILDREN: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="number" id="num_child" required name="number_of_children"/>
                </div>
                <div  class="label col-lg-3 col-md-6 col-sm-3">
                    <label>SPECIAL-CHILD: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <div><input type="radio" id="special_child1" required onclick="selector()" name="special_child"/>
                    <label for="special_child1">YES</label></div>
                    <div><input type="radio" id="special_child2" onclick="selector()" name="special_child"/>
                    <label for="special_child2">NO</label></div>
                </div>
                <div id="sp_ch" class="col-lg-4 col-md-5 col-sm-4">
                    <label for="details">DETAILS-OF-SPECIAL-CHILD: </label>
                </div>
                <div id="sp_ch1" class="col-lg-8 col-md-7 col-sm-8">
                    <textarea id="details" name="sp_ch_details" rows="4" cols="55"></textarea>
                </div>
                <div class="label1 col-lg-4 col-md-5 col-sm-4">
                    <label for="p_address">PERMANENT-ADDRESS: </label>
                </div>
                <div class="input1 col-lg-8 col-md-7 col-sm-8">
                    <textarea id="p_address" required name="permanent_address" rows="5" cols="55"></textarea>
                </div>
                <div class="label1 col-lg-4 col-md-5 col-sm-4">
                    <label for="c_address">CURRENT-ADDRESS: </label>
                </div>
                <div class="input1 col-lg-8 col-md-7 col-sm-8">
                    <textarea id="c_address" required name="current_address" rows="5" cols="55"></textarea>
                </div>
                <div class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="acc_name">BANK ACCOUNT HOLDER NAME: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="acc_name" name="account_holder_name"/>
                </div>
                <div class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="acc_num">BANK ACCOUNT NUMBER: </label>
                </div>
                <div class="input col-lg-3 col-md-6 col-sm-3">
                    <input type="text" id="acc_num" name="account_number"/>
                </div>
                <div class="label col-lg-3 col-md-6 col-sm-3">
                    <label for="ifsc_num">IFSC NUMBER: </label>
                </div>
                <div class="input col-lg-9 col-md-6 col-sm-9">
                    <input type="text" id="ifsc_num" name="ifsc_number"/>
                </div>
                <center><button type="submit" id="r_btn" name="submit_registration" class="btn btn-outline-success">REGISTER</button></center>
            </form>
            </div>
    </div>
    <script>
        var element = document.getElementById("employee_registration");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php

    //Function to register a new employee
    if(isset($_POST['submit_registration'])){
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

    include_once "actions.php"; 

?>