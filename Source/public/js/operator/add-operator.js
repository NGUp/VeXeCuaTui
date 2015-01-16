(function() {

    'use strict';

    var app = angular.module('administrator-add-operator', ['header', "admin-sidebar"]);

    app.controller('addOperatorController', function() {
        $("#input-id").fileinput({'showUpload':false, 'previewFileType':'any'});

        $('#tab-operator').css("color", "#fff");

        this.back = function() {
            window.location = '/admin/operator';
        };

        this.submit = function() {

            var reg_name, fileName, flag;

            flag = true;
            reg_name = new RegExp('^([a-zA-Z ]{0,}[^\u0000-\u007F]{0,})+$');
            fileName = $("#input-id").val().split("\\");

            removeNotification('#add-operator-name');
            removeNotification('#file-logo');

            if (reg_name.test(this.operator_name) == false || reg_name.exec(this.operator_name)[0] !=  this.operator_name) {
                showNotification('#add-operator-name', 'Tên hãng xe không hợp lệ');
                flag = false;
            }

            if (fileName[fileName.length - 1].length > 50) {
                showNotification('#file-logo', 'Tên file không được quá 50 kí tự');
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