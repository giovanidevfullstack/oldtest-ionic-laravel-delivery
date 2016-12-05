angular.module('starter.controllers')
    .controller('LoginCtrl',[
        '$scope',
        'OAuth',
        '$state',
        '$ionicPopup',
        '$localStorage',function ($scope, OAuth, $state, $ionicPopup, $localStorage) {

            $scope.user = {
                username: '',
                password: ''
            };

            $scope.login = function () {
                OAuth.getAccessToken($scope.user)
                    .then(function (data) {
                        $localStorage.set('TOKEN',data.data.access_token);
                        console.log("LOCALSTORAGE TOKEN DO USER AUTH -> " + $localStorage.get('TOKEN'));
                        $state.go('home');
                    },function (ResponseError) {
                        $ionicPopup.alert({
                            title:   'Alert',
                            template: 'Login e/ou senha inválidos'
                        });
                    });
            }
        }]);