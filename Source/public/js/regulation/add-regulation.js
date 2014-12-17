(function() {

    'use strict';

    var app = angular.module('administrator-add-regulation', ['header']);

    app.controller('addRegulationController', function() {
        $('.datetimepicker').datetimepicker({
            pickTime: false,
            defaultDate: moment().format("DD/MM/YYYY")
        });

        $('#tab-manager').removeClass('backend-side-bar-active');
        $('#tab-operator').removeClass('backend-side-bar-active');
        $('#tab-regulation').addClass('backend-side-bar-active');

        this.back = function() {
            window.location = '/admin/regulation';
        };

        this.submit = function() {

            var reg_date, reg_percent, reg_reason, flag, date_from, date_to;

            flag = true;
            reg_date = new RegExp('^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)[0-9]{2}$');
            reg_percent = new RegExp('(-[0-9]{1,2}|[0-9]{1,2})');
            reg_reason = new RegExp('^([a-zA-Z ]{0,}[^\u0000-\u007F]{0,})+$');

            removeNotification('#add-regulation-date-from');
            removeNotification('#add-regulation-date-to');
            removeNotification('#add-regulation-percent');
            removeNotification('#add-regulation-reason');

            date_from = $('#add-regulation-date-from').val();
            date_to = $('#add-regulation-date-to').val();

            if (reg_date.test(date_from) == false || reg_date.exec(date_from)[0] !=  date_from) {
                showNotification('#add-regulation-date-from', 'Ngày bắt đầu không hợp lệ');
                flag = false;
            }

            if (reg_date.test(date_to) == false || reg_date.exec(date_to)[0] !=  date_to) {
                showNotification('#add-regulation-date-to', 'Ngày kết thúc không hợp lệ');
                flag = false;
            }

            if ($.datepicker.parseDate('dd/mm/yy', date_from) > $.datepicker.parseDate('dd/mm/yy', date_to)) {
                showNotification('#add-regulation-date-from', 'Ngày bắt đầu không được lớn hơn ngày kết thúc');
                flag = false;
            }

            if (reg_percent.test(this.regulation_percent) == false || reg_percent.exec(this.regulation_percent)[0] !=  this.regulation_percent) {
                showNotification('#add-regulation-percent', 'Số phần trăm không hợp lệ');
                flag = false;
            }

            if (reg_reason.test(this.regulation_reason) == false || reg_reason.exec(this.regulation_reason)[0] !=  this.regulation_reason) {
                showNotification('#add-regulation-reason', 'Lý do không hợp lệ');
                flag = false;
            }

            if (flag) {
                $.ajax({
                    type: "POST",
                    url: "/syn/addregulation",
                    data: {
                        regulation_date_from: date_from,
                        regulation_date_to: date_to,
                        regulation_percent: this.regulation_percent,
                        regulation_reason: this.regulation_reason
                    }
                }).done(function(message) {
                    var pattern, reg_err, match, index;

                    pattern = /\[(.*?)\]/igm;
                    reg_err = new RegExp(pattern);

                    if (reg_err.test(message)) {
                        while (match = pattern.exec(message)) {
                            index = pattern.lastIndex;
                        }
                        $('#error-content').html(message.substring(index, message.length).trim());
                        $('#add-modal').modal();
                    } else {
                        window.location.href = '/admin/regulation';
                    }
                });
            }
        };
    })
})();