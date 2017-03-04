(function () {
    angular.module('app').factory('QuantityFactory', function () {
        return ({
            clickToggleQuantity: (click, $scope) => {
                if (click === 'outSide') {
                    if ($scope.viewQuantity) {
                        $scope.viewQuantity = false;
                    }
                    return;
                }
                if ($scope.viewQuantity) {
                    $scope.viewQuantity = false;
                } else {
                    $scope.viewQuantity = true;
                }
            },
            initListQuantity: ($scope) => {
                let list = [];
                for (let i = 1; i <= 25; i++) {
                    if (i == 1) {
                        list.push({quantity: i, selected: true});
                        $scope.selectedQuantity = 1;
                    } else {
                        list.push({quantity: i, selected: false});
                    }
                }
                $scope.selectedProductColor = 0;
                $scope.listQuantity = list;
                $scope.priceCurrent = null;
            },
            selectQuantity: (item, $scope) => {
                for (let i = 1; i < $scope.listQuantity.length; i++) {
                    if (i === item.quantity) {
                        $scope.listQuantity[i - 1].selected = true;
                        $scope.selectedQuantity = $scope.listQuantity[i - 1].quantity;
                    } else {
                        $scope.listQuantity[i - 1].selected = false;
                    }
                    $scope.viewQuantity = false;
                }
            },
            zoomHandle: ($scope) => {
                if ($scope.zoom) {
                    $scope.zoom = false;
                    return;
                }
                $scope.zoom = true;
            },
            handleDataProduct: (product, indexProductColor,listColor,$scope,$rootScope) => {
                let dataProduct = {};
                dataProduct.base_price = parseInt(product.base_price) + parseInt(listColor[indexProductColor].price);

                dataProduct.product = {
                    url_key: product.url_key,
                    name: product.name,
                    sku: product.sku
                };

                dataProduct.quote_id = $rootScope.quoteId;
                dataProduct.product_id = product.id;


                dataProduct.selected_product_color_id = listColor[indexProductColor].id;
                dataProduct.product_color = {
                    color_name: listColor[indexProductColor].color_name,
                    refer_product_image_path: listColor[indexProductColor].refer_product_image_path
                };

                dataProduct.qty = $scope.selectedQuantity;

                return dataProduct;
            }
        });
    });
})();