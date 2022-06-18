<?php
    session_start();
    unset($_SESSION['employeeID']);
    header("Location:index.php");
?>