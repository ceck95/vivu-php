/**
 * Created At 1/1/17.
 */
(function () {
    angular.module('app').service('DesignProductService', function ($http) {
        this.getRelationalDataOfDesignProduct = function (productId) {
            return $http({
                method: 'GET',
                url: '/design-product/get-relational-data?productUrl=' + productId
            }).then(function success(res) {
                return res.data;
            }, function err(res) {
                return false;
            })
        }
    })
})();