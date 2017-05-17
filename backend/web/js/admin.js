String.prototype.stripViet = function () {
    var replaceChr = String.prototype.stripViet.arguments[0];
    var stripped_str = this.toLowerCase();
    var viet = [];
    i = 0;
    viet[i++] = ['a', "/á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/g"];
    viet[i++] = ['o', "/ó|ò|ỏ|õ|ọ|ơ|ớ|ờ|ở|ỡ|ợ|ô|ố|ồ|ổ|ỗ|ộ/g"];
    viet[i++] = ['e', "/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/g"];
    viet[i++] = ['u', "/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/g"];
    viet[i++] = ['i', "/í|ì|ỉ|ĩ|ị/g"];
    viet[i++] = ['y', "/ý|ỳ|ỷ|ỹ|ỵ/g"];
    viet[i++] = ['d', "/đ/g"];
    for (var i = 0; i < viet.length; i++) {
        stripped_str = stripped_str.replace(eval(viet[i][1]), viet[i][0]);
        //stripped_str = stripped_str.replace(eval(viet[i][1].toUpperCase().replace('G', 'g')), viet[i][0].toUpperCase());
    }
    if (replaceChr) {
        return stripped_str.replace(/[\W]|_/g, replaceChr).replace(/\s/g, replaceChr).replace(/^\-+|\-+$/g, replaceChr);
    } else {
        return stripped_str;
    }
};

var AdminCommon = {
    optionsOfSelect: function (options) {
        var html = $('<select/>');
        $.each(options, function (k, v) {
            var option = $('<option/>');
            option.attr({'value': k}).text(v);
            html.append(option);
        });
        return html.html();
    },

    ajax: function (params) {
        if (typeof params.error === 'undefined') {
            params.error = function (xhr, textStatus, e) {
                $.notify(xhr.statusText, {
                    position: "bottom center",
                    className: "error"
                })
            };
        }
        return $.ajax(params);
    }
};

var _body;

jQuery(document).ready(function () {
    _body = $('body');
    (new Admin()).init();
});

function Admin() {
    var deletingFiles = {};

    var addCommonModalAtBottom = function () {
        var htmlModalConfirm =
            '<div class="modal fade" id="modalConfirm" role="dialog">' +
            '<div class="modal-dialog">' +
            '<div class="modal-content"> ' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
            '<h4 class="modal-title"></h4>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-primary submit">' + PARAMS.messages.submit + '</button>' +
            '<button type="button" class="btn btn-default" data-dismiss="modal">' + PARAMS.messages.close + '</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';
        _body.append(htmlModalConfirm);
    };

    this.init = function () {
        $('#_name_for_slug').on('input', function () {
            var name = $("#_name_for_slug").val(),
                slug = name.stripViet('-');
            $('#_slug').val(slug);
        });

        addCommonModalAtBottom();

        _body
            .on('click', '.viewInModal', function () {
                var t = $(this);
                var url = t.attr('href');
                $.ajax({
                    url: url,
                    method: 'GET',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('viewInModal', true);
                    },
                    success: function (res) {
                        $('#commonModal').remove();
                        var modalHtml =
                            '<div style="width:1000px; margin: 0 auto" class="modal fade" id="commonModal" tabindex="-1" role="dialog"' +
                            '<div class="modal-dialog">' +
                            '<div class="modal-content">' +
                            '<div class="modal-body">' +
                            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                            res +
                            '</div>' +
                            '<div class="modal-footer">' +
                            '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        _body.append(modalHtml);
                        var _modal = $('#commonModal');
                        //_modal.find('modal-body').append(res);
                        _modal.modal('show');
                    },
                    error: function () {
                        return true;
                    }
                });
                return false;

            })
            .on('hide.bs.modal', '#commonModal', function () {
                $('#commonModal').remove();
                _body.removeClass('modal-open');
                $('.modal-backdrop').remove();
            })
            .on('click', '.ddToggleDown', function () {
                var t = $(this);
                t.find('i').attr('class', 'glyphicon glyphicon-chevron-up');
                $(t.attr('data-target')).removeClass('hidden');
                t.addClass('ddToggleUp').removeClass('ddToggleDown');
            })
            .on('click', '.ddToggleUp', function () {
                var t = $(this);
                t.find('i').attr('class', 'glyphicon glyphicon-chevron-down');
                $(t.attr('data-target')).addClass('hidden');
                t.addClass('ddToggleDown').removeClass('ddToggleUp');
            })
            .on('click', '.btnDelete', function () {
                $("#titleModal").html(PARAMS.messages.confirmDeleteText);
                $("#btnDeleteModal").attr('title', $(this).attr('href'));
                $("#modalDeleteItem").modal('show');
                return false;
            })
            .on('click', 'a.confirmInModal', function () {
                var modalConfirm = $('#modalConfirm');
                var t = $(this);
                var text = t.attr('data-confirm-text');
                modalConfirm.attr('data-url', $(this).attr('href'));
                modalConfirm.find('.modal-title').html(text);
                modalConfirm.modal('show');
                return false;
            })
            .on('click', '#modalConfirm .submit', function () {
                $.ajax({
                    url: $('#modalConfirm').attr('data-url'),
                    method: 'GET'
                })
            })
            .on('change', ".checkDeleteFile", function () {
                var t = $(this);
                var checked = t.is(':checked');
                var attribute = t.attr('data-attribute');
                if (!deletingFiles.hasOwnProperty(attribute)) {
                    deletingFiles[attribute] = [];
                }
                var srcImage = t.attr('data-image-name');
                if (checked) {
                    deletingFiles[attribute].push(srcImage);
                } else {
                    deletingFiles[attribute].splice(deletingFiles[attribute].indexOf(srcImage), 1);
                }

                t.parents('.file-upload-area').find('.deleting-images').val(deletingFiles[attribute]);
            })
            .on('click', '#btnDeleteModal', function () {
                $(this).button('loading');
                $.ajax({
                    url: $(this).attr('title'),
                    method: 'POST',
                    success: function (res) {
                    },
                    error: function () {
                    }
                });
            })
            .on('submit', '#searchWhatever', function () {
                var searchVal = $('#inputSearchWhatever').val();
                if (location.href.indexOf('?') != -1) {
                    var t = location.href;
                    location.href = t + '&search-whatever=' + searchVal;
                    return false;
                }
                return true;
            })
        ;

        // resetDatetimepicker();
        // resetDatepicker();
        // resetTimePicker();
        // resetChosenSelect();
        resetSelect2();
        resetCkeditor();

    }

}