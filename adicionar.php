<?php
include("validation.php");
privatePage();
?>
<div class="jumbotron text-center">
	<h1>Adicionar Socio</h1>
</div>
<div>
	<form id="addForm" name="addSocioForm" ng-controller="submitSocioController" method="post" novalidate>
		<div class="row nomargin">
			<div class="addRow col-md-12">
				<button type="button" class="btn btn-success btn-number buttonRow" data-type="plus" ng-click="addSocioRow()">
					<i class="fa fa-plus"></i>
				</button>
				<button id="deleteRow" ng-show="show" type="button" class="btn btn-danger btn-number buttonRow" data-type="minus" ng-click="removeSocioRow()">
					<i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="socio row nomargin" ng-repeat="socio in socios">
			<div class="col-md-4 text-center">
				<label class="addLabel">Numero de socio</label>
				<input type="number" name="socio" placeholder="Socio nº" ng-model="socios[$index].socio" socio-directive required>
			</div>
			<div class="col-md-4 text-center">
				<label class="addLabel">Data de pagamento</label>
				<input class="adicionar payment" name="payment" type="text" placeholder="dd-mm-aaaa" ng-model="socios[$index].data" date-directive required>
			</div>
			<div class="col-md-4 text-center">
				<label class="addLabel">Ano da quota</label>
				<input type="number" name="quota" placeholder="aaaa" ng-model="socios[$index].quota" year-directive required>
			</div>
		</div>
		<div class="row nomargin">
			<div class="col text-right">
				<button id="submeterAdicionar" type="submit" class="btn btn-success btn-lg" ng-disabled="addSocioForm.$invalid" ng-click="insertData()">Adicionar socio</button>	
			</div>
		</div>
	</form>
</div>