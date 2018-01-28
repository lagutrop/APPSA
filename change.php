<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 27-01-2018
 * Time: 17:10
 */
include_once("validation.php");
privatePage();
?>
<div class="jumbotron title-text">
    <h1 class="text-center">Mudar Password</h1>
</div>
<div class="alert alert-success alert-dismissible fade show" role="alert" ng-show="addObjects.secretChanged">
    <button type="button" ng-click="disableSubmitButton()" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Senha alterada com sucesso</strong>
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
<div class="container-fluid">
    <form id="senhaForm" class="changeForm" name="senhaForm" method="post" role="form" novalidate>
        <div class="form-group">
            <label for="senhaAtual" class="label">Senha Atual</label>
            <input id="senhaAtual" type="password" name="senhaAtual" placeholder="Introduza a sua senha atual"
                   ng-model="addObjects.senhaAtual" required>
        </div>
        <div class="form-group">
            <label for="senhaNova" class="label">Senha Nova</label>
            <div class="tip">
                Para garantir a sua segurança introduza uma senha com mais de 7 caracteres, com letras
                maiúsculas, letras minúsculas, caracteres especiais e números.
            </div>
            <input id="senhaNova" name="senhaNova" type="password" placeholder="Introduza a senha que pretenda"
                   ng-model="addObjects.senhaNova" senha-directive required>
        </div>
        <div class="form-group">
            <label for="senhaConfirm" class="label">Confirmação da senha</label>
            <input id="senhaConfirm" type="password" name="senhaConfirm" placeholder="Confirma a senha pretendida"
                   ng-model="addObjects.senhaConfirmation" watcher="senhaNova" senha-confirmation-directive required>
        </div>
        <div class="form-group">
            <label class="label">Segurança da Password</label>
            <strength ng-model="addObjects.senhaNova"></strength>
        </div>
        <div class="text-right">
            <button id="submeterAdicionar" type="submit" class="btn btn-success btn-lg"
                    ng-disabled="senhaForm.$invalid || addObjects.buttonsDisabled" ng-click="submitData()">Alterar senha
            </button>
        </div>
    </form>
</div>