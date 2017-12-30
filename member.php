<?php
include("validation.php");
privatePage();
?>
<!DOCTYPE html>
<html>

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.3/angular-ui-router.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16x16.png">
	<title>Procure um sócio</title>
</head>

<body ng-app="myApp" ng-cloak>
	<nav class="navbar navbar-expand-md navbar-light bg-faded">
		<a class="navbar-brand" href="#"><img id="appsa_small" src="assets/transp.png">APPSA</a>
		<div class="ml-auto">
			<a class="btn btn-outline-primary" href="manage.php" role="button">Painel</a>
			<form id="logout" name="logout" action="logout.php" method="post">
				<button class="btn btn-outline-primary" href="logout.php" role="button">Logout</button>
			</form>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<img id="appsa_logo" class="d-block mx-auto img-fluid" src="assets/appsa_logo_aprov-1.jpg" alt="Logo da associaçao APPSA">
			</div>
			<div class="col-md-12">
				<h1 class="text-center">Procurar sócio</h1>
			</div>
			<form id="appsa-form" name="appsa" class="col-md-12 novalidate">
				<label for="socio">Número de sócio</label>
				<input name="control" class="form-control" id="socioForm" ng-model="socioId" required form-directive placeholder="Insira o seu nome ou número de sócio">
				<div class="text-center input-info" ng-show="appsa.control.$invalid && appsa.control.$dirty">Insira um nome ou número de sócio correto</div>
			</form>
			<div class="container-fluid input-info d-block mx-auto" ng-class="{cardEnabled: appsa.control.$valid, cardDisabled: appsa.control.$invalid}">
				<div class="row">
					<div class="col-md-12">
						<img src="assets/transp.png" id="card-logo" class="float-right" alt="Logo do cartao de socio">
					</div>
					<div class="card-info">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<p>Número de sócio: {{table[0].numero_socio}}</p>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<p>Quota: {{table[0].quota}}</p>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<p>Data do pagamento: {{table[0].data_pagamento}}</p>
						</div>
					</div>
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
