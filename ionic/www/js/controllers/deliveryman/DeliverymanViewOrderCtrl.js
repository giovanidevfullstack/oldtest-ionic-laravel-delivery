angular.module('starter.controllers')
    .controller('DeliverymanViewOrderCtrl',[
        '$scope','DeliverymanOrderService','$ionicLoading','$stateParams','$cordovaGeolocation','$ionicPopup',
        function ($scope, DeliverymanOrderService, $ionicLoading, $stateParams, $cordovaGeolocation, $ionicPopup) {
            var watch, lat = null, long;

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
                $ionicLoading.hide();
            });

            $scope.goToDelivery = function () {
                $ionicPopup.alert({
                   title: 'Alerta',
                   template: 'Parar localização?'
                }).then(function () {
                    stopWatchPosition();
                });

                DeliverymanOrderService.updateStatus({id: $stateParams.id}, {status: 1}, function () {
                   var watchOptions = {
                       timeout: 3000,
                       enableHighAccuracy: false
                   };

                   watch = $cordovaGeolocation.watchPosition(watchOptions);
                   watch.then(null,
                       function (responseError) {
                           //error
                       },
                       function (position) {
                           if(!lat){
                               lat = position.coords.latitude;
                               long = position.coords.longitude;
                           }else{
                               long -= 0.0444;
                           }
                           DeliverymanOrderService.geo({id: $stateParams.id},{
                              lat:  lat,
                              long: long
                           });
                       });
                });
            };

            $scope.endDelivery = function () {
                DeliverymanOrderService.updateStatus({id: $stateParams.id}, {status: 2}, function () {
                    stopWatchPosition();
                });
            };

            function stopWatchPosition() {
                if(watch && typeof watch == 'object' && watch.hasOwnProperty('watchID')){
                    $cordovaGeolocation.clearWatch(watch.watchID);
                }
            }
        }
    ]);

