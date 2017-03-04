/**
 * Created by tyluu on 23/12/2016.
 */

function BoxItems() {
    var _body = $('body');
    var scope = $('.form-box-item');
    var divNotSlideShow = scope.find('.not-slide-show');
    var divSlideShow = scope.find('.option-for-slide-show');

    this.init = function () {
        scope.on('change', '#box-id', function () {
            var t = $(this);
            if (t.attr('slide-show-id') == t.val()){
                divNotSlideShow.addClass('hidden');
                divSlideShow.removeClass('hidden');
                divNotSlideShow.find('.input-not-slide-show').attr('disabled', true);
                scope.find('.for-slide-show').attr('disabled', false)
            }else {
                divNotSlideShow.find('.input-not-slide-show').attr('disabled', false);
                divNotSlideShow.removeClass('hidden');
                divSlideShow.addClass('hidden');
                scope.find('.for-slide-show').attr('disabled', true)
            }
        });
    }
}

$(document).ready(function () {
    (new BoxItems()).init();
});
