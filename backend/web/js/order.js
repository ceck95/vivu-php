/**
 * Created At 12/21/16.
 */
function Order() {

    this.init = function () {
        $('body')
            .on('click', '.action-second a', function (e) {
                e.preventDefault();
                if ($(this).attr('title') === 'View') {
                    window.location = $(this).attr('href');
                    return;
                }

                let str = $(this).attr('change');

                let check = confirm('Do you want change status ' + str + ' ?');
                if (check) {
                    window.location = $(this).attr('href');
                }
            });
    }
}

$(document).ready(function () {
    (new Order()).init();
});