var app = angular.module('myApp', []);

app.directive('formDirective', function ($http) {
	return {
		require: 'ngModel',
		link: function (scope, element, attr, contr) {
			function bdValidation(value) {
				var url = "http://localhost/appsa/app/socio/" + value;
				$http.get(url)
					.then(function (response) {
						if (response.data.length > 0) {
                            console.log(response.data);
                            scope.isSocio = "Parabéns, as quotas do ano corrente estão pagas! Obrigado por contribuires para esta causa.";
							contr.$setValidity('val', true);
						} else {
							contr.$setValidity('val', false);
                            scope.isSocio = "Lamentamos, mas as quotas do ano corrente ainda não estão pagas.";
						}
					})
					.catch(function () {
						contr.$setValidity('val', false);
						scope.isSocio = "Lamentamos, mas as quotas do ano corrente ainda não estão pagas.";
					});
				return value;
			}
			contr.$parsers.push(bdValidation);
		}
	};
});