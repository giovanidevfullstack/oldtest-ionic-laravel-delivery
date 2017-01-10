angular.module('starter.controllers')
    .controller('ClientMenuCtrl',[
        '$scope','UserService','$ionicLoading','$state',
        function ($scope, UserService, $ionicLoading, $state) {

            $scope.user = {
                name: ''
            };

            $ionicLoading.show({
                template: 'Carregando...'
            });

            UserService.authenticated({},function (data) {
                $scope.user = data.data;
                $ionicLoading.hide();
            },function (Error) {
                console.log(Error);
                $ionicLoading.hide();
            });
        }
    ]);

