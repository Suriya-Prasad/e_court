<?php
        session_start();
        if(! isset ($_SESSION['employeeID'])) {
            header("Location:index.php");    
        }

        
        if (isset($_POST['posting'])) {
            header("Location:posting.php");
        }
        else if (isset($_POST['transfer'])) {
            header("Location:transfer.php");
        }
        else if (isset($_POST['seniority'])) {
            header("Location:seniority.php");
        }
        else if (isset($_POST['attendance'])) {
            header("Location:home_attendance.php");
        }
        else if (isset($_POST['logout'])) {
            header("Location:logout.php");
        }
        else if (isset($_POST['change_password'])) {
            header("Location:change_password.php");
        }
        else if (isset($_POST['employee_registration'])) {
            header("Location:employee_registration.php");
        }
        else if (isset($_POST['leave_entry'])) {
            if(isset($_SESSION['employeeID']) && $_SESSION['employeeID'] > 1){
                header("Location:leave_entry_user_admin.php");
            }
            else if(isset($_SESSION['employeeID']) && $_SESSION['employeeID'] == 1){
                header("Location:leave_entry_superadmin.php");
            }
        }
        else if (isset($_POST['service_register'])) {
            if(isset($_SESSION['employeeID']) && $_SESSION['employeeID'] > 1){
                header("Location:service_register_user_admin.php");
            }
            else if(isset($_SESSION['employeeID']) && $_SESSION['employeeID'] == 1){
                header("Location:service_register_superadmin.php");
            }
        }
?>