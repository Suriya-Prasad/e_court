<?php
    //Session started for each user login and user ID is extracted to provide user specific functionalities.
    session_start();
    if(! isset ($_SESSION['employeeID'])) {
        header("Location:index.php");    
    }
    include_once "navigation.php";
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
    <link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
        <?php include_once "navbars.php"; ?>


        <div id="content">
            <form>
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
                    <input type="text" id="fname" required name="fisrt_name"/>
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
                    <textarea id="details" required name="sp_ch_details" rows="4" cols="55"></textarea>
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
                <center><button id="r_btn" class="btn btn-outline-success" name="submit_registration">REGISTER</button></center>
            </form>
            </div>


    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php include_once "actions.php"; ?>