angular.module('backoffice').controller("welcomeController", function ($scope) {
	var activeSidebar = document.getElementsByClassName("nav-link active")[0],
		currentButton = document.getElementById('welcome');
	activeSidebar.classList.remove('active');
	currentButton.classList.add('active');
});