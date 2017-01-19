angular.module('starter.controllers')
    .controller('ClientViewOrderCtrl',[
        '$scope', '$stateParams', 'OrderService', '$ionicLoading',
        function ($scope, $stateParams, OrderService, $ionicLoading) {
            $scope.order = {};

            $ionicLoading.show({
                template: 'Carregando...'
            });

            OrderService.get({
                id: $stateParams.id,
                include: "items,cupom"
            }, function (data) {
                $scope.order = data.data;
                $ionicLoading.hide();
            },function (error) {
                $ionicLoading.hide();
            });
        }
    ]);