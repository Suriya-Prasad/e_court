<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/discip_pro.css">
</head>
<body>
    <?php include_once "navbars_user_admin.php"; ?> 
        <div id="content">
            <div id="e_property">
                <div class="align">
                    <div class="label col-lg-5 col-md-5 col-sm-5">
                        <label for="property_details"> Description : </label>
                    </div>
                    <div class="input col-lg-7 col-md-7 col-sm-7">
                        <textarea id="property_details" name="property_details" rows="5" cols="55" required></textarea>
                    </div>
                </div>
                <div class="align">
                    <div class="form-group label col-lg-5 col-md-5 col-sm-5">
                        <label class="control-label" for="property_file"> File Upload : </label>
                    </div>    
                    <div class="input col-lg-7 col-md-7 col-sm-7">
                        <input type="file" name="property_file" id="property_file" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/sweetalert.min.js"></script>
</body>
</html>