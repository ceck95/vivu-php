/**
 * Created At 8/4/16.
 */

const DATE_FORMAT = 'DD/MM/YYYY';
const DATETIME_FORMAT = 'DD/MM/YYYY HH:mm:ss';
const TIME_FORMAT = 'HH:mm';

function resetDatetimepicker() {
  $('.datetimepicker').datetimepicker({
    format: DATETIME_FORMAT
  });
}
function resetTimePicker() {
  $('.timepicker').datetimepicker({
    format: TIME_FORMAT
  });
}
function resetDatepicker() {
  $('.datepicker').datetimepicker({
    format: DATE_FORMAT
  });
}

function resetSelect2() {
  $('.select2').select2();
}

function resetChosenSelect() {
  $('.chosen-select').chosen();
}

var resetCkeditor = function () {
  var ck = $('.ckeditor');
  ck.each(function () {
    var e = $(this);
    var ckid = e.attr('id');
    CKEDITOR.replace(ckid, {
      height: 250
    });
    CKEDITOR.on('instanceReady', function () {
      $.each(CKEDITOR.instances, function (instance) {
        CKEDITOR.instances[instance].on("change", function (e) {
          for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
        });
      });
    });
  });

  CKEDITOR.on('instanceReady', function () {
    $.each(CKEDITOR.instances, function (instance) {
      CKEDITOR.instances[instance].on("change", function (e) {
        for (instance in CKEDITOR.instances)
          CKEDITOR.instances[instance].updateElement();
      });
    });
  });
}

function uniqid() {
  return 'S' + (((1 + Math.random()) * 0x100000000) | 0).toString(16).substring(1);
}

var DateTimeFormat = {
    datetimeDiff: function (start, end) {
      // var start = new Date(datetimeFrom);
      // var end = new Date(datetimeTo);
      var diffMs = (end - start); // milliseconds between now & Christmas
      var diffDays = Math.round(diffMs / 86400000); // days
      var diffHrs = Math.round((diffMs % 86400000) / 3600000); // hours
      var diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes

      return {
        day : Math.abs(diffDays),
        hour : Math.abs(diffHrs),
        min : Math.abs(diffMins)
      }
    }
};