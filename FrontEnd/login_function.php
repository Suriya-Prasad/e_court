<script src="js/sweetalert.min.js"></script>

<?php
    include_once "db_connection.php";
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
            $query="SELECT * from employee where employeeID='{$employeeID}'";
            $result=mysqli_query($conn,$query);
            $query1="SELECT CONCAT(first_name,' ',last_name)as employee_name from employee where employeeID=1";
            if(mysqli_num_rows($result) == 1 ){
                $row=mysqli_fetch_array($result);
                $row1 = mysqli_fetch_array(mysqli_query($conn,$query1));
                if($password == $row['password']){
                    $_SESSION['employeeID'] = $row['employeeID'];
                    $_SESSION['page_employeeName'] = $row['first_name'];
                    $_SESSION['pdj_name'] = $row1['employee_name'];
                    echo isset($_SESSION['employeeID']);
                    header("Location:home_attendance.php");
                }
                else{
                    echo "<script>swal({title:'Invalid Employee ID / Password',icon:'info'});</script>";
                }
            }
            else{
              echo "<script>swal({title:'Invalid Employee ID / Password',icon:'info'});</script>";
            }       
        }
    }


?>