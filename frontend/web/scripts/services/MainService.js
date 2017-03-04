(function () {
    angular.module('app').service('MainService', function ($http) {
        this.requestBaseParams = function ($scope) {
            $http({
                method: "get",
                url: '/site/get-base-params/',
                dataType: 'json'
            }).then(function success(respone) {
                $scope.baseParams = respone.data;
            }, function error(response) {
                return null;
            });
        }
    })
})();