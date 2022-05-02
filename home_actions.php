<?php
if ( $_GET['action'] == ''){
    return;
}

session_start();
$employeeID = $_SESSION['employeeID'];
if(! isset ($_SESSION['employeeID'])) {
        header("Location:index.php");
} 

$action = $_GET['action'];

if (! strcmp($action, "Getemployee_details") )
{
    $conn = ConnectDB();
    $employeeID = mysqli_real_escape_string ($conn, $_GET['employeeID']);
    $query = "SELECT * from employee where employeeID = {$employeeID}";
    mysqli_query($conn, $query); 
} 
?>