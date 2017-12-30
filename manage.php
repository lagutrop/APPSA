<?php
include("validation.php");
privatePage();
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
		<script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16x16.png">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>Back-office</title>
	</head>
	<body ng-app="backoffice">
	    <nav class="navbar navbar-expand-md navbar-light bg-faded fixed-top">
            <a class="navbar-brand" href="#"><img id="appsa_small" src="assets/transp.png">APPSA</a>
		    <div class="ml-auto">
		        <a class="btn btn-outline-primary" href="index.php" role="button">Home</a>
			        <form id="logout" name="logout" action="logout.php" method="post">
				        <button class="btn btn-outline-primary" href="logout.php" role="button">Logout</button>
				    </form>
            </div>
        </nav>
		<div class="container-fluid dashboard-container">
			<div class="row">
				<nav class="col-xs-12 col-sm-2 col-md-2 bg-faded sidebar">
					<ul class="nav nav-pills flex-column">
						<li class="nav-item">
							<a id="welcome" class="nav-link active" href="manage.php">Bem-vindo</a>
						</li>
						<li class="nav-item">
							<a id="add" class="nav-link" href="#!adicionarSocio">Adicionar sócio</a>
						</li>
						<li class="nav-item">
							<a id="list" class="nav-link" href="#!listarSocios">Lista de sócios</a>
						</li>
						<li class="nav-item">
							<a id="update" class="nav-link" href="#!eliminarSocio">Eliminar sócio</a>
						</li>
					</ul>
				</nav>
				<main class="dashboard col-xs-12 col-sm-10 col-md-10 ml-auto">
					<div ng-view></div>
				</main>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<script src="javascript/login.js"></script>
		<script src="controllers/adicionarController.js"></script>
		<script src="controllers/listarController.js"></script>
		<script src="controllers/eliminarController.js"></script>
		<script src="controllers/welcomeController.js"></script>
	</body>
</html>