(function() {

    'use strict';

    var app = angular.module('moderator-edit-operator', ['header', 'mod-sidebar']);

    app.controller('editOperatorController', function() {
        $("#input-id").fileinput({'showUpload':false, 'previewFileType':'any'});
        this.operator_logo = $('#tmp_logo').val();
        $('body').find('.file-caption-name').html(this.operator_logo);

        $('#tab-information').css("color", "#fff");

        this.back = function() {
            window.location = '/admin';
        };

        this.submit = function() {

            var reg_name, flag;

            flag = true;
            reg_name = new RegExp('^([a-zA-Z ]{0,}[^\u0000-\u007F]{0,})+$');

            removeNotification('#edit-operator-name');

            if (reg_name.test(this.operator_name) == false || reg_name.exec(this.operator_name)[0] !=  this.operator_name) {
                showNotification('#edit-operator-name', 'Tên hãng xe không hợp lệ');
                flag = false;
            }

            if (flag) {
                $('#btn-submit').prop('type', 'submit');
            }
        };
    });
})();