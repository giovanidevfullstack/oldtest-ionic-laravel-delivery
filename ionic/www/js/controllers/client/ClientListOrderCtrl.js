angular.module('starter.controllers')
    .controller('ClientListOrderCtrl',[
        '$scope', '$state', 'ClientOrderService', '$ionicLoading',
        function ($scope, $state, ClientOrderService, $ionicLoading) {
            $scope.items = [];

            $ionicLoading.show({
                template: 'Carregando...'
            });

            $scope.doRefresh = function () {
                getOrders().then(function (data) {
                    $scope.items = data.data;
                    $scope.$broadcast('scroll.refreshComplete');
                },function () {
                    $scope.$broadcast('scroll.refreshComplete');
                });
            };

            $scope.openOrderDetail = function (o) {
                $state.go('client.view_order',{id: o.id});
            };

            function getOrders() {
                return ClientOrderService.query({
                    id: null,
                    orderBy: 'created_at',
                    sortedBy: 'desc'
                }).$promise;
            };

            getOrders().then(function (data) {
                $scope.items = data.data;
                $ionicLoading.hide();
            },function (error) {
                $ionicLoading.hide();
            });
        }
    ]);