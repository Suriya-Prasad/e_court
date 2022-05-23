<?php
    //Session started for each user login and user ID is extracted to provide user specific functionalities.
    session_start();
    if(!isset ($_SESSION['employeeID'])) {
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
    <link rel="stylesheet" type="text/css" href="css/leave_entry.css">
</head>
<body>
        <?php include_once "navbars.php"; ?>


        <div id="content">
            <div id="leave">
            <form>
                <h2>LEAVE ENTRY</h2>
                <div class="label col-lg-4 col-md-6 col-sm-3">
                    <label for="employeeID">EMPLOYEE-ID: </label>
                </div>
                <div class="input col-lg-2 col-md-6 col-sm-3">
                    <input type="text" id="employeeID" name="employeeID" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"/>
                </div>
                <div class="label col-lg-2 col-md-6 col-sm-3">
                    <label for="fname">NAME: </label>
                </div>
                <div class="input col-lg-4 col-md-6 col-sm-3">
                    <input type="text" id="fname" name="first_name"/>
                </div>
                <div class="label col-lg-4 col-md-6 col-sm-3">
                    <label for="select_dt">SELECT-DAY-TYPE: </label>
                </div>
                <div class="input col-lg-2 col-md-6 col-sm-3">
                    <select id="select_dt" name = "select_day_type" class="form-select">
                        <option selected>&lt;--None--&gt;</option>
                        <option value="1">Half Day</option>
                        <option value="2">Full Day</option>
                        <option value="3">Continuous Days</option>
                    </select>
                </div>
                <div  class="label col-lg-2 col-md-6 col-sm-3">
                    <label for="leave_ty">LEAVE-TYPE: </label>
                </div>
                <div class="input col-lg-4 col-md-6 col-sm-3">
                    <select id="leave_ty" name = "leave_type" class="form-select">
                        <option selected>&lt;--None--&gt;</option>
                        <option value="1">Leave</option>
                        <option value="2">Medical</option>
                        <option value="3">Exemption</option>
                    </select>
                </div>
                <div class="label col-lg-4 col-md-6 col-sm-3">
                    <label for="date">LEAVE-DATE: </label>
                </div>
                <div class="input col-lg-2 col-md-6 col-sm-3">
                    <input type="date" id="l_date" name="leave_date">
                </div>
                <div  class="label col-lg-2 col-md-6 col-sm-3">
                    <label for="session">SESSION: </label>
                </div>
                <div class="input col-lg-4 col-md-6 col-sm-3">
                    <select id="session" name = "session" class="form-select">
                        <option value="1">Forenoon</option>
                        <option value="2">Afternoon</option>
                    </select>
                </div>
                <div class="label1 col-lg-4 col-md-5 col-sm-4">
                    <label for="l_reason">REASON: </label>
                </div>
                <div class="input1 col-lg-8 col-md-7 col-sm-8">
                    <textarea id="l_reason" name="leave_reason" form="usrform" rows="4" cols="40"></textarea>
                </div>
                <center><button type="submit" name = "submit_leave_entry" id="l_btn" class="btn btn-outline-success">APPLY</button></center>

                <?php
                    include_once "leave_status.php";
                ?>
            </form>
            </div>
        </div>


    <script>
        var element = document.getElementById("leave_entry");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php include_once "actions.php"; ?>