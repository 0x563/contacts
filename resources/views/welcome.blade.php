@extends('layout')
@section('content')

<div class="panel panel-primary" ng-controller="contactsCtrl">
    <div class="panel-heading">+ Lista de contactos +</div>
    <div class="panel-body">
        <div class="row">
            <form method="GET">
                <div class="col-md-2">Nombre:</div>
                <div class="col-md-2">
                    <input
                        type="text"
                        class="form-control"
                        ng-change='search(1)'
                        ng-model='nameSearch'
                        autofocus>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-2">Rut:</div>
                <div class="col-md-2">
                    <input
                        type="text"
                        class="form-control"
                        ng-change='search(1)'
                        ng-model='rutSearch'>
                </div>
            </form>
        </div>
        <div class="row">
            <div class='text-danger'><% errorMessage %></div>
        </div>
        <div class='row' ng-show='nameSearch || rutSearch'>
            <div class='col-md-6'>
                <h3>Filtrado por: <% nameSearch %> <% rutSearch %> </h3>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Rut</th>
                    </tr>
                </thead>
                <tbody ng-repeat='contact in contacts'>
                    <tr>
                        <td><% contact.name %></td>
                        <td><% contact.rut %></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <ul class="pagination">
            <li ng-class="{disabled:currentPage == 1}">
                <a ng-click="changePage(1)">&laquo;</a>
            </li>
            <li ng-class="{disabled:currentPage == 1}">
                <a ng-click="changePage(currentPage - 1)"><</a>
            </li>
            <li ng-hide="page == 0 || page > totalPages" ng-repeat='page in pages' ng-class="{active:currentPage == page}">
                <a ng-click="changePage(page)"><% page %></a>
            </li>
            <li ng-class="{disabled:currentPage == totalPages}">
                <a ng-click="changePage(currentPage + 1)">></a>
            </li>
            <li ng-class="{disabled:currentPage == totalPages}">
                <a ng-click="changePage(totalPages)">&raquo;</a>
            </li>
        </ul>
    </div>
</div>

@endsection

@section('scripts')
<script>
    var app = angular.module("contactsApp", [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    app.controller('contactsCtrl', ["$scope", "$http", function ($scope, $http) {
        $scope.currentPage  = 1;
        $scope.totalPages   = 1;
        $scope.nameSearch   = '';
        $scope.rutSearch    = '';
        $scope.contacts     = [];
        $scope.pages        = [];
        $scope.errorMessage = "";

        $scope.search = function (page) {
            $http.get("/api/v1/contacts", {
                params: {
                    name: $scope.nameSearch,
                    rut : $scope.rutSearch,
                    page: page
                }
            }).success(function (data) {
                $scope.contacts    = data.data;
                $scope.currentPage = data.current_page;
                $scope.totalPages  = data.last_page;
                $scope.pages = _.range($scope.currentPage - 1, $scope.currentPage + 4);
                $scope.errorMessage = "";
            }).error(function (err) {
                $scope.errorMessage = "Error de conexion!";
            });
        };

        $scope.changePage = function (page) {
            $scope.currentPage = page;
            $scope.search(page);
        };

        $scope.search(1);
    }]);

</script>
@endsection