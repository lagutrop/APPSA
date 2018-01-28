var app = angular.module('backoffice', ["ngRoute"]);

app.config(['$routeProvider', '$locationProvider', function ($routeProvider) {
	$routeProvider
		.when('/welcome', {
			templateUrl: 'welcome.php',
			controller: 'welcomeController'
		})
		.when('/adicionarSocio', {
			templateUrl: 'adicionar.php',
			controller: 'AdicionarSocioController'
		})
		.when('/listarSocios', {
			templateUrl: 'listar.php',
			controller: 'ListarSociosController'
		})
		.when('/eliminarSocio', {
			templateUrl: 'eliminar.php',
			controller: 'EliminarSocioController'
		})
        .when('/mudarPassword', {
            templateUrl: 'change.php',
            controller: 'MudarSenhaController'
        })
		.otherwise({
			redirectTo: "/welcome"
		});
}]);