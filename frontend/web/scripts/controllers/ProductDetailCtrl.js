(function () {
    angular.module('app').controller('ProductDetailCtrl', function (ProductService, QuantityFactory, SlideImageFactory, $scope, $routeParams, CommonService, $window,$anchorScroll,$rootScope) {
        QuantityFactory.initListQuantity($scope);
        $scope.selectQuantity = (item) => {
            QuantityFactory.selectQuantity(item, $scope)
        };

        $scope.clickToggleQuantity = (click) => {
            QuantityFactory.clickToggleQuantity(click, $scope);
        };

        $scope.zoomHandle = () => {
            QuantityFactory.zoomHandle($scope)
        };

        let listColor = [], listColorReview = [];

        if ($routeParams.productUrl) {
            ProductService.getProduct($routeParams.productUrl).then((data) => {
                $scope.dataView = data;
                listColor = angular.copy($scope.dataView.productColors);
                if (listColor.length === 0) {
                    SlideImageFactory.intValueSlide($scope, {
                        listColor: [],
                        listColorReview: []
                    });
                } else {
                    ProductService.getListProductColorImagePreview(listColor[0].id).then(data => {
                        listColorReview = data;
                        SlideImageFactory.intValueSlide($scope, {
                            listColor: listColor,
                            listColorReview: listColorReview
                        });
                    });
                }

                $window.document.title = data.name;

                let breadCrumbs = {
                    'list': [
                        {
                            name: data.category.name,
                            link: '/home#/category/' + data.category.url_key,
                            active: false
                        },
                        {
                            name: data.name,
                            link: '/home#/product/' + data.url_key,
                            active: true
                        }
                    ],
                    textTitle: data.name
                };

                CommonService.setBreadCrumbs(breadCrumbs);
            });
        }

        $scope.slideImageColor = (handle) => {
            SlideImageFactory.slideImageColor($scope, handle, listColor);
        };

        $scope.slideImageReview = (handle) => {
            SlideImageFactory.slideImageReview($scope, handle, listColorReview);
        };

        $scope.slideZoom = (handle) => {
            SlideImageFactory.slideZoom($scope, handle, listColorReview);
        };

        $scope.clickTabLifeTime = () => {
            if (!$scope.activeLifeTime) {
                $scope.activeLifeTime = 'active';
                $scope.activeDimensions = '';
            } else {
                $scope.activeLifeTime = '';
            }
        };

        $scope.clickTabDemension = () => {
            if (!$scope.activeDimensions) {
                $scope.activeDimensions = 'active';
                $scope.activeLifeTime = '';
            } else {
                $scope.activeDimensions = '';
            }
        };

        $scope.setSelectedPCImagePreview = (image) => {
            let posSlideZoom = 0,
                selectedImagePreview = 0;
            listColorReview.forEach((e, i) => {
                if (e.id === image.id) {
                    posSlideZoom = i;
                    selectedImagePreview = e.id;
                }
            });
            SlideImageFactory.setSelectedPCImagePreview($scope, posSlideZoom, selectedImagePreview, image, listColorReview);
        };

        $scope.setSelectedProductColor = (index) => {
            ProductService.getListProductColorImagePreview(listColor[index].id).then(data => {
                SlideImageFactory.setSelectedProductColor($scope, index, listColor[index]);
                listColorReview = data;
                SlideImageFactory.intValueSlide($scope, {
                    listColor: listColor,
                    listColorReview: listColorReview
                });
            });
        };

        $scope.addCart = (product, indexProductColor) => {

            $anchorScroll();
            let dataProduct = QuantityFactory.handleDataProduct(product, indexProductColor, listColor,$scope,$rootScope);

            CommonService.setCurrentCart(dataProduct);

            CommonService.toggleCartQuickView();

        };

    });
})();