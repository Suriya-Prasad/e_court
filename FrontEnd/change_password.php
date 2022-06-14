<!DOCTYPE html>
<?php
    include_once "navigation.php"; 
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/change_password.css">  
    <title>Change Password</title>
</head>
<body class="text-center">
    <form action="" method="POST">
    <div class="form-signin">
        <h1 class="h2 mb-3 fw-bold">CHANGE PASSWORD</h1><br>
        <div class="form-floating">
            <input type="password" name="old_password" class="form-control" id="password" placeholder="Password">
            <label for="password">Old Password</label>
        </div><br>
        <div class="form-floating">
            <input type="password" name="new_password" class="form-control" id="newPassword" placeholder="Password">
            <label for="newPassword">New Password</label>
        </div><br>
        <div class="form-floating">
            <input type="password" name="confirm_password" class="form-control" id="confirmPassword" placeholder="Password">
            <label for="confirmPassword">Confirm Password</label>
        </div><br>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit_change_password">SUBMIT</button>
    </div>
    </form>

</body>
</html>

<?php
//Function to change password

include_once "actions.php"; 

if (isset($_POST['submit_change_password'])) {
    $conn = ConnectDB();
    $old_password = mysqli_real_escape_string($conn,$_POST['old_password']);
    $new_password = mysqli_real_escape_string($conn,$_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn,$_POST['confirm_password']);
    if($old_password === $new_password){
        $_SESSION['status'] = "New password same as old password";
        $_SESSION['status_code'] = "info";
    }
    else if($new_password != $confirm_password){
        $_SESSION['status'] = "New passwords does not match";
        $_SESSION['status_code'] = "info";
    }
    else{
        $employeeID = $_SESSION['employeeID'];
        $query = "UPDATE employee SET password = '{$new_password}' where employeeID = {$employeeID}";
        $query_run =  mysqli_query($conn,$query);
        if($query_run){
            $_SESSION['status'] = "Password changed successfully";
            $_SESSION['status_code'] = "success";
            header('Location: home_attendance.php');
        }
    }
}

?>