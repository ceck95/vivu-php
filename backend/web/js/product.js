/**
 * Created At 12/21/16.
 */
function Product() {
    var renderCategory = function (id, categoryId) {
            return $.ajax({
                url: PARAMS.urlHome + 'category/get-list-by-category-group-id?id=' + id,
                method: 'GET',
                success: function (res) {
                    var listElement = '<option value="">Select one</option>';
                    var categories = res.categories;
                    if (categories.length > 0) {
                        categories.forEach(function (e) {
                            listElement += '<option value=' + e.id + '>' + e.name + '</option>';
                        });
                    }
                    $('.field-product-category_id select').html(listElement);
                    $('.field-product-category_id span').remove();
                    resetSelect2();
                    if (categoryId) {
                        $('#product-category_id').val(categoryId).trigger('change');
                    }
                },
                error: function (xhr, textStatus, e) {
                    console.error(e);
                }
            });
        },
        categoryGroupId = PARAMS.categoryGroupId,
        categoryId = PARAMS.categoryId;


    if (categoryGroupId) {
        renderCategory(categoryGroupId,categoryId);
        $('.category-group').val(categoryGroupId);
    }

    this.init = function () {
        $('body').on('change', '#toggleAddNewDesignProductForm', function () {
            $('.design-product-form').toggleClass('hidden');
        }).on('change', '.category-group', function () {
            renderCategory(this.value);
        });
    }
}

$(document).ready(function () {
    (new Product()).init();
});