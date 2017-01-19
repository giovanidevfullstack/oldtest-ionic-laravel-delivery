angular.module('starter.controllers')
    .controller('DeliverymanMenuCtrl',[
        '$scope','UserService','$ionicLoading','$state',
        function ($scope, UserService, $ionicLoading, $state) {
            $scope.user = {
                name: ''
            };

            $ionicLoading.show({
                template: 'Carregando...'
            });
        }
    ]);

