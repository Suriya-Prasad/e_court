<?php
    //Session started for each user login and user ID is extracted to provide user specific functionalities.
    session_start();
    if(!isset ($_SESSION['employeeID'])) {
        header("Location:index.php");    
    } elseif ($_SESSION['employeeID'] > 1) { // if not admin, redirect to user page
        header("Location:leave_entry_user_admin.php");  
    }
    include_once "navigation.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/leave_entry.css">
    <script>
    function fillResults(){
        document.getElementById('post_table').style.display = 'block';
        document.getElementById('post_table').innerHTML="<?php GetSeniority()?>";   
    }
    </script>
</head>
<body>
        <?php include_once "navbars.php"; ?>
        <div id="post_table">
            <script>fillResults();</script>
        </div>
    <script>
        var element = document.getElementById("leave_entry");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>