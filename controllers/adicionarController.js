var app = angular.module('backoffice');

app.controller("AdicionarSocioController", function ($scope) {
	var activeSidebar = document.getElementsByClassName("nav-link active")[0],
		currentButton = document.getElementById('add');
	$scope.lines = [1];
	$scope.socios = [{}];
	$scope.show = false;
	$scope.dataInserted = false;
	activeSidebar.classList.remove('active');
	currentButton.classList.add('active');
});

app.controller("submitSocioController", function ($scope, $http) {
	$scope.addSocioRow = function () {
		var rows = document.getElementsByClassName('socio'),
			nrows = rows.length,
			lastRow = rows[nrows - 1];
		$scope.show = true;
	$scope.socios.push({});
	};
	
	$scope.removeSocioRow = function () {
		var rows = document.getElementsByClassName('socio'),
			nrows = rows.length,
			lastRow = rows[nrows - 1];
		lastRow.remove();
		$scope.socios.pop(nrows - 1);
		if (nrows <= 2) {
			$scope.show = false;
		}
	};
	
	$scope.insertData = function () {
		$http.post("insertSocio.php", $scope.socios)
		.success(function(data, status, headers, config) {
			$scope.dataInserted = true;
		})
	};
});

app.directive('dateDirective', function () {
	return {
		require: "ng-model",
		link: function(scope, elem, attr, ngModelCtrl) {
			if ($(elem)[0].type !== 'date') {
				$(elem).datepicker({dateFormat: 'dd-mm-yy'});
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
	return {
		require: "ng-model",
		link: function(scope, elem, attr, ngModelCtrl) {
			$(elem)
			.on('keyup change', function (e) {
				var year = e.target.value,
					pattern = new RegExp("^[1-2][0-9][0-9][0-9]$");
				if (pattern.test(year)) {
					ngModelCtrl.$setValidity('year', true);
					scope.$apply();
				} else {
					ngModelCtrl.$setValidity('year', false);
					scope.$apply();
				}
			})
		}
	}
});

app.directive('socioDirective', function () {
	return {
		require: "ng-model",
		link: function(scope, elem, attr, ngModelCtrl) {
			$(elem)
			.on("keyup change", function(e) {
				var socio = e.target.value,
					pattern = /^[[1-9][0-9]*$/;
				if(pattern.test(socio)) {
					console.log("test1");
					ngModelCtrl.$setValidity('socio', true);
					scope.$apply();
				} else {
					console.log("test2");
					ngModelCtrl.$setValidity('socio', false);
					scope.$apply();
				}
			})
		}
	}
})