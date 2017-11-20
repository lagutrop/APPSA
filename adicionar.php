<?php
include("validation.php");
privatePage();
?>
<div class="jumbotron text-center">
	<h1>Adicionar Socio</h1>
</div>
<div>
	<form id="addForm" ng-controller="submitSocioController">
		<div class="row nomargin">
			<div class="addRow col-md-12">
				<button type="button" class="btn btn-success btn-number buttonRow" data-type="plus" ng-click="addSocioRow()">
					<i class="fa fa-plus"></i>
				</button>
				<button id="deleteRow" ng-show="nRows > 1" type="button" class="btn btn-danger btn-number buttonRow" data-type="minus" ng-click="removeSocioRow()">
					<i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
		<row-directive></row-directive>
	</form>
</div>