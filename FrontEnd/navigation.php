<?php

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
?>