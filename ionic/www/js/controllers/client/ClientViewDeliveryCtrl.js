angular.module('starter.controllers')
    .controller('ClientViewDeliveryCtrl',[
        '$scope', '$stateParams', 'ClientOrderService', '$ionicLoading','$ionicPopup','UserData',
        function ($scope, $stateParams, ClientOrderService, $ionicLoading,$ionicPopup, UserData) {
            $scope.order = {};
            $scope.markers = [];
            $scope.map = {
                center:{
                    latitude:  -30.060113,
                    longitude: -51.2125218
                },
                zoom: 14
            };

            $ionicLoading.show({
                template: 'Carregando...'
            });

            ClientOrderService.get({id: $stateParams.id, include: "items, cupom"},function (data) {
                $scope.order = data.data;
                $ionicLoading.hide();
                if(parseInt($scope.order.status,10) == 1){
                    initMarkers();
                }else{
                    $ionicPopup.alert({
                        title: "Alerta",
                        template: "Pedido não está em entrega"
                    });
                }
            },function (error) {
                $ionicLoading.hide();
            });

            function initMarkers() {
                var client  = UserData.get().client.data;
                var address = client.zipcode + ', ' +
                              client.address + ', ' +
                              client.city    + '- ' +
                              client.state;
                createMarkerClient(address);
            }
            
            function createMarkerClient(address) {
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    address: address
                },function (results, status) {
                    if(status == google.maps.GeocoderStatus.OK){
                        var lat  = results[0].geometry.location.lat();
                        var long = results[0].geometry.location.lng();

                        $scope.markers.push({
                            id: 'client',
                            coords: {
                                latitude: lat,
                                longitude: long
                            },
                            options:{
                                title: "local de entrega"
                            }
                        });
                    }else{
                        $ionicPopup.alert({
                            title: "Alerta",
                            template: "Não foi possível localizar seu endereço"
                        });
                    }
                });

            }
        }
    ]);