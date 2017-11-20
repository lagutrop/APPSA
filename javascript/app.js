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
							contr.$setValidity('val', true);
							scope.table = response.data;
						} else {
							contr.$setValidity('val', false);
							scope.table = "O numero ou nome de socio introduzido nao e valido";
						}
					})
					.catch(function () {
						contr.$setValidity('val', false);
						scope.table = "O numero ou nome de socio introduzido nao e valido";
					});
				return value;
			}
			contr.$parsers.push(bdValidation);
		}
	};
});