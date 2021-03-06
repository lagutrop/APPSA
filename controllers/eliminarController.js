/*global angular, document, window*/

var app = angular.module('backoffice');

app.controller("EliminarSocioController", function ($scope, $http) {
    "use strict";
	var activeSidebar = document.getElementsByClassName("nav-link active")[0],
		currentButton = document.getElementById('update');
	activeSidebar.classList.remove('active');
	currentButton.classList.add('active');
	$scope.message = "Em manutenção";
    $scope.expire = function (button) {
        $http.get("expire.php")
            .then(function (response) {
                if (response.data.data === "expired") {
                    $http.post("logout.php")
                        .then(function () {
                            window.location.replace('/appsa/login.php');
                        });
                } else {
                    $http.post("renew.php")
                        .then(function () {
                            switch (button) {
                                case 'eliminar':
                                    break;
                                default:
                                    break;
                            }
                        });
                }
            });
    };
    $scope.expire();
});
