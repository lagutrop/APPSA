var app = angular.module('backoffice');

app.controller("AdicionarSocioController", function ($scope) {
	var activeSidebar = document.getElementsByClassName("nav-link active")[0],
		currentButton = document.getElementById('add');
    $scope.addObjects = {lines: [1], socios: [{}], show: false, errorMessage: "", dataInserted: false, dataError: false};
	activeSidebar.classList.remove('active');
	currentButton.classList.add('active');
});

app.controller("submitSocioController", function ($scope, $http) {
	$scope.addSocioRow = function () {
		var rows = document.getElementsByClassName('socio'),
			nrows = rows.length,
			lastRow = rows[nrows - 1];
		$scope.addObjects.show = true;
	$scope.addObjects.socios.push({});
	};
	
	$scope.removeSocioRow = function () {
		var rows = document.getElementsByClassName('socio'),
			nrows = rows.length,
			lastRow = rows[nrows - 1];
		lastRow.remove();
		$scope.addObjects.socios.pop(nrows - 1);
		if (nrows <= 2) {
			$scope.addObjects.show = false;
		}
	};
	
	$scope.insertData = function () {
		$http.post("cgi-bin/insertSocio.php", $scope.addObjects.socios)
            .then(function onSuccess(data) {
                $scope.addObjects.socios = [{}];
                $scope.addObjects.show = false;
                $scope.addObjects.dataInserted = true;
                $scope.addObjects.dataError = false;
                $scope.addSocioForm.$setUntouched();
                $scope.addSocioForm.$setPristine();
            })
            .catch(function onError(response) {
                $scope.addObjects.errorMessage = response.data.data;
                $scope.addObjects.dataError = true;
                $scope.addObjects.dataInserted = false;
            });
	};
    
    $scope.disableInsertButton = function () {
        $scope.addObjects.dataInserted = false;
    };
    
    $scope.disableErrorButton = function () {
        $scope.addObjects.dataError = false;
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
	return {
		require: "ng-model",
		link: function(scope, elem, attr, ngModelCtrl) {
			$(elem)
			.on("keyup change", function(e) {
				var socio = e.target.value,
					pattern = /^[[1-9][0-9]*$/;
				if(pattern.test(socio)) {
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