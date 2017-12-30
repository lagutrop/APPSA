angular.module('backoffice').controller("ListarSociosController", function ($scope, $http) {
	var activeSidebar = document.getElementsByClassName("nav-link active")[0],
		currentButton = document.getElementById('list');
	activeSidebar.classList.remove('active');
	currentButton.classList.add('active');
	$scope.message = "Em manutenção";
    $http.get("expire.php")
        .then(function (response) {
            if (response.data.data === "expired") {
                window.location.replace('/APPSA');
            }
    });
});