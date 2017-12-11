var app = angular.module('backoffice', ["ngRoute", "ngSanitize"]);

app.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
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
		.otherwise({
			redirectTo: "/welcome"
		});
}]);