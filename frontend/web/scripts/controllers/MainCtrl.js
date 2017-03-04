(function () {
    angular.module('app').controller('MainCtrl', function ($scope, CommonService, $cookieStore, $rootScope) {

        $scope.CommonService = CommonService;


        $scope.$watch('CommonService.getDataHeaderFooter()', (data) => {
            $scope.pagePartials = data;
        });

        $scope.$watch('CommonService.getBreadCrumbs()', (data) => {
            $scope.breadCrumbs = data;
        });

        $scope.$watch('CommonService.getCurrentCart()', (dataCart) => {

            if (dataCart !== undefined) {
                $scope.dataCart = dataCart;
            }

        });

        $scope.$watch('CommonService.getShowCartQuickView()', (value) => {

            if (value === true) {
                $scope.showQuickCart = true;
                CommonService.toggleCartQuickView();
            }

        });

        $scope.linkCdn = PARAMS_CONF.cdnLink;

        $scope.truncateProduct = PARAMS_CONF.truncateProduct;

        CommonService.getPagePartials();

        $rootScope.sumPriceCart = () => {

            let totalPrice = 0;

            $scope.dataCart.forEach(e => {

                totalPrice += e.base_price * e.qty;

            });
            return totalPrice;

        };

        $scope.removeProduct = (itemCart) => {
            CommonService.removeItemCart(itemCart);
        };

        $scope.handleHeader = (text) => {

            if (text === 'border') {

                $scope.showQuickCart = true;

            } else if (text === 'in') {

                $scope.showQuickCart = false;

            }

        };

        let handleQuoteCurrent = () => {

            CommonService.getQuoteCurrent($cookieStore.get(PARAMS_CONF.cookieName)).then(data => {

                if (data.quote.new) {
                    $cookieStore.put(PARAMS_CONF.cookieName, data.quote.id);
                }

                $rootScope.quoteId = data.quote.id;
                CommonService.getAllItem($rootScope.quoteId).then(data => {

                    $rootScope.dataItem = data.quoteItem;

                });

            });

        };

        handleQuoteCurrent();

    });
})();