(function () {
    angular.module('app').service('ProductService', function ($http) {
        return ({
            getListProductByCategory: function (categoryUrl,page,totalPage){
                if(!page){
                    page = 0;
                }
                return $http({
                    method: 'GET',
                    url: '/product/list-product-by-category?categoryUrl='+categoryUrl+'&page='+page+'&totalPage='+totalPage
                }).then(function success(response){

                    return response.data;

                },function err(response) {

                    console.err(response);
                    return null;

                });
            },
            getListProductByClassify: function (classify,page,totalPage){
                return $http({
                    method: 'GET',
                    url: '/product/list-product-by-classify?classify='+classify+'&page='+page+'&totalPage='+totalPage
                }).then(function success(response){

                    return response.data;

                },function err(response) {

                    console.err(response);
                    return null;

                });
            },
            getListProductColorImagePreview: function (productColorId){
                return $http({
                    method: 'GET',
                    url: '/product/list-product-color-image-preview?productColorId='+productColorId
                }).then(function success(response){

                    return response.data.productColorImagePreview;

                },function err(response) {

                    console.err(response);
                    return null;

                });
            },
            getProduct:(productUrl)=>{
                return $http({
                    method: 'GET',
                    url: '/product/detail?productUrl='+productUrl
                }).then(function success(response){

                    return response.data.product;

                },function err(response) {

                    console.err(response);
                    return null;

                });
            }
        });
    })
})();