angular.module('starter.controllers')
    .controller('ClientViewOrderCtrl',[
        '$scope', '$stateParams', 'ClientOrderService', '$ionicLoading',
        function ($scope, $stateParams, ClientOrderService, $ionicLoading) {
            $scope.order = {};

            $ionicLoading.show({
                template: 'Carregando...'
            });

            ClientOrderService.get({
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