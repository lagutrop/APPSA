angular.module('backoffice').controller("ListarSociosController", function ($scope) {
	var activeSidebar = document.getElementsByClassName("nav-link active")[0],
		currentButton = document.getElementById('list');
	activeSidebar.classList.remove('active');
	currentButton.classList.add('active');
	$scope.message = "Em manutenção";
});