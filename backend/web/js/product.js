/**
 * Created At 12/21/16.
 */
function Product () {
    this.init = function () {
        $('body').on('change', '#toggleAddNewDesignProductForm', function () {
            $('.design-product-form').toggleClass('hidden');
        })
    }
}

$(document).ready(function () {
    (new Product()).init();
});