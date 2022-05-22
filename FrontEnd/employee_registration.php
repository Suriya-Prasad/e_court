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
    <link rel="stylesheet" type="text/css" href="css/home_attendance.css">
    <link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
        <?php include_once "navbars.php"; ?>

        <form>
        <div id="content">
            <h2>REGISTRATION</h2>
            <div id="half">
            <table>
            <tr>
                <td><label for="employeeID">EMPLOYEE ID: </label>
                <td><input type="text" id="employeeID" name="employeeID" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
            </tr>
            <tr>
                <td><label for="fname">FIRST NAME: </label></td>
                <td><input type="text" id="fname" name="fisrt_name"></td>
            </tr>
            <tr>
                <td><label for="emailID">E-MAIL: </label></td>
                <td><input type="email" id="emailID" name="e_mail"></td>
            </tr>
            <tr>
                <td><label for="service_joinDate">SERVICE-JOINING DATE: </label></td>
                <td><input type="date" id="service_joinDate" name="service_joining_date"></td>
            </tr>
            <tr>
                <td><label for="native_district">NATIVE-DISTRICT: </label></td>
                <td><input type="text" id="native_district" name="native_district"></td>
            </tr>
            <tr>
                <td><span>MARITAL-STATUS:</span></td>
                <td><label for="status1">YES</label>
                <input type="radio" id="marital_status1" name="marital_status">
                <label for="status2">NO</label>
                <input type="radio" id="marital_status2" name="marital_status"></td>
            </tr>
            <tr>
                <td><span>DIFFERENTLY-ABLED:</span></td>
                <td><label for="diff_abled1">YES</label>
                <input type="radio" id="diff_abled1" name="differently_abled">
                <label for="diff_abled2">NO</label>
                <input type="radio" id="diff_abled2" name="differently_abled"></td>
            </tr>
            <tr>
                <td><label for="aadhar_num">AADHAR-NUMBER: </label></td>
                <td><input type="text" id="aadhar_num" name="aadhar_number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"></td>
            </tr>
            <tr>
                <td><label for="community">COMMUNITY: </label></td>
                <td><input type="text" id="community" name="community"></td>
            </tr>
            </table>
            </div>

            <div id="half">
            <table>
            <tr>
                <td><label for="password">PASSWORD: </label></td>
                <td><input type="password" id="password" name="password"></td>
            </tr>
            <tr>
                <td><label for="lname">LAST-NAME: </label></td>
                <td><input type="text" id="lname" name="last_name"></td>
            </tr>
            <tr>
                <td><label for="phone_num">PHONE-NUMBER: </label></td>
                <td><input type="text" id="phone_num" name="phone_number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"></td>
            </tr>
            <tr>
                <td><label for="dob">DATE-OF-BIRTH: </label></td>
                <td><input type="date" id="dob" name="date_of_birth"></td>
            </tr>
            <tr>
                <td><span>GENDER:</span></td>
                <td><label for="gender1">MALE</label>
                <input type="radio" id="gender1" name="gender">
                <label for="gender2">FEMALE</label>
                <input type="radio" id="gender2" name="gender">
                <label for="gender3">OTHER</label>
                <input type="radio" id="gender3" name="gender"></td>
            </tr>
            <tr>
                <td><label for="s_f_name">SPOUSE/FATHER-NAME: </label></td>
                <td><input type="text" id="s_f_name" name="spouse/father_name"></td>
            </tr>
            <tr>
                <td><label for="religion">RELIGION: </label></td>
                <td><input type="text" id="religion" name="religion"></td>
            </tr>
            <tr>
                <td><label for="pan_num">PAN-NUMBER: </label></td>
                <td><input type="text" id="pan_num" name="pan_number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"></td>
            </tr>
            <tr>
                <td><label for="cast">CAST: </label></td>
                <td><input type="text" id="cast" name="cast"></td>
            </tr>
            </table>
            </div>

            <div id="half">
            <table>
            <tr>
                <td><label for="p_address">PERMANENT-ADDRESS: </label></td>
                <td><input type="text" id="p_address" name="permanent_address"></td>
            </tr>
            <tr>
                <td><label for="c_address">CURRENT-ADDRESS: </label></td>
                <td><input type="text" id="c_address" name="current_address"></td>
            </tr>
            </table>
            </div>

            <div id="half">
            <table>
            <tr>
                <td><label for="s_f_occupation">SPOUSE/FATHER-OCCUPATION: </label></td>
                <td><input type="text" id="s_f_occupation" name="spouse/father_occupation"></td>
            </tr>
            <tr>
                <td><label for="num_child">NUMBER-OF-CHILDREN: </label></td>
                <td><input type="number" id="num_child" name="number_of_children"></td>
            </tr>
            </table>
            </div>

            <div id="half">
            <table>
            <tr>
                <td><label for="s_f_curr_district">SPOUSE/FATHER-DISTRICT: </label></td>
                <td><input type="text" id="s_f_curr_district" name="spouse/father_current_district"></td>
            </tr>
            <tr>
                <td><span>SPECIAL-CHILD:</span></td>
                <td><label for="special_cild1">YES</label>
                <input type="radio" id="special_cild1" name="special_cild">
                <label for="special_cild2">NO</label>
                <input type="radio" id="special_cild2" name="special_cild"></td>
            </tr>
            </table>
            </div>

            <div id="half">
            <table>
            <tr>
                <td><label for="details">DETAILS-OF-SPECIAL-CHILD: </label></td>
                <td><input type="text" id="details" name="details"></td>
            </tr>
            </table>
            </div>
        </div>
        </form>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php include_once "actions.php"; ?>