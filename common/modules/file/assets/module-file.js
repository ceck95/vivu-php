/**
 * Created At 12/19/16.
 */
function File() {
    this.init = function () {
        _body.on('click', '.mark-file-as-deleted', function () {
            var t = $(this);
            var holder = t.parents('.file-upload-area');
            holder.find('.deleting-images').val('1');
            holder.find('.nothing').removeClass('hidden');
            holder.find('.having').addClass('hidden');
        })
    }
}

$(document).ready(function () {
    (new File()).init();
});

