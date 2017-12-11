<?php
include("validation.php");
privatePage();
?>
<div class="wrapper" ng-controller="submitSocioController">
<div class="jumbotron text-center">
	<h1>Adicionar Sócio</h1>
</div>
<div class="alert alert-success alert-dismissible fade show" role="alert" ng-show="addObjects.dataInserted">
    <button type="button" ng-click="disableInsertButton()" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Sócios inseridos com sucesso</strong>
</div>
<div class="alert alert-danger alert-dismissible fade show" role="alert" ng-show="addObjects.dataError">
    <button type="button" ng-click="disableErrorButton()" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{addObjects.errorMessage}}</strong>
</div>
<div>
	<form id="addForm" name="addSocioForm" method="post" novalidate>
		<div class="row nomargin">
			<div class="addRow col-md-12">
				<button type="button" class="btn btn-success btn-number buttonRow" data-type="plus" ng-click="addSocioRow()">
					<i class="fa fa-plus"></i>
				</button>
				<button id="deleteRow" ng-show="addObjects.show" type="button" class="btn btn-danger btn-number buttonRow" data-type="minus" ng-click="removeSocioRow()">
					<i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
		<div class="socio row nomargin" ng-repeat="socio in addObjects.socios">
			<div class="col-md-4 text-center">
				<label class="addLabel">Número de sócio</label>
				<input type="number" name="socio" placeholder="Socio nº" ng-model="addObjects.socios[$index].socio" socio-directive required>
			</div>
			<div class="col-md-4 text-center">
				<label class="addLabel">Data de pagamento</label>
				<input class="adicionar payment" name="payment" type="text" placeholder="dd-mm-aaaa" ng-model="addObjects.socios[$index].data" date-directive required>
			</div>
			<div class="col-md-4 text-center">
				<label class="addLabel">Ano da quota</label>
				<input type="number" name="quota" placeholder="aaaa" ng-model="addObjects.socios[$index].quota" year-directive required>
			</div>
		</div>
		<div class="row nomargin">
			<div class="col text-right">
				<button id="submeterAdicionar" type="submit" class="btn btn-success btn-lg" ng-disabled="addSocioForm.$invalid" ng-click="insertData()">Adicionar sócio</button>	
			</div>
		</div>
	</form>
</div>
</div>