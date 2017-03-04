(function () {
    angular.module('app').controller('CartCtrl', function ($scope, CommonService) {

        $scope.CommonService = CommonService;

        let title = 'Cart';

        let breadCrumbs = {
            list: [
                {
                    name: title,
                    link: '/home#/cart/view',
                    active: true
                }
            ],
            textTitle: title
        };

        CommonService.setBreadCrumbs(breadCrumbs);

        $scope.changeQuantity = (data) => {
            console.log(data.qty);
            if(isNaN(data.qty) || data.qty == 0){
                $scope.messageQty = true;
            }else{
                $scope.messageQty = false;
                CommonService.updateQtyCart(data);
            }

        };

    });
})();