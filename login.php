<?php
    //creates session for each user
    session_start();

    //when user submits the form on clicking the submit button, below code is executed in order to authenticate the user by validating the user data in database.

    if(isset($_POST['submit'])) 
    { 
        if (empty($_POST['username'])) {
            echo "<script>swal({title:'Enter Username',icon:'info'});</script>";
        }

        else {
            
            $username = $_POST['username'];
            $password = $_POST['password'];
            $conn=connectDB();
            
            //validates if user with the entered credentials exist in database. if yes proceed to next page.
            $query="select * from employee where employeeID='{$username}'";
            $result=mysqli_query($conn,$query);

            if(mysqli_num_rows($result) == 1 ){
                $row=mysqli_fetch_array($result);

                if($password == $row['password']){
                    $_SESSION['employeeID'] = $row['employeeID'];
                    echo isset($_SESSION['employeeID']);
                }
                else{
                    echo "<script>swal({title:'Invalid Username / Password',icon:'info'});</script>";
                }
            }
            else{
              echo "<script>swal({title:'Invalid Username / Password',icon:'info'});</script>";
            }       
        }

        //Once the user is succcessfully validated home page.
        if(isset($_SESSION['employeeID'])) {
            header("Location:home.php");        
        }
    }
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