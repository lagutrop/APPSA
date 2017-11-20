var app = angular.module('backoffice', ["ngRoute"]);

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
		.when('/alterarSocio', {
			templateUrl: 'alterar.php',
			controller: 'AlterarSocioController'
		})
		.otherwise({
			redirectTo: "/welcome"
		});
}]);