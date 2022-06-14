<!DOCTYPE html>
<?php
    include_once "navigation.php";
?>

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
        <?php include_once "navbars_superadmin.php"; ?>
        <div id="content">
            <div id="posting">
            <center>
                <form action="" method="POST">
                    <h2>QUERY BUILDER</h2>
                    <p>GENDER :
                        <input type="radio" id="gender1" required name="gender"/>
                        <label for="gender1">MALE</label>
                        <input type="radio" id="gender2" name="gender"/>
                        <label for="gender2">FEMALE</label>
                        <input type="radio" id="gender3" name="gender"/>
                        <label for="gender3">OTHER</label>
                    </p>
                    <p>COURT  :
                    <select id="post-to" name="court_to" class="form-select">
                        <option selected>&lt;--None--&gt;</option>
                        <option value="court one">Court One</option>
                        <option value="court two">Court Two</option>
                        <option value="court three">Court Three</option>
                    </select></p>
                    <p>POST  :
                    <select id="post-to" name="post_to" class="form-select">
                        <option selected>&lt;--None--&gt;</option>
                        <option value="post 1">Post One</option>
                        <option value="post 2">Post Two</option>
                        <option value="post 3">Post Three</option>
                    </select></p>
                </form>
            <center>
            </div>
        </div>                
    </div>
    <script>
        var element = document.getElementById("query_builder");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/sweetalert.min.js"></script>
</body>
</html>

<script>
    function archiveFunction() {
    event.preventDefault(); // prevent form submit
    var form = event.target.form; // storing the form
        swal({
            title: "Are you sure?",
            text: "The changes made cannot be revoked!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(
        function(isConfirm){
            if (isConfirm) {
                <?php $_POST['submit_posting'] = true; ?>
                form.submit(); // submitting the form when user press yes
            } else {
                swal("Cancelled", "No Changes Made", "error");
            }
        });
    }
</script>

<?php include_once "actions.php"; ?>