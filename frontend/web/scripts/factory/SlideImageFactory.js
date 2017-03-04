(function () {
    angular.module('app').factory('SlideImageFactory', function () {
        return ({
            intValueSlide: ($scope, options) => {

                $scope.posFirtImageColor = 0;
                $scope.posLastImageColor = 12;
                $scope.posFirstImageReview = 0;
                $scope.posLastImageReview = 5;
                $scope.dataImageColor = $scope.dataView.productColors.slice($scope.posFirtImageColor, $scope.posLastImageColor);
                $scope.dataImageColorReview = options.listColorReview.slice($scope.posFirstImageReview, $scope.posLastImageReview);
                $scope.btnPrevImageColor = 'disabled';
                $scope.btnNextImageColor = '';
                $scope.btnPrevColorReview = 'disabled';
                $scope.btnNextColorReview = '';

                if (options.listColor.length <= 12) {
                    $scope.btnPrevImageColor = 'disabled';
                    $scope.btnNextImageColor = 'disabled';
                }

                if (options.listColorReview.length <= 5) {
                    $scope.btnNextColorReview = 'disabled';
                    $scope.btnPrevColorReview = 'disabled';
                }

                $scope.posSlideZoom = 0;

                if (!$scope.imageZoom) {
                    $scope.imageZoom = $scope.dataView.image_path;
                }

                $scope.btnSlideZoomPrev = 'disabled';
                $scope.btnSlideZoomNext = '';

                if (!$scope.selectedProductColor) {
                    $scope.selectedProductColor = 0;
                }

                $scope.clickZoomFirst = true;
                if(!$scope.priceCurrent){

                    $scope.priceCurrent = parseInt($scope.dataView.base_price) + parseInt(options.listColor[0].price);
                }
            },
            slideImageColor: ($scope, handle, listColor) => {

                if (handle === 'next') {
                    $scope.posFirtImageColor = $scope.posLastImageColor;
                    $scope.posLastImageColor = $scope.posLastImageColor + 12;
                    $scope.dataImageColorQuickView = listColor.slice($scope.posFirtImageColor, $scope.posLastImageColor);
                    if ($scope.btnPrevImageColor === 'disabled') {
                        $scope.btnPrevImageColor = '';
                    }
                    if ($scope.dataImageColorQuickView.length < 12) {
                        $scope.btnNextImageColor = 'disabled';
                    }
                } else {
                    $scope.posFirtImageColor = $scope.posFirtImageColor - 12;
                    $scope.posLastImageColor = $scope.posLastImageColor - 12;
                    $scope.dataImageColorQuickView = listColor.slice($scope.posFirtImageColor, $scope.posLastImageColor);
                    if ($scope.posFirtImageColor === 0) {
                        $scope.btnPrevImageColor = 'disabled';
                    } else {
                        if ($scope.btnNextImageColor === 'disabled') {
                            $scope.btnNextImageColor = '';
                        }
                    }
                }

            },
            slideImageReview: ($scope, handle, listColorReview) => {

                if (handle == 'next') {
                    if ($scope.dataImageColorReview.length === 5 && $scope.btnNextColorReview === '') {

                        $scope.posFirstImageReview++;
                        $scope.posLastImageReview++;

                        if ($scope.btnPrevColorReview === 'disabled') {
                            $scope.btnPrevColorReview = '';
                        }

                        $scope.dataImageColorReview = listColorReview.slice($scope.posFirstImageReview, $scope.posLastImageReview);

                        if ($scope.posFirstImageReview === listColorReview.length - 5) {
                            $scope.btnNextColorReview = 'disabled';
                        }


                    }

                } else {

                    if ($scope.dataImageColorReview.length <= 5 && $scope.posFirstImageReview > 0) {
                        $scope.posFirstImageReview--;
                        $scope.posLastImageReview--;
                        if ($scope.btnNextColorReview === 'disabled') {
                            $scope.btnNextColorReview = '';
                        }
                        $scope.dataImageColorReview = listColorReview.slice($scope.posFirstImageReview, $scope.posLastImageReview);
                        if ($scope.posFirstImageReview === 0) {
                            $scope.btnPrevColorReview = 'disabled';
                        }
                    }

                }

            },
            slideZoom: ($scope, handle, listColorReview) => {

                if (handle == 'next') {

                    if ($scope.posSlideZoom <= listColorReview.length - 1 && $scope.btnSlideZoomNext === '') {

                        if ($scope.clickZoomFirst) {
                            $scope.imageZoom = listColorReview[$scope.posSlideZoom].path;
                            $scope.clickZoomFirst = false;
                        } else {
                            $scope.posSlideZoom++;
                            $scope.imageZoom = listColorReview[$scope.posSlideZoom].path;
                        }

                        $scope.selectedPCImagePreview = listColorReview[$scope.posSlideZoom].id;

                        if ($scope.posSlideZoom == 1) {
                            $scope.btnSlideZoomPrev = '';
                        }

                        if ($scope.posSlideZoom === listColorReview.length - 1) {
                            $scope.btnSlideZoomNext = 'disabled';
                        }

                    }
                } else {

                    if ($scope.posSlideZoom <= listColorReview.length && $scope.posSlideZoom !== 0) {

                        $scope.posSlideZoom--;
                        $scope.imageZoom = listColorReview[$scope.posSlideZoom].path;

                        $scope.selectedPCImagePreview = listColorReview[$scope.posSlideZoom].id;

                        if ($scope.posSlideZoom == 0) {
                            $scope.btnSlideZoomPrev = 'disabled';
                        }
                        if ($scope.posSlideZoom === listColorReview.length - 2) {
                            $scope.btnSlideZoomNext = '';
                        }

                    }

                }

            },
            setSelectedProductColor: ($scope, index, listColor) => {

                $scope.selectedProductColor = index;
                $scope.imageZoom = listColor.refer_product_image_path;
                $scope.priceCurrent = parseInt($scope.dataView.base_price) + parseInt(listColor.price);

            },
            setSelectedPCImagePreview: ($scope, posSlideZoom, selectedImagePreview, image, listColorReview) => {

                $scope.posSlideZoom = posSlideZoom;
                $scope.selectedPCImagePreview = selectedImagePreview;
                $scope.imageZoom = image.path;
                $scope.clickZoomFirst = false;

                if (posSlideZoom > 0 && posSlideZoom < listColorReview.length - 1) {
                    $scope.btnSlideZoomNext = '';
                    $scope.btnSlideZoomPrev = '';
                }
                if (posSlideZoom === 0) {
                    $scope.btnSlideZoomNext = '';
                    $scope.btnSlideZoomPrev = 'disabled';
                }
                if (posSlideZoom === listColorReview.length - 1) {
                    $scope.btnSlideZoomNext = 'disabled';
                    $scope.btnSlideZoomPrev = '';
                }
            }
        });
    });
})();
