<?php
include("validation.php");
redirectLoggedUsers();
?>
<!DOCTYPE html>
<html>

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="16x16" href="assets/favicon.png">
	<title>Procure um sócio</title>
</head>

<body ng-app="myApp" ng-cloak>
	<nav class="navbar navbar-expand-md navbar-light bg-faded">
		<a class="navbar-brand" href="#"><img id="appsa_small" src="assets/transp.png">APPSA</a>
		<div class="ml-auto">
			<a class="btn btn-outline-primary" href="#" role="button" data-toggle="modal" data-target="#login">Login</a>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<img id="appsa_logo" class="d-block mx-auto img-fluid" src="assets/appsa_logo_aprov-1.jpg" alt="Logo da associaçao APPSA">
			</div>
			<div class="col-md-12">
				<h1 class="text-center">Procure um sócio</h1>
			</div>
			<form id="appsa-form" name="appsa" class="col-md-12 novalidate">
				<label for="socio">Número de sócio</label>
				<input name="control" type="number" class="form-control" id="socioForm" ng-model="socioId" required form-directive placeholder="Insira o seu número de sócio">
				<div class="text-center input-info" ng-show="appsa.control.$error.required && appsa.control.$dirty">Insira um número de sócio válido</div>
			</form>
			<div class="container-fluid input-info d-block mx-auto" ng-class="{cardError: !appsa.control.$valid, cardEnabled: !appsa.control.$error.required, cardDisabled: appsa.control.$error.required}">
				<div class="row">
					<div class="col-md-12 nomargin">
						<img src="assets/transp.png" id="card-logo" class="float-right" alt="Logo do cartao de socio">
					</div>
					<div class="card-info">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<p class="text-center">{{isSocio}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div ng-app="login" class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Login</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
				</div>
				<div class="modal-body">
					<form id="login-form" action="logger.php" method="post" accept-charset="UTF-8">
						<div class="modal-body">
							<div id="div-login-msg">
								<p id="login-msg" class="text-center">Insira o seu nome de utilizador e palavra chave</p>
							</div>
							<input id="login_username" name="login_username" class="form-control" type="text" placeholder="Username" maxlength="30" required>
							<input id="login_password" name="login_password" class="form-control" type="password" placeholder="Password" maxlength="30" required>
						</div>
						<div class="modal-footer">
							<div>
								<button class="btn btn-primary btn-lg">Login</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	<script src="javascript/app.js"></script>
</body>

</html>
