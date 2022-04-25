<?php
    //Session started for each user login and user ID is extracted to provide user specific functionalities.
    session_start();

    if(! isset ($_SESSION['employeeID'])) {
         header("Location:index.php");    
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body>
    <form action="" method="POST">
    <div id="navbar">
        <div id="main" class="d-md-none">
            <button type="button" class="openbtn" onclick="openNav()">&#9776;</button>
        </div>
        <div id="logo_name">
            <span><img src="download.png" alt="logo"></span>
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
                        <center><button type="submit" name="change_password"><b>CHANGE PASSWORD</b></button></center>
                    </div>
                    <div class="card-body">
                        <center><a href="logout.php"><button type="button" name="logout"><b>LOGOUT</b></button></a></center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="side_content">
        <div id="sidebar">
            <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn d-md-none" onclick="closeNav()">&times;</a>
            <button type="submit" name="attendance" class="active" data-bs-toggle="button" autocomplete="off" aria-pressed="true">Attendance</button>
            <div id="accordion2" class="card" type="button" data-bs-toggle="button" autocomplete="off">
            <div class="card-header">
                <button type="submit" name="staff_info" autocomplete="off" data-bs-toggle="collapse" href="#collapseTwo">
                    Staff Information
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                    </svg>
                </button>
            </div>
            <div id="collapseTwo" class="collapse" data-bs-parent="#accordion2">
                <hr class="dropdown-divider">
                <div class="card-body">
                    <center><button type="submit" name="property" data-bs-toggle="button" autocomplete="off">Property</button></center>
                </div>
                <div class="card-body">
                    <center><button type="submit" name="service_register" data-bs-toggle="button" autocomplete="off">Service Register</button></center>
                    </div>
                <div class="card-body">
                    <center><button type="submit" name="seniority" data-bs-toggle="button" autocomplete="off">Seniority</button></center>
                </div>
                <div class="card-body">
                    <center><button type="submit" name="running_note" data-bs-toggle="button" autocomplete="off">Running Note</button></center>
                </div>
            </div>
            </div>
            <button type="submit" name="leave_entry" data-bs-toggle="button" autocomplete="off">Leave Entry</button>
            <button type="submit" name="posting" data-bs-toggle="button" autocomplete="off">Posting/Tracking</button>
            <button type="submit" name="complaints" data-bs-toggle="button" autocomplete="off">Complaints/Greviance</button>
            <button type="submit" name="query_builder" data-bs-toggle="button" autocomplete="off">Query Builder</button>
            </div>
        </div>
        <div id="content">
            <?php echo GetResults(); ?>
        </div>
    </div>
    </div>
    </form>    
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script>    
        function openNav() {
            document.getElementById("mySidebar").style.width = "187px";   
        }
        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>
</body>
</html>

<?php include 'home_actions.php'; ?>