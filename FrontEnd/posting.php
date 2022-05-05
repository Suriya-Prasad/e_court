<?php
include "navigation.php";
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
    <link rel="stylesheet" type="text/css" href="css/posting.css">
    <script>
    function fillResults(){
        document.getElementById('content').style.display = 'block';   
    }
    </script>
</head>
<body>
    <form action="" method="POST">
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
                        <center><button name="change_password"><b>Change Password</b></button></center>
                    </div>
                    <div class="card-body">
                        <center><button type="submit" name="logout"><b>LOGOUT</b></button></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

    <div id="side_content">
        <div id="sidebar">
            <form action="" method="POST">
            <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn d-md-none" onclick="closeNav()">&times;</a>
            <button type="submit" name="attendance">Attendance</button>
            <div id="accordion2" class="card" type="button" data-bs-toggle="button" autocomplete="off">
            <div class="card-header">
                <button type="button" autocomplete="off" data-bs-toggle="collapse" href="#collapseTwo">
                    Staff Information
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                    </svg>
                </button>
            </div>
            <div id="collapseTwo" class="collapse" data-bs-parent="#accordion2">
                <hr class="dropdown-divider">
                <div class="card-body">
                    <center><button type="submit" name="property">Property</button></center>
                </div>
                <div class="card-body">
                    <center><button type="submit" name="service_register">Service Register</button></center>
                    </div>
                <div class="card-body">
                    <center><button type="submit" name="seniority">Seniority</button></center>
                </div>
                <div class="card-body">
                    <center><button type="submit" name="running_note">Running Note</button></center>
                </div>
            </div>
            </div>
            <button type="submit" name="leave_entry">Leave Entry</button>
            <button type="submit" name="posting">Posting</button>
            <button type="submit" name="transfer">Transfer</button>
            <button type="submit" name="complaints_greviance">Complaints/Greviance</button>
            <button type="submit" name="query_builder">Query Builder</button>
            </div>
            </form>
        </div>


        <div id="content">
        <center>
            <br><br>
            <form action="" method="POST">
                <div id="posti">
                    <h2>POSTING</h2>
                    <br>
                    <label for="fname">EMPLOYEE ID: </label>
                    <input type="text" id="fname" name="fname">
                    <br><br><br>
                    <p>FROM :
                    <select id="post-from" class="form-select">
                        <option selected>&lt;--None--&gt;</option>
                        <option value="1">Court One</option>
                        <option value="2">Court Two</option>
                        <option value="3">Court Three</option>
                    </select></p>
                    <br>
                    <p>TO   :
                    <select id="post-to" class="form-select">
                        <option selected>&lt;--None--&gt;</option>
                        <option value="1">Court One</option>
                        <option value="2">Court Two</option>
                        <option value="3">Court Three</option>
                    </select></p>
                    <br>
                    <p>TO POSTING   :
                    <select id="post-to" class="form-select">
                        <option selected>&lt;--None--&gt;</option>
                        <option value="1">Court One</option>
                        <option value="2">Court Two</option>
                        <option value="3">Court Three</option>
                    </select></p>
                </div>
                <br>
                <button type="submit" name="submit_posting" class="btn btn-outline-success">SUBMIT</button>
            </form> 
        <center>
        </div>                
    </div>  
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>