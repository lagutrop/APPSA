var app = angular.module('backoffice');

app.controller("LogOutController", function($scope, $http) {
    $http.post("logout.php")
        .then(function (response) {
            window.location.replace('/APPSA');  
    });
})