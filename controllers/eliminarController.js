angular.module('backoffice').controller("EliminarSocioController", function ($scope, $http) {
	var activeSidebar = document.getElementsByClassName("nav-link active")[0],
		currentButton = document.getElementById('update');
	activeSidebar.classList.remove('active');
	currentButton.classList.add('active');
	$scope.message = "Em manutenção";
    $http.get("expire.php")
        .then(function (response) {
            console.log(response.data);
            if (response.data.data === "expired") {
                window.location.replace('/APPSA');
            }
    });
});