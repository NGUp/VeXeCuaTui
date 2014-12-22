$('.combobox').combobox();
$('.combobox').addClass('form-control');
$(function () {
    var today = new Date();
    $('#datetimepicker').datetimepicker({
        pickTime: false,
        defaultDate: today
    });
    $('#datetimepicker').data("DateTimePicker").setMinDate(today);
});