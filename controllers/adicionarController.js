/*global angular, $, document, window*/

var app = angular.module('backoffice');

app.controller("AdicionarSocioController", function ($scope, $http) {
    "use strict";
    var activeSidebar = document.getElementsByClassName("nav-link active")[0],
        currentButton = document.getElementById('add');
    $scope.addObjects = {
        lines: [1],
        socios: [{}],
        show: false,
        errorMessage: "",
        dataInserted: false,
        dataError: false,
        loading: false,
        buttonsDisabled: false
    };
    activeSidebar.classList.remove('active');
    currentButton.classList.add('active');

    $scope.plusButton = function () {
        var rows = document.getElementsByClassName('socio'),
            nrows = rows.length,
            index = nrows - 1;
        rows[index].style.borderBottomStyle = 'inset';
        $scope.addObjects.show = true;
        $scope.addObjects.socios.push({});
    };

    $scope.minusButton = function () {
        var rows = document.getElementsByClassName('socio'),
            nrows = rows.length,
            index = nrows - 1,
            lastRow = rows[index];
        lastRow.remove();
        $scope.addObjects.socios.pop(index);
        rows[index - 1].style.borderBottomStyle = 'hidden';
        if (nrows <= 2) {
            $scope.addObjects.show = false;
        }
    };

    $scope.insert = function () {
        $http.post("cgi-bin/insertSocio.php", $scope.addObjects.socios)
            .then(function onSuccess() {
                    $scope.addObjects.socios = [{}];
                    $scope.addObjects.show = false;
                    $scope.addObjects.dataInserted = true;
                    $scope.addObjects.dataError = false;
                    $scope.addSocioForm.$setUntouched();
                    $scope.addSocioForm.$setPristine();
                    $scope.addObjects.loading = false;
                },
                function onError(response) {
                    $scope.addObjects.errorMessage = response.data.data;
                    $scope.addObjects.dataError = true;
                    $scope.addObjects.dataInserted = false;
                    $scope.addObjects.loading = false;
                });
    };

    $scope.addSocioRow = function () {
        $scope.expire('plus');
    };

    $scope.removeSocioRow = function () {
        $scope.expire('minus');
    };

    $scope.insertData = function () {
        $scope.expire('insert');
    };

    $scope.disableInsertButton = function () {
        $scope.addObjects.dataInserted = false;
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
                                case 'plus':
                                    $scope.plusButton();
                                    $scope.addObjects.loading = false;
                                    $scope.addObjects.buttonsDisabled = false;
                                    break;
                                case 'minus':
                                    $scope.minusButton();
                                    $scope.addObjects.loading = false;
                                    $scope.addObjects.buttonsDisabled = false;
                                    break;
                                case 'insert':
                                    $scope.insert();
                                    $scope.addObjects.loading = false;
                                    $scope.addObjects.buttonsDisabled = false;
                                    break;
                                default:
                                    $scope.addObjects.loading = false;
                                    $scope.addObjects.buttonsDisabled = false;
                                    break;
                            }
                        });
                }
            });
    };
    $scope.expire();
});

app.directive('dateDirective', function () {
    "use strict";
    return {
        require: "ng-model",
        link: function (scope, elem, attr, ngModelCtrl) {
            if ($(elem)[0].type !== 'date') {
                $(elem).datepicker({
                    dateFormat: 'dd-mm-yy'
                });
            }
            $(elem)
                .on('keyup change', function (e) {
                    var date = e.target.value,
                        splittedDate = date.split('-'),
                        pattern = /^[0-9][0-9]?-[0-9][0-9]?-[1-2][0-9][0-9][0-9]$/,
                        testDate = splittedDate[2] + '-' + splittedDate[1] + '-' + splittedDate[0];
                    if (!isNaN(Date.parse(testDate)) && pattern.test(date)) {
                        ngModelCtrl.$setViewValue(e.target.value);
                        ngModelCtrl.$setValidity('value', true);
                        scope.$apply();
                    } else {
                        ngModelCtrl.$setValidity('value', false);
                        scope.$apply();
                    }
                });
        }
    };
});

app.directive('yearDirective', function () {
    "use strict";
    return {
        require: "ng-model",
        link: function (scope, elem, attr, ngModelCtrl) {
            $(elem)
                .on('keyup change', function (e) {
                    var year = e.target.value,
                        pattern = new RegExp("^[1-2][0-9][0-9][0-9]$");
                    if (pattern.test(year) && year >= 1901 && year <= 2155) {
                        ngModelCtrl.$setValidity('year', true);
                        scope.$apply();
                    } else {
                        ngModelCtrl.$setValidity('year', false);
                        scope.$apply();
                    }
                });
        }
    };
});

app.directive('socioDirective', function () {
    "use strict";
    return {
        require: "ng-model",
        link: function (scope, elem, attr, ngModelCtrl) {
            $(elem)
                .on("keyup change", function (e) {
                    var socio = e.target.value,
                        pattern = /^[1-9][0-9]*$/;
                    if (pattern.test(socio)) {
                        ngModelCtrl.$setValidity('socio', true);
                        scope.$apply();
                    } else {
                        ngModelCtrl.$setValidity('socio', false);
                        scope.$apply();
                    }
                });
        }
    };
});
