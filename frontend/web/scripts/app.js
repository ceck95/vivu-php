(function () {
    angular.module('app', [
        'ngCookies',
        'ngRoute',
        'ngAnimate',
        'ngSanitize',
        'ngRoute',
        'angular-nicescroll',
        'angular-click-outside',
        'truncate'
    ]).config(($routeProvider, $httpProvider) => {

        $routeProvider
            .when('/:classify', {
                templateUrl: 'views/product/product-list.html',
                controller: 'ProductCtrl',
                controllerAs: 'product',
                reloadOnSearch: false
            })
            .when('/category/:categoryUrl', {
                templateUrl: 'views/product/product-list.html',
                controller: 'ProductCtrl',
                controllerAs: 'product',
                reloadOnSearch: false
            })
            .when('/product/:productUrl', {
                templateUrl: 'views/product/product-detail.html',
                controller: 'ProductDetailCtrl',
                controllerAs: 'productDetail',
                reloadOnSearch: false
            })
            .when('/design-product/:productUrl', {
                templateUrl: 'views/design-product/design.html',
                controller: 'DesignProductCtrl',
                controllerAs: 'designProduct',
                reloadOnSearch: false
            })
            .when('/cart/view', {
                templateUrl: 'views/cart/cart-view.html',
                controller: 'CartCtrl',
                controllerAs: 'cartProduct',
                reloadOnSearch: false
            })
            .otherwise({
                redirectTo: '/'
            });

        $httpProvider.defaults.headers.post['X-CSRF-Token'] = $('meta[name="csrf-token"]').attr("content");
        $httpProvider.defaults.headers.common['Content-Type'] = 'application/json';

    }).run(function ($rootScope, $location, $anchorScroll, $window) {

        $rootScope.$on('$routeChangeSuccess', (event, toState) => {
            $window.scrollTo(0, 0);
        });
    });
})();
