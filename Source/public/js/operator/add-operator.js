(function() {

    'use strict';

    var app = angular.module('administrator-add-operator', ['header']);

    app.controller('addOperatorController', function() {
        $("#input-id").fileinput({'showUpload':false, 'previewFileType':'any'});

        $('#tab-manager').removeClass('backend-side-bar-active');
        $('#tab-operator').addClass('backend-side-bar-active');

        this.back = function() {
            window.location = '/admin/operator';
        };

        this.submit = function() {

            var reg_name, flag;

            flag = true;
            reg_name = new RegExp('^([a-zA-Z ]{0,}[^\u0000-\u007F]{0,})+$');

            removeNotification('#add-operator-name');

            if (reg_name.test(this.operator_name) == false || reg_name.exec(this.operator_name)[0] !=  this.operator_name) {
                showNotification('#add-operator-name', 'Tên hãng xe không hợp lệ');
                flag = false;
            }

            if (flag) {
                $.ajax({
                    type: "POST",
                    url: "/syn/checkavailableoperatorname",
                    data: {
                        operator_name: this.operator_name
                    }
                }).done(function(message) {
                    console.log(message);
                    if (message == 0) {
                        $('#error-content').html("Tên hãng xe đã tồn tại");
                        $('#add-modal').modal();
                    } else {
                        $('#add-operator-form').submit();
                    }
                });
            }
        };
    })
})();