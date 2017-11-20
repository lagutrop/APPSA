angular.module('backoffice').controller("AlterarSocioController", function ($scope) {
	var activeSidebar = document.getElementsByClassName("nav-link active")[0],
		currentButton = document.getElementById('update');
	activeSidebar.classList.remove('active');
	currentButton.classList.add('active');
	$scope.message = "mod";
});