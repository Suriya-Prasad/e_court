<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.84.0">

        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
        <link href="bootstrap.min.css" rel="stylesheet">
        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }
            
            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
            </style>
        <link rel="stylesheet" type="text/css" href="index.css">

        
        <title>Log in</title>
        
    </head>
    <body class="text-center">

    <div id = 'fsh'>
        <div id = 'log'><center><img src="download.png" alt="logo" style="height: auto; width: 20%;"></center><br><center><h1>Tiruppur Jurisdiction</h1></center></div>
    </div>
    <form action="" method="post">

    <div id = 'firsth'><center>
    
    <div class="form-signin">
        <h1 class="h2 mb-3 fw-bold">STAFF LOGIN</h1><br>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" placeholder="Name" name="username" style="background-color: #8ED6FF;">
            <label for="floatingInput">User Name</label>
        </div><br>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" style="background-color: #8ED6FF;">
            <label for="floatingPassword">Password</label>
        </div><br>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Log In</button>
    </div></center>
    </div>

    </form>

    <div id = 'secondh'>
        <div id = 'logo'><center><img src="download.png" alt="logo" style="height: auto; width: 47%;"></center><br><center><h1>Tiruppur Jurisdiction</h1></center></div>
    </div>
</body>
</html>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php require 'login.php'; ?>