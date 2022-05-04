<?php

    //connecting to the database
    include "db_connection.php";

    //creates session for each user
    session_start();

    //when user submits the form on clicking the submit button, below code is executed in order to authenticate the user by validating the user data in database.

    if(isset($_POST['submit'])) 
    { 
        if (empty($_POST['employeeID'])) {
            echo "<script>swal({title:'Enter Employee ID',icon:'info'});</script>";
        }

        else {
            
            $employeeID = $_POST['employeeID'];
            $password = $_POST['password'];
            $conn=connectDB();
            
            //validates if user with the entered credentials exist in database. if yes proceed to next page.
            $query="select * from employee where employeeID='{$employeeID}'";
            $result=mysqli_query($conn,$query);

            if(mysqli_num_rows($result) == 1 ){
                $row=mysqli_fetch_array($result);

                if($password == $row['password']){
                    $_SESSION['employeeID'] = $row['employeeID'];
                    echo isset($_SESSION['employeeID']);
                }
                else{
                    echo "<script>swal({title:'Invalid Employee ID / Password',icon:'info'});</script>";
                }
            }
            else{
              echo "<script>swal({title:'Invalid Employee ID / Password',icon:'info'});</script>";
            }       
        }

        //Once the user is succcessfully validated home page.
        if(isset($_SESSION['employeeID'])) {
            header("Location:home_attendance.php");        
        }
    }