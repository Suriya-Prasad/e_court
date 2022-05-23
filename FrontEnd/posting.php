<?php
    //Session started for each user login and user ID is extracted to provide user specific functionalities.
    session_start();
    if(! isset ($_SESSION['employeeID'])) {
        header("Location:index.php");    
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
    <link rel="stylesheet" type="text/css" href="css/posting.css">
</head>
<body>
        <?php include_once "navbars.php"; ?>
        <div id="content">
            <div id="posting">
            <center>
                <form action="" method="POST">
                    <h2>POSTING</h2>
                    <label for="employeeID">EMPLOYEE ID: </label>
                    <input type="text" id="employeeID" name="employeeID">
                    <p>TO COURT  :
                    <select id="post-to" name="court_to" class="form-select">
                        <option selected>&lt;--None--&gt;</option>
                        <option value="court one">Court One</option>
                        <option value="court two">Court Two</option>
                        <option value="court three">Court Three</option>
                    </select></p>
                    <p>TO POSTING   :
                    <select id="post-to" name="post_to" class="form-select">
                        <option selected>&lt;--None--&gt;</option>
                        <option value="post 1">Post One</option>
                        <option value="post 2">Post Two</option>
                        <option value="post 3">Post Three</option>
                    </select></p>
                    <div class="label col-lg-4 col-md-6 col-sm-4">
                        <label for="join_date">JOINING-DATE: </label>
                    </div>
                    <div class="input col-lg-2 col-md-6 col-sm-2">
                        <input type="date" id="joining_date" required name="join_date"/>
                    </div>
                    <div class="label col-lg-2 col-md-6 col-sm-2">
                        <label for="leave_date">RELIVE DATE: </label>
                    </div>
                    <div class="input col-lg-4 col-md-6 col-sm-4">
                        <input type="date" id="leave_date" required name="relive_date"/>
                    </div>
                    <button type="button" id="check" name="submit_posting" class="btn btn-outline-success">SUBMIT</button>
                </form>
            <center>
            </div>
        </div>                
    </div>
    <script>
        var element = document.getElementById("posting");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    
        document.querySelector('#check').addEventListener('click', function(e){
            var form = this;
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "You cant undo this operation",
                buttons: [
                    'CANCEL',
                    'YES'
                ],
            }).then(function(isConfirm) {
            if (isConfirm) {
                swal({
                    text: "POSTED",
                    icon: 'success',
                    buttons: false
                }).then(function() {
                    form.submit();
                });
            }
            })
        });
    </script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

<?php include_once "actions.php"; ?>