angular.module('starter.controllers')
    .controller('DeliverymanOrderCtrl',[
        '$scope','DeliverymanOrderService','$ionicLoading','$state',
        function ($scope, DeliverymanOrderService, $ionicLoading, $state) {
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
                $state.go('deliveryman.view_order',{id: o.id});
            };

            function getOrders() {
                return DeliverymanOrderService.query({
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

