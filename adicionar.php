<?php
include_once("validation.php");
privatePage();
?>
<div class="jumbotron title-text">
    <h1 class="text-center">Adicionar Sócio</h1>
</div>
<div class="alert alert-success alert-dismissible fade show" role="alert" ng-show="addObjects.dataInserted">
    <button type="button" ng-click="disableInsertButton()" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Sócio(s) inserido(s) com sucesso</strong>
</div>
<div class="spinner">
    <i ng-show="addObjects.loading" class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
    <span class="sr-only">Loading...</span>
</div>
<div class="alert alert-danger alert-dismissible fade show" role="alert" ng-show="addObjects.dataError">
    <button type="button" ng-click="disableErrorButton()" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{addObjects.errorMessage}}</strong>
</div>
<div>
    <form id="addForm" class="form-horizontal" name="addSocioForm" method="post" novalidate>
        <div class="row nomargin">
            <div class="addRow col-md-12">
                <button type="button" ng-disabled="addObjects.buttonsDisabled"
                        class="btn btn-success btn-number buttonRow" data-type="plus" ng-click="addSocioRow()">
                    <i class="fa fa-plus"></i>
                </button>
                <button id="deleteRow" ng-disabled="addObjects.buttonsDisabled" ng-show="addObjects.show" type="button"
                        class="btn btn-danger btn-number buttonRow" data-type="minus" ng-click="removeSocioRow()">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="row nomargin socio" ng-repeat="socio in addObjects.socios">
            <div class="form-group text-center col-sm-12 col-md-4">
                <label class="addLabel">Número de sócio</label>
                <input class="col-sm-12 col-md-10" type="number" name="socio" placeholder="Socio nº"
                       ng-model="addObjects.socios[$index].socio" socio-directive required>
            </div>
            <div class="form-group text-center col-sm-12 col-md-4">
                <label class="addLabel">Data de pagamento</label>
                <input class="col-sm-12 col-md-10 adicionar payment" name="payment" type="text" placeholder="dd-mm-aaaa"
                       ng-model="addObjects.socios[$index].data" date-directive required>
            </div>
            <div class="form-group text-center col-sm-12 col-md-4">
                <label class="addLabel">Ano da quota</label>
                <input class="col-sm-12 col-md-10" type="number" name="quota" placeholder="aaaa"
                       ng-model="addObjects.socios[$index].quota" year-directive required>
            </div>
        </div>
        <div class="row nomargin">
            <div class="col text-right">
                <button id="submeterAdicionar" type="submit" class="btn btn-success btn-lg"
                        ng-disabled="addSocioForm.$invalid || addObjects.buttonsDisabled" ng-click="insertData()">
                    Adicionar sócio(s)
                </button>
            </div>
        </div>
    </form>
</div>