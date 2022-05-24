<?php
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
    <link rel="stylesheet" type="text/css" href="css/posting.css">
</head>
<body>
<?php include_once "navbars.php";?>

        <div id="content">
        <div id="transfer">
        <center>
            <h2>TRANSFER</h2>
            <form action="" method="POST" onsubmit="return submitForm(this)">
                <label for="employeeID">EMPLOYEE ID: </label>
                <input type="text" id="employeeID" name="employeeID">
                <p>FROM COURT :
                <select id="court-from" name="court_from" class="form-select">
                    <option selected>&lt;--None--&gt;</option>
                    <option value="court one">Court One</option>
                    <option value="court two">Court Two</option>
                    <option value="court three">Court Three</option>
                </select></p>
                <p>TO COURT  :
                <select id="post-to" name="court_to" class="form-select">
                    <option selected>&lt;--None--&gt;</option>
                    <option value="court one">Court One</option>
                    <option value="court two">Court Two</option>
                    <option value="court three">Court Three</option>
                </select></p>
                <div class="label col-lg-4 col-md-6 col-sm-6">
                    <label for="join_date">JOINING-DATE: </label>
                </div>
                <div class="input col-lg-2 col-md-6 col-sm-6">
                    <input type="date" id="joining_date" required name="join_date"/>
                </div>
                <div class="label col-lg-2 col-md-6 col-sm-6">
                    <label for="leave_date">RELIVE DATE: </label>
                </div>
                <div class="input col-lg-4 col-md-6 col-sm-6">
                    <input type="date" id="leave_date" required name="relive_date"/>
                </div>
                <button type="submit" name="submit_transfer" class="btn btn-outline-success">SUBMIT</button>
            </form> 
        <center>
        </div>
        </div>
    </div>    
    <script>
        var element = document.getElementById("transfering");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php include_once "actions.php"; ?>