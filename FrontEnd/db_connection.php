<?php

//function to connect to the db with login details and the database selection.
//Modify the localhost,username,password,database name as per individual credentials.

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

?>