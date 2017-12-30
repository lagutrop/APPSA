angular.module('backoffice').controller("welcomeController", function ($scope, $http) {
	var activeSidebar = document.getElementsByClassName("nav-link active")[0],
		currentButton = document.getElementById('welcome');
	activeSidebar.classList.remove('active');
	currentButton.classList.add('active');
    $http.get("expire.php")
        .then(function (response) {
            if (response.data.data === "expired") {
                window.location.replace('/APPSA');
            }
    });
});