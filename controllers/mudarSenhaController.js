/*global angular, $, document, window*/

var app = angular.module('backoffice');

app.controller("MudarSenhaController", function ($scope, $http) {
    "use strict";
    var activeSidebar = document.getElementsByClassName("nav-link active")[0],
        currentButton = document.getElementById('change');
    $scope.addObjects = {
        errorMessage: "",
        secretChanged: false,
        dataError: false,
        loading: false,
        senhaAtual: '',
        senhaNova: '',
        senhaConfirmation: '',
        buttonsDisabled: false
    };
    activeSidebar.classList.remove('active');
    currentButton.classList.add('active');

    $scope.submit = function () {
        $http.post("cgi-bin/changePassword.php", [$scope.addObjects.senhaAtual, $scope.addObjects.senhaNova])
            .then(function onSuccess() {
                    $scope.addObjects.senhaAtual = '';
                    $scope.addObjects.senhaConfirmation = '';
                    $scope.addObjects.senhaNova = '';
                    $scope.addObjects.secretChanged = true;
                    $scope.addObjects.dataError = false;
                    $scope.addObjects.loading = false;
                    $scope.changeForm.$setUntouched();
                    $scope.changeForm.$setPristine();
                },
                function onError(response) {
                    $scope.addObjects.senhaAtual = '';
                    $scope.addObjects.senhaConfirmation = '';
                    $scope.addObjects.senhaNova = '';
                    $scope.addObjects.errorMessage = response.data.data;
                    $scope.addObjects.dataError = true;
                    $scope.addObjects.dataInserted = false;
                    $scope.addObjects.loading = false;
                });
    };

    $scope.submitData = function () {
        $scope.expire('submit');
    };

    $scope.disableSubmitButton = function () {
        $scope.addObjects.secretChanged = false;
    };

    $scope.disableErrorButton = function () {
        $scope.addObjects.dataError = false;
    };

    $scope.expire = function (button) {
        $scope.addObjects.loading = true;
        $scope.addObjects.buttonsDisabled = true;
        $http.get("expire.php")
            .then(function (response) {
                if (response.data.data === "expired") {
                    $http.post("logout.php")
                        .then(function () {
                            window.location.replace('/appsa/login.php');
                            $scope.addObjects.buttonsDisabled = false;
                            $scope.addObjects.loading = false;
                        });
                } else {
                    $http.post("renew.php")
                        .then(function () {
                            switch (button) {
                                case 'submit':
                                    $scope.submit();
                                    $scope.addObjects.loading = false;
                                    $scope.addObjects.buttonsDisabled = false;
                                    break;
                                default:
                                    $scope.addObjects.loading = false;
                                    $scope.addObjects.buttonsDisabled = false;
                                    break;
                            }
                        })
                }
            });
    };
    $scope.expire();
});

app.directive('senhaDirective', function () {
    "use strict";
    return {
        require: "ng-model",
        link: function (scope, elem, attr, ngModelCtrl) {
            $(elem)
                .on("keyup change", function (e) {
                    var senha = e.target.value,
                        pattern = new RegExp("^(?=.*\\d)(?=.*[A-Z])[a-zA-Z0-9](?=.*[\\W_]).{7,}$");
                    if (pattern.test(senha)) {
                        ngModelCtrl.$setValidity('pw', true);
                        scope.$apply();
                    } else {
                        ngModelCtrl.$setValidity('pw', false);
                        scope.$apply();
                    }
                });
        }
    };
});

app.directive('senhaConfirmationDirective', function () {
    "use strict";
    return {
        require: "ng-model",
        link: function (scope, elem, attr, ngModelCtrl) {
            var firstPassword = '#' + attr.watcher;
            $(elem).add(firstPassword).on('keyup', function () {
                scope.$apply(function () {
                    var v = elem.val() === $(firstPassword).val();
                    ngModelCtrl.$setValidity('match', v);
                });
            });
        }
    }
});

app.directive('strength', [
    function () {
        return {
            require: 'ngModel',
            restrict: 'E',
            scope: {
                password: '=ngModel'
            },

            link: function (scope) {
                scope.$watch('password', function (newVal) {

                    scope.strength = isSatisfied(newVal && newVal.length >= 8) +
                        isSatisfied(newVal && /[A-z]/.test(newVal)) +
                        isSatisfied(newVal && /(?=.*\W)/.test(newVal)) +
                        isSatisfied(newVal && /\d/.test(newVal));

                    function isSatisfied(criteria) {
                        return criteria ? 1 : 0;
                    }
                }, true);
            },
            template: '<div class="progress">' +
            '<div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" style="width: {{strength >= 1 ? 25 : 0}}%"></div>' +
            '<div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" style="width: {{strength >= 2 ? 25 : 0}}%"></div>' +
            '<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" style="width: {{strength >= 3 ? 25 : 0}}%"></div>' +
            '<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: {{strength >= 4 ? 25 : 0}}%"></div>' +
            '</div>'
        }
    }
]);