var app = angular.module('backoffice');

app.controller("AdicionarSocioController", function ($scope) {
	var activeSidebar = document.getElementsByClassName("nav-link active")[0],
		currentButton = document.getElementById('add');
	$scope.nRows = document.getElementsByTagName("row-directive").length;
	$scope.socios = [];
	activeSidebar.classList.remove('active');
	currentButton.classList.add('active');
	if ($('#payment')[0].type !== 'date') {
		$('#payment').datepicker({dateFormat: 'dd/mm/yy'});
	}
});

app.controller("submitSocioController", function ($scope, $compile) {
	$scope.addSocioRow = function () {
		var socios = document.getElementsByTagName('row-directive'),
			nrows = socios.length,
			lastRow = socios[nrows - 1],
			newRow = document.createElement('row-directive'),
			minusButton = document.getElementById("deleteRow");
		$compile(newRow);
		lastRow.parentNode.insertBefore(newRow, lastRow.nextSibling);
		$scope.nRows = document.getElementsByTagName("row-directive").length;	
	};
	
	$scope.removeSocioRow = function () {
		var socios = document.getElementsByTagName('row-directive'),
			nrows = socios.length,
			lastRow = socios[nrows - 1],
			minusButton = document.getElementById("deleteRow");
		lastRow.remove();
		$scope.nRows = document.getElementsByTagName("row-directive").length;	
	};
	
	$scope.insertData = function () {
			
	};
});

app.directive('rowDirective', function () {
	return {
		template:'<div class="socio row nomargin"><div class="col-md-4 text-center"><label class="addLabel">Numero de socio</label><input type="number" placeholder="Socio nº" required></div><div class="col-md-4 text-center"><label class="addLabel">Data de pagamento</label><input class="adicionar" id="payment" type="date" placeholder="dd-mm-aaaa" ng-model="socios[nRows]" required></div><div class="col-md-4 text-center"><label class="addLabel">Ano da quota</label><input type="number" placeholder="aaaa" required></div></div>',
	};
});