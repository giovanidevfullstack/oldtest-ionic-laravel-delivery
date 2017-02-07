angular.module('starter.controllers')
    .controller('DeliverymanViewOrderCtrl',[
        '$scope','DeliverymanOrderService','$ionicLoading','$stateParams','$cordovaGeolocation','$ionicPopup',
        function ($scope, DeliverymanOrderService, $ionicLoading, $stateParams, $cordovaGeolocation, $ionicPopup) {
            var watch;

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
                    stopWatcPosition();
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
                           DeliverymanOrderService.geo({id: $stateParams.id},{
                              lat:  position.coords.latitude,
                              long: position.coords.longitude
                           });
                       });
                });
            };
            
            function stopWatcPosition() {
                if(watch && typeof watch == 'object' && watch.hasOwnProperty('watchID')){
                    $cordovaGeolocation.clearWatch(watch.watchID);
                }
            }
        }
    ]);

