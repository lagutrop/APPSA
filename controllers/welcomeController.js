/*global angular, document, window*/

var app = angular.module('backoffice');

app.controller("welcomeController", function ($scope, $http) {
    "use strict";
	var activeSidebar = document.getElementsByClassName("nav-link active")[0],
		currentButton = document.getElementById('welcome');
	activeSidebar.classList.remove('active');
	currentButton.classList.add('active');
    $(currentButton).click(function (e) {
        if ($(this).hasClass("active")) {
            e.preventDefault();
        }
    });
    $scope.expire = function () {
        $http.get("expire.php")
            .then(function (response) {
                if (response.data.data === "expired") {
                    $http.post("logout.php")
                        .then(function () {
                            window.location.replace('/appsa/login.php');
                        });
                } else {
                    $http.post("renew.php");
                }
            });
    };
    $scope.expire();
});
