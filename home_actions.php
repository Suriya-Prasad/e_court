<?php
    function connectDB()
    {
        $conn = mysqli_connect("localhost:3306", "root", "", "e_courts");   
        if (!$conn) 
        {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        return $conn;
    }

    function GetResults()
    {
        if (isset($_POST['change_password'])) {
            return GetAllSongs();
        }
        else if (isset($_POST['attendance'])) {
            return GetLikes();
        }
        else if (isset($_POST['staff_info'])) {
            return GetHistory();
        }
        else if (isset($_POST['property'])) {
            return GetHistory();
        }
        else if (isset($_POST['service_register'])) {
            return GetHistory();
        }
        else if (isset($_POST['seniority'])) {
            return GetHistory();
        } 
        else if (isset($_POST['running_note'])) {
            return GetHistory();
        } 
        else if (isset($_POST['leave_entry'])) {
            return GetHistory();
        }  
        else if (isset($_POST['posting'])) {
            return SearchSongs();
        }
        else if (isset($_POST['complaints'])) {
            return GetHistory();
        } 
        else if (isset($_POST['query_builder'])) {
            return GetHistory();
        } 
        else {
            return GetAllSongs();
        }
    }