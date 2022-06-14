<!DOCTYPE html>
<?php
    include_once "navigation.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/attendance.css">
    <script>
        function dp(){
            let dop = document.getElementById('dp_inp').style.display;
            if (dop == "none")
                document.getElementById("dp_inp").style.display = "block";
            else
                document.getElementById("dp_inp").style.display = "none";
        }

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
                    </svg><h5><?php echo $_SESSION['page_employeeName'];?></h5>
                </button>
            </div>
            <div id="collapseOne" class="collapse" data-bs-parent="#accordion1">
                <hr class="dropdown-divider">
                <form action="" method="POST">
                    <div class="card-body">
                        <center><button type="submit" id="change_password" name="change_password">Change Password</button></center>
                    </div>
                    <div class="card-body">
                        <center><button type="submit" id="logout" name="logout">Logout</button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
       
    <div id="side_content">
        <div id="sidebar">
            <div id="mySidebar" class="sidebar">
                <a href="javascript:void(0)" class="closebtn d-md-none" onclick="closeNav()">&times;</a>
                <form action="" method="POST">
                    <button class="btn btn-outline-secondary" type="submit" id="attend" name="attendance">Attendance</button>
                    <button class="btn btn-outline-secondary" type="submit" id="property" name="property">Property</button>
                    <button class="btn btn-outline-secondary" type="submit" id="service_register" name="service_register">Service Register</button>
                    <button class="btn btn-outline-secondary" type="submit" id="senior" name="seniority">Seniority</button>
                    <button class="btn btn-outline-secondary" type="submit" id="running_note" name="running_note">Running Note</button>
                    <button class="btn btn-outline-secondary" type="submit" id="leave_entry" name="leave_entry">Leave Entry</button>
                    <button class="btn btn-outline-secondary" type="submit" id="complaints_greviance" name="complaints_greviance">Complaints/Greviance</button>
                </form>
            </div>
        </div>
        
        <div id="dp_body">
            <button id="dp" onclick="dp()">DP</button>
            <textarea id="dp_inp" placeholder="Disciplinary Proceedings" style="display: none;"></textarea>
        </div>


        <div id="content">
            <div id="attendance">
            <h2>ATTENDANCE</h2>
            <script>fillResults();</script>
            <label for="date">DATE: </label>
            <input type="date" id="date" name="date" max="<?php echo date("Y-m-d");?>">
            <table id="op_table" class="table table-info table-hover">
                <tr>
                    <th>S.No</th><th>Date</th><th>Name</th><th>Id</th><th>Attendance</th><th>Time</th>
                </tr>
                <tr>
                    <td>1</td><td>25/04/2022</td><td>Vishwa</td><td>2353463642</td><td>NO</td><td>10:33</td>
                </tr>
                <tr>
                    <td>2</td><td>25/04/2022</td><td>Suganya</td><td>2353111642</td><td>YES</td><td>10:12</td>
                </tr>
                <tr>
                    <td>3</td><td>25/04/2022</td><td>Ganesh</td><td>2311163642</td><td>YES</td><td>9:54</td>
                </tr>
                <tr>
                    <td>4</td><td>25/04/2022</td><td>Arul</td><td>2353463111</td><td>YES</td><td>9:30</td>
                </tr>
            </table>
            </div>
        </div>

        
    </div>
    <script>
        var element = document.getElementById("attend");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php include_once "actions.php"; ?>