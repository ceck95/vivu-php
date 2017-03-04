(function () {
    angular.module('app').controller('DesignProductCtrl', function (DesignProductService, $scope, $routeParams, $window) {
        let getRelationalDataOfDesignProduct = () => {
            if ($routeParams.productUrl) {
                DesignProductService.getRelationalDataOfDesignProduct($routeParams.productUrl).then((relationalData) => {
                    $scope.designProductRelationData = relationalData;
                });
                $scope.$parent.breadCrumbs = {
                    'list': [
                        {
                            'name': $routeParams.productUrl,
                            'link': '#/product/' + $routeParams.productUrl
                        }
                    ],
                    'textTitle': 'Design ' + $routeParams.productUrl
                };
                $window.document.title = 'Design ' + $routeParams.productUrl;
            }
        };

        getRelationalDataOfDesignProduct();
    });
})();
