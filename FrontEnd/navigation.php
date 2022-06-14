<?php
        session_start();
        if(! isset ($_SESSION['employeeID'])) {
            header("Location:index.php");    
        }

        
        if (isset($_POST['posting'])) {
            if(isset($_SESSION['employeeID']) && $_SESSION['employee_role'] === "super admin"){
                header("Location:posting.php");
            }
        }
        else if (isset($_POST['transfer'])) {
            if(isset($_SESSION['employeeID']) && $_SESSION['employee_role'] === "super admin"){
                header("Location:transfer.php");
            }
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
            if(isset($_SESSION['employeeID']) && $_SESSION['employee_role'] === "super admin"){
                header("Location:employee_registration.php");
            }
        }
        else if (isset($_POST['leave_entry'])) {
            if(isset($_SESSION['employeeID']) && $_SESSION['employee_role'] === "super admin"){
                header("Location:leave_entry_superadmin.php");
            }
            else{
                header("Location:leave_entry_user_admin.php");
            }

        }
        else if (isset($_POST['service_register'])) {
            if(isset($_SESSION['employeeID']) && $_SESSION['employee_role'] === "super admin"){
                header("Location:service_register_superadmin.php");
            }
            else{
                header("Location:service_register_user_admin.php");
            }
        }
        else if(isset($_POST['disciplinary_proceedings'])){
            if(isset($_SESSION['employeeID']) && $_SESSION['employee_role'] === "super admin"){
                header("Location:disciplinary_proceedings.php");
            }
        }
        else if(isset($_POST['query_builder'])){
            if(isset($_SESSION['employeeID']) && $_SESSION['employee_role'] === "super admin"){
                header("Location:query_builder.php");
            }
        }
?>