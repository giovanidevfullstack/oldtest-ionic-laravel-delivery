angular.module('starter.controllers')
.controller('ClientCheckoutCtrl',[
        '$scope','$state','$cart','ClientOrderService','$ionicLoading','$ionicPopup','CupomService','$cordovaBarcodeScanner',
        function ($scope, $state, $cart, ClientOrderService, $ionicLoading, $ionicPopup, CupomService, $cordovaBarcodeScanner) {

            var cart = $cart.get();
            $scope.items = cart.items;
            $scope.total = $cart.getTotalFinal();
            $scope.cupom = cart.cupom;

            $scope.removeItem = function (i) {
                $cart.removeItem(i);
                $scope.items.splice(i, 1);
                $scope.total = $cart.getTotalFinal();
            };

            $scope.openProductDetail = function (i) {
                $state.go('client.checkout_item_detail',{index: i});
            };

            $scope.openListProducts = function () {
                $state.go('client.view_products');
            };
            
            $scope.save = function () {
                var o = {
                    items : angular.copy($scope.items)
                };

                angular.forEach(o.items, function (item) {
                   item.product_id = item.id;
                });

                if($scope.cupom.value > $scope.total){
                    $ionicPopup.alert({
                        title:   'Alerta!',
                        template: 'Valor do cupom maior que a compra!'
                    });
                    return false;
                }

                $ionicLoading.show({
                    template: 'Carregando...!'
                });

                if ($scope.cupom.value){
                    o.cupom_code = $scope.cupom.code;
                }

                ClientOrderService.save({id: null},o ,function (data) {
                    $ionicLoading.hide();
                    $state.go('client.checkout_successful');
                },function (responseError) {
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title:   'Alerta!',
                        template: 'Erro no pedido!'
                    });
                });
            };
            
            $scope.readBarCode = function () {
                $cordovaBarcodeScanner
                    .scan()
                    .then(function(barcodeData) {
                        getValueCupom(barcodeData.text);
                    }, function(error) {
                       console.log(error);
                       $ionicPopup.alert({
                           title:   'Erro!',
                           template: 'QR inválido!'
                       });
                    });
            };

            /*$scope.readBarCode = function () {
                getValueCupom('000');
            };*/

            $scope.removeCupom = function () {
                $cart.removeCupom();
                $scope.cupom = $cart.get().cupom;
                $scope.total = $cart.getTotalFinal();
            };

            function getValueCupom(code) {
                $ionicLoading.show({
                    template: 'Carregando...!'
                });
                CupomService.get({ code: code },function (data) {
                    $cart.setCupom(data.data.code, data.data.value);
                    $scope.cupom = $cart.get().cupom;
                    $scope.total = $cart.getTotalFinal();
                    $ionicLoading.hide();
                },function (E) {
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title:   'Erro!',
                        template: 'Cupom inválido!'
                    });
                    console.log('Erro' + E);
                });
            };
        }
]);
