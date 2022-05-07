<?php
    //Session started for each user login and user ID is extracted to provide user specific functionalities.
    session_start();
    if(! isset ($_SESSION['employeeID'])) {
        header("Location:index.php");    
    }
    include "navigation.php";
    include "actions.php";
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
    <script>
    function fillResults(){
        document.getElementById('content').style.display = 'block';   
    }
    </script>
</head>
<body>
    <div id="navbar">    
        <div id="main" class="d-md-none">
            <button class="openbtn" onclick="openNav()">&#9776;</button>
        </div>
        <div id="logo_name">
            <span><img src="utilities/download.png" alt="logo"></span>
            <span><h2>Tiruppur Jurisdiction</h2></span>
        </div>
        <div id="profile">
            <div id="accordion1" class="card">
                <div class="card-header">
                    <button type="button" data-bs-toggle="collapse" href="#collapseOne">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg><h5>UserName</h5>
                    </button>
                </div>
                <div id="collapseOne" class="collapse" data-bs-parent="#accordion1">
                    <hr class="dropdown-divider">
                    <div class="card-body">
                         <form action="" method="POST">
                        <center><button type="submit" id="change_password" name="change_password"><b>Change Password</b></button></center>
                    </div>
                    <div class="card-body">
                        <center><button type="submit" id="logout" name="logout"><b>LOGOUT</b></button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
       
    <div id="side_content">
        <div id="sidebar">
            <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn d-md-none" onclick="closeNav()">&times;</a>
            <form action="" method="POST">
            <button type="submit" class="btn btn-outline-info" id="attendance" name="attendance">Attendance</button>
            </form>
            <div id="accordion2" class="card">
            <div class="card-header">
                <button type="button" class="btn btn-secondary" name="staff_information" data-bs-toggle="collapse" href="#collapseTwo">
                    <span>Staff Information<span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                    </svg>
                </button>
            </div>
            <div id="collapseTwo" class="collapse" data-bs-parent="#accordion2">
                <hr class="dropdown-divider">
                <div class="card-body">
                <form action="" method="POST">
                    <center><button type="submit" id="property" name="property">Property</button></center>
                </div>
                <div class="card-body">
                    <center><button type="submit"  id="service_register" name="service_register">Service Register</button></center>
                    </div>
                <div class="card-body">
                    <center><button type="submit" id="seniority"  name="seniority">Seniority</button></center>
                </div>
                <div class="card-body">
                    <center><button type="submit" id="running_note" name="running_note">Running Note</button></center>
                </form>
                </div>
            </div>
            </div>
            <form action="" method="POST">
            <button type="submit" class="btn btn-info" id="leave_entry" name="leave_entry">Leave Entry</button>
            <button type ="submit" class="btn btn-outline-success" id="posting" name="posting">Posting</button>
            <button type="submit" class="btn btn-outline-secondary" id="transfer" name="transfer">Transfer</button>
            <button type="submit" class="btn btn-secondary" id="complaints_greviance" name="complaints_greviance">Complaints/Greviance</button>
            <button type="submit" class="btn btn-success" id="query_builder" name="query_builder">Query Builder</button>
            </form>
            </div>
        </div>



        <div id="content">
            <script>fillResults();</script>
            <br><br>
            <label for="date">DATE: </label>
            <input type="date" id="date" name="date">
            <br><br><br>
            <table class="table table-info table-hover">
                <tr>
                    <th>S.No</th><th>Date</th><th>Name</th><th>Id</th><th>Attendance</th><th>Time</th>
                </tr>
                <tr>
                    <td>1</td></td><td>25/04/2022</td><td>Vishwa</td><td>2353463642</td><td>NO</td><td>10:33</td>
                </tr>
                <tr>
                    <td>2</td></td><td>25/04/2022</td><td>Suganya</td><td>2353111642</td><td>YES</td><td>10:12</td>
                </tr>
                <tr>
                    <td>3</td></td><td>25/04/2022</td><td>Ganesh</td><td>2311163642</td><td>YES</td><td>9:54</td>
                </tr>
                <tr>
                    <td>4</td></td><td>25/04/2022</td><td>Arul</td><td>2353463111</td><td>YES</td><td>9:30</td>
                </tr>
            </table>
        </div>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>