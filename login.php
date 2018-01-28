<?php
include_once('validation.php');
redirectLoggedUsers();
/**
 * Created by Tiago
 * Date: 20-01-2018
 * Time: 12:18
 */
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon.png">
    <title>Login</title>
</head>
<body id="login-page">
<div id="login-wrapper" class="container-fluid d-flex justify-content-center align-items-center">
    <div class="login jumbotron">
        <img src="assets/appsa_brand.jpg" class="brand-round img-fluid rounded-circle d-block mx-auto"/>
        <h1 class="login-title text-center">Login</h1>
        <form id="login-form" action="logger.php" method="post" accept-charset="UTF-8">
            <p id="login-msg" class="text-center">Insira o seu nome de utilizador e palavra chave</p>
            <div class="login-body row justify-content-center">
                <div class="input-container col-10 col-sm-8 col-md-8 col-lg-8">
                    <label class="login_label">Username</label>
                    <input id="login_username" name="login_username" class="form-control" type="text"
                           placeholder="Username" maxlength="30" required>
                </div>
                <div class="input-container col-10 col-sm-8 col-md-8 col-lg-8">
                    <label class="login_label">Password</label>
                    <input id="login_password" name="login_password" class="form-control" type="password"
                           placeholder="Password" maxlength="30" required>
                </div>
                <div class="input-container col-10 col-sm-8 col-md-8 col-lg-8">
                    <button class="btn btn-primary btn-lg col-md-12">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
