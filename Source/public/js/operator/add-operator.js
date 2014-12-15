(function() {

    'use strict';

    var app = angular.module('administrator-add-operator', ['header']);

    app.controller('addOperatorController', function() {
        angular.element("#input-id").fileinput({'showUpload':false, 'previewFileType':'any'});

        $('#tab-manager').removeClass('backend-side-bar-active');
        $('#tab-operator').addClass('backend-side-bar-active');

        this.back = function() {
            window.location = '/admin/operator';
        };

        this.submit = function() {

            var reg_id, reg_name, flag;

            flag = true;
            reg_id = new RegExp('[a-zA-Z]{3,10}');
            reg_name = new RegExp('^([a-zA-Z ]{0,}[^\u0000-\u007F]{0,})+$');

            removeNotification('#add-operator-id');
            removeNotification('#add-operator-name');

            if (reg_id.test(this.operator_id) == false || reg_id.exec(this.operator_id)[0] !=  this.operator_id) {
                showNotification('#add-operator-id', 'Mã hãng xe không hợp lệ');
                flag = false;
            }

            if (reg_name.test(this.operator_name) == false || reg_name.exec(this.operator_name)[0] !=  this.operator_name) {
                showNotification('#add-operator-name', 'Tên hãng xe không hợp lệ');
                flag = false;
            }

            if (flag) {
                angular.element('#btn-submit').prop('type', 'submit');
            }
        };
    })
})();