/*global angular, window*/

var app = angular.module('backoffice');

app.controller("LogOutController", function ($scope, $http) {
    "use strict";
    $http.post("logout.php")
        .then(function () {
            window.location.replace('/appsa/login.php');
        });
});