/*global angular, $, document, window*/

var app = angular.module('myApp', []);

app.directive('formDirective', function ($http) {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, contr) {
            function validateSocio(valid) {
                scope.loading = false;
                scope.valid = valid;
                contr.$setValidity('notFound', valid);
                contr.$setValidity('val', true);
            }

            function bdValidation(value) {
                scope.loading = false;
                scope.valid = true;
                if (value === null) {
                    value = '0';
                }
                // Server URL
                var url = "http://81.193.18.193/appsa/app/socio/" + value;
                contr.$setValidity('val', false);
                scope.loading = true;
                $http.get(url)
                    .then(
                        function (response) {
                            if (response.data.length > 0) {
                                scope.isSocio = "Parabéns, as quotas do ano corrente estão pagas! Obrigado por contribuir para esta causa.";
                                validateSocio(true);
                            } else {
                                scope.isSocio = "Lamentamos, mas as quotas do ano corrente ainda não estão pagas. Envie-nos um email para regularizar.";
                                validateSocio(false);
                            }
                        },
                        function () {
                            scope.isSocio = "Lamentamos, mas as quotas do ano corrente ainda não estão pagas.";
                            validateSocio(false);
                        });
                return value;
            }

            contr.$parsers.push(bdValidation);
        }
    };
});