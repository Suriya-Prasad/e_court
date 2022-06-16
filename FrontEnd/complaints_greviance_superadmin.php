<!DOCTYPE html>
<?php
    include_once "navigation.php";
    include_once "actions.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/comp_gre.css">
</head>
<body>
    <?php 
        if($_SESSION['employeeID'] == 1){
            include_once "navbars_superadmin.php"; 
        }
        else{
            include_once "navbars_user_admin.php";
        }
    ?>

        <div id="content">
            <div id="co-gr">
                <form>
                    <h2>Create a Complaint/Greviance</h2>
                    <div class="align">
                        <div class="label col-lg-5 col-md-5 col-sm-5">
                            <label for="subject"> Subject : </label>
                        </div>
                        <div class="input col-lg-7 col-md-7 col-sm-7">
                            <input type="text" id="subject" name="subject" required />
                        </div>
                    </div>
                    <div class="align">
                        <div class="label col-lg-5 col-md-5 col-sm-5">
                            <label for="co_gr_desc"> Description : </label>
                        </div>
                        <div class="input col-lg-7 col-md-7 col-sm-7">
                            <textarea id="co_gr_desc" name="co_gr_desc" rows="5" cols="55" required></textarea>
                        </div>
                    </div>
                    <button type="submit" id="co-gr-btn" name="submit_complaint" class="btn btn-outline-success">SUBMIT</button>
                </form>
                <div id="post_table">
                    <table class="table table-info table-hover">
                        <tr>
                            <th>sdsd</th>
                            <th>sdds</th>
                        </tr>
                        <tr>
                            <td>fg</td>
                            <td>fgh</td>
                        </tr>
                        <tr>
                            <td>kl/</td>
                            <td>kllk</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    
    </div>

    <script>
        var element = document.getElementById("complaints_greviance");
        element.classList.remove("btn-outline-secondary");
        element.classList.add("btn-secondary");
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js" ></script>
    <script src="js/main.js"></script>
</body>
</html>