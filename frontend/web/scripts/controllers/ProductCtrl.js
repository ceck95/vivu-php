(function () {
    angular.module('app').controller('ProductCtrl', function (CommonService, ProductService, $scope, QuantityFactory, SlideImageFactory, $routeParams, $window, $anchorScroll, $rootScope) {
        let posFirt = 0,
            posLast = 3,
            list = [], page = 1, totalPageData = 0,
            selectedProductColor = 0;
        $scope.disablePrev = "disabled";
        $scope.listPaginate = [];
        $scope.selectedPagination = 0;

        let dataInitPagination = (totalPage) => {

            if ($scope.listPaginate.length !== parseInt(totalPage)) {
                for (let i = 1; i <= totalPage; i++) {
                    $scope.listPaginate.push(i);
                }
            }

        };

        $scope.selectedPaginationClick = (index) => {
            $scope.loadProducts = false;
            $scope.selectedPagination = index - 1;
            page = index;
            handleApiGetProduct();
        };

        $scope.clickPagination = (opt) => {

            let load = false;

            if (opt === 'next') {
                if ($scope.selectedPagination < $scope.listPaginate.length - 1) {
                    $scope.selectedPagination++;
                    load = true;
                }

            } else {
                if ($scope.selectedPagination != 0) {
                    $scope.selectedPagination--;
                    load = true;
                }
            }

            if (load) {
                $scope.loadProducts = false;
                page = $scope.selectedPagination + 1;
                handleApiGetProduct();
            }

        };

        let handleDataProducts = (data) => {

            data.products.forEach(e => {
                e.sizeProductColor = e.productColors.length;
            });

            $scope.listProducts = data.products;

            $scope.loadProducts = true;
            list = angular.copy($scope.listProducts);

            let title = '';
            if (data.category) {
                title = data.category.name;
            }
            if (data.title) {
                title = data.title;
            }

            $window.document.title = title;

            let breadCrumbs = {
                list: [
                    {
                        name: title,
                        link: '/home#/category/' + $routeParams.categoryUrl,
                        active: true
                    }
                ],
                textTitle: title
            };
            /*$scope.$parent.breadCrumbs = breadCrumbs;*/

            CommonService.setBreadCrumbs(breadCrumbs);

            dataInitPagination(data.pagination.totalPage);

            totalPageData = data.pagination.totalPage;

        };

        let handleApiGetProduct = () => {
            if ($routeParams.categoryUrl) {
                ProductService.getListProductByCategory($routeParams.categoryUrl, page, totalPageData).then(data => {
                    handleDataProducts(data);
                });
            }

            if ($routeParams.classify) {
                ProductService.getListProductByClassify($routeParams.classify, page, totalPageData).then(data => {
                    handleDataProducts(data);
                });
            }

        };

        handleApiGetProduct();

        $scope.resetHandleListImage = () => {
            posFirt = 0;
            posLast = 3;
            list = angular.copy(list);
            $scope.listProducts = angular.copy(list);
            $scope.disablePrev = "disabled";
            if ($scope.disableNext === "disabled") {
                $scope.disableNext = "";
            }
        };

        let getArrayColor = (item) => {
            let array = $scope.listProducts;
            for (let i = 0; i < array.length; i++) {
                if (array[i].sku == item.sku) {
                    return array[i].productColors;
                }
            }
        };

        let setArrayColor = (item, list) => {
            let array = $scope.listProducts;
            for (let i = 0; i < array.length; i++) {
                if (array[i].sku == item.sku) {
                    array[i].productColors = list;
                }
            }
            return true;
        };

        let getArrayColorDefault = (item) => {
            for (let i = 0; i < list.length; i++) {
                if (list[i].sku == item.sku) {
                    return list[i].productColors;
                }
            }
        };

        $scope.checkProductColors = (item) => {
            if (item.productColors.length <= 3) {
                $scope.disableNext = "disabled";
            }
        };

        $scope.slide = (handle, item) => {
            let listImage = getArrayColor(item),
                listImageDefault = getArrayColorDefault(item);

            if (handle === 'next') {
                if (listImageDefault.length > 3) {
                    if (posLast >= 3 && posLast <= listImageDefault.length - 1) {
                        posFirt++;
                        posLast++;
                        setArrayColor(item, listImageDefault.slice(posFirt, posLast));
                        if (listImageDefault.slice(posFirt, posLast).length < 3) {
                            $scope.disableNext = "disabled";
                            $scope.disablePrev = "";
                        } else {
                            $scope.disablePrev = "";
                        }
                    }

                    if (posLast === listImageDefault.length) {
                        $scope.disableNext = "disabled";
                        $scope.disablePrev = "";
                    }
                }

            } else {

                if (listImageDefault.length > 3) {
                    if (posLast > 3) {

                        posLast--;
                        posFirt--;
                        setArrayColor(item, listImageDefault.slice(posFirt, posLast));
                        if (posFirt === 0) {
                            $scope.disablePrev = "disabled";
                        }
                        $scope.disableNext = "";

                    } else {

                        $scope.disableNext = "";
                        $scope.disablePrev = "disabled";

                    }
                }

            }
        };

        let listColor = [],
            listColorReview = [],
            listColorReviewDefault = [];

        $scope.clickModalQuickView = (item) => {
            if ($scope.quickViewModal) {
                $scope.quickViewModal = false;
                QuantityFactory.initListQuantity($scope);
            } else {
                $scope.quickViewModal = true;
                $scope.dataView = item.item;
                listColor = angular.copy(item.item.productColors);
                if (listColor.length === 0) {

                    SlideImageFactory.intValueSlide($scope, {
                        listColor: [],
                        listColorReview: []
                    });

                } else {

                    ProductService.getListProductColorImagePreview(listColor[selectedProductColor].id).then(data => {

                        listColorReview = data;

                        SlideImageFactory.intValueSlide($scope, {
                            listColor: listColor,
                            listColorReview: listColorReview
                        });
                    });

                }

            }
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

        $scope.slideImageColor = (handle) => {
            SlideImageFactory.slideImageColor($scope, handle, listColor);
        };

        $scope.slideImageReview = (handle) => {
            SlideImageFactory.slideImageReview($scope, handle, listColorReview, listColorReviewDefault);
        };

        $scope.slideZoom = (handle) => {
            SlideImageFactory.slideZoom($scope, handle, listColorReview);
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

        $scope.seenterProductColor = (item, productColorItem) => {
            $scope.listProducts.forEach(e => {
                if (e.id === item.id) {
                    e.image_path = productColorItem.refer_product_image_path;
                }
            });
        };

        $scope.clickChangeProductColor = (item, productColorItem, index) => {

            selectedProductColor = index;

            SlideImageFactory.setSelectedProductColor($scope, index, productColorItem);
            list.forEach(e => {
                if (e.id === item.id) {
                    e.image_path = productColorItem.refer_product_image_path;
                }
            });

        };

        $scope.addCart = (product, indexProductColor) => {

            $anchorScroll();

            let dataProduct = QuantityFactory.handleDataProduct(product,indexProductColor,listColor,$scope,$rootScope);

            CommonService.setCurrentCart(dataProduct);

            CommonService.toggleCartQuickView();

            $scope.quickViewModal = false;

        };


    });
})();
