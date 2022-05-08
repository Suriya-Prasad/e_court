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