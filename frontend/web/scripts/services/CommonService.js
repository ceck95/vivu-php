(function () {

    angular.module('app').service('CommonService', function ($http, $cookieStore, $rootScope) {

        let dataHeaderFooter,
            breadCrumbs,
            showCartQuickView = false;

        let updateDataItem = (data) => {

            let dataReq = angular.copy(data);

            return $http({
                method: 'POST',
                url: '/quote-item/update-qty-quote-item',
                data: {
                    quoteId: dataReq.quote_id,
                    productId: dataReq.product_id,
                    selectedProductColorId: data.selected_product_color_id,
                    qty: data.qty
                }
            }).then(response => {
                return response.data;
            }).catch(err => {
                console.error(err);
                return err;
            });

        };

        return ({
            getPagePartials: function () {
                let request = $http({
                    method: "get",
                    url: '/base/get-page-partials',
                    dataType: 'json'
                });

                return request.then(function success(respone) {
                    dataHeaderFooter = respone.data;
                }, function error(response) {
                    console.error(response);
                    return null;
                });
            },
            getDataHeaderFooter: () => {
                return dataHeaderFooter;
            },
            setBreadCrumbs: function (data) {
                breadCrumbs = data;
            },
            getBreadCrumbs: function () {
                if (breadCrumbs == undefined && typeof breadCrumbObject != 'undefined') {
                    breadCrumbs = breadCrumbObject;
                }
                return breadCrumbs
            },
            updateQtyCart:(data)=>{

                let currentDataCart = $rootScope.dataItem;

                for (let i = 0; i <= currentDataCart.length - 1; i++) {

                    if (currentDataCart[i].product_id === data.product_id && currentDataCart[i].selected_product_color_id === data.selected_product_color_id) {

                        updateDataItem(data).then(response => {
                            if (response.message)
                                currentDataCart[i].qty = data.qty;
                        });

                        break;
                    }

                }

                $rootScope.dataItem = currentDataCart;

            },
            setCurrentCart: (data) => {

                let currentDataCart = $rootScope.dataItem;

                let insertDataItem = (data) => {

                    let dataReq = angular.copy(data);
                    delete dataReq.product;
                    delete dataReq.product_color;

                    return $http({
                        method: 'POST',
                        url: '/quote-item/create',
                        data: dataReq
                    }).then(response => {
                        return response.data;
                    }).catch(err => {
                        console.error(err);
                        return err;
                    });

                };


                if (currentDataCart.length > 0) {

                    for (let i = 0; i <= currentDataCart.length - 1; i++) {

                        if (currentDataCart[i].product_id === data.product_id && currentDataCart[i].selected_product_color_id === data.selected_product_color_id) {

                            data.qty = parseInt(currentDataCart[i].qty) + parseInt(data.qty);

                            updateDataItem(data).then(response => {
                                if (response.message)
                                    currentDataCart[i].qty = data.qty;
                            });

                            break;
                        }

                        if (i === currentDataCart.length - 1) {

                            insertDataItem(data).then(response => {
                                if (response.message)
                                    currentDataCart.push(data);
                            });

                            break;
                        }

                    }

                } else {

                    insertDataItem(data).then(response => {
                        if (response.message)
                            currentDataCart.push(data);
                    });

                }

                $rootScope.dataItem = currentDataCart;
            },
            getCurrentCart: () => {
                return $rootScope.dataItem;
            },
            removeItemCart: (data) => {

                let currentDataCart = angular.copy($rootScope.dataItem);

                let deleteItem = (data) => {

                    return $http({
                        method: 'POST',
                        url: '/quote-item/delete-quote-item',
                        data: {
                            quoteId: data.quote_id,
                            productId: data.product_id,
                            selectedProductColorId: data.selected_product_color_id
                        }
                    }).then(response => {
                        return response.data;
                    }).catch(err => {
                        console.error(err);
                        return err;
                    });


                };

                let dataCompare = angular.copy(data);
                let currentDataCartAfterFilter = currentDataCart.filter((item) => {

                    if (item['product_id'] != dataCompare['product_id']) {
                        return true;
                    }else{

                        if(item['product_id'] == dataCompare['product_id'] && item['selected_product_color_id'] != dataCompare['selected_product_color_id']){
                            return true;
                        }

                    }

                    return false;

                });

                if(currentDataCartAfterFilter.length != currentDataCart.length){
                    deleteItem(data).then(resp=>{
                        if(resp.message){
                            $rootScope.dataItem = currentDataCartAfterFilter;
                        }
                    })
                }

            },
            toggleCartQuickView: () => {

                if (showCartQuickView) {
                    showCartQuickView = false;
                } else {
                    showCartQuickView = true;
                }

            },
            getShowCartQuickView: () => {

                return showCartQuickView;

            },
            getQuoteCurrent: (id) => {

                return $http({
                    method: 'GET',
                    url: '/quote/get-or-create?id=' + id,
                    dataType: 'json'
                }).then((response) => {
                    return response.data;
                }, (response) => {
                    console.error(response);
                    return null;
                });

            },
            getAllItem: (id) => {
                return $http({
                    method: 'GET',
                    url: '/quote-item/get-all-item?id=' + id
                }).then(response => {

                    return response.data;

                }).catch(err => {
                    console.error(err);
                    return null;
                });
            }
        })

    })
})();