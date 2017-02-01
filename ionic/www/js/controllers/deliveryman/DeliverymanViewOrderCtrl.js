angular.module('starter.controllers')
    .controller('DeliverymanViewOrderCtrl',[
        '$scope','DeliverymanOrderService','$ionicLoading','$stateParams',
        function ($scope, DeliverymanOrderService, $ionicLoading, $stateParams) {
            $scope.order = {};

            $ionicLoading.show({
                template: 'Carregando...'
            });

            DeliverymanOrderService.get({
                id: $stateParams.id,
                include: "items,cupom"
            }, function (data) {
                $scope.order = data.data;
                $ionicLoading.hide();
            },function (error) {
                console.debug(error);
                $ionicLoading.hide();
            });
        }
    ]);

