(function() {

    'use strict';

    var app = angular.module('administrator-add-manager', ['header']);

    app.controller('addManagerController', function() {
        $('.combobox').combobox();
        $('.combobox').addClass('form-control');

        $('#tab-manager').addClass('backend-side-bar-active');
        $('#tab-operator').removeClass('backend-side-bar-active');

        this.show = true;

        this.toggleMenu = function() {
            this.show = !this.show;
            removeNotification('.combobox-container');
        };

        this.back = function() {
            window.location = '/admin/manager';
        };

        this.submit = function() {
            var reg_id, reg_name, reg_user, flag;

            flag = true;
            reg_id = new RegExp('[0-9]{9}');
            reg_name = new RegExp('^([a-zA-Z ]{0,}[^\u0000-\u007F]{0,})+$');
            reg_user = new RegExp('[a-zA-Z_ ]+');

            removeNotification('#add-manager-id');
            removeNotification('#add-manager-name');
            removeNotification('#add-manager-user');
            removeNotification('.combobox-container');

            if (reg_id.test(this.manager_id) == false || reg_id.exec(this.manager_id)[0] !=  this.manager_id) {
                showNotification('#add-manager-id', 'CMND không hợp lệ');
                flag = false;
            }

            if (reg_name.test(this.manager_name) == false || reg_name.exec(this.manager_name)[0] !=  this.manager_name) {
                showNotification('#add-manager-name', 'Họ tên không hợp lệ');
                flag = false;
            }

            if (reg_user.test(this.manager_user) == false || reg_user.exec(this.manager_user)[0] !=  this.manager_user) {
                showNotification('#add-manager-user', 'Tên đăng nhập không hợp lệ');
                flag = false;
            }

            if ((this.manager_is_admin == undefined || this.manager_is_admin == false)  && angular.element('.combobox-container').children(0).val() == '') {
                showNotification('.combobox-container', 'Vui lòng chọn hãng xe');
                flag = false;
            }

            if (flag) {
                angular.element('#btn-submit').prop('type', 'submit');
            }
        };
    })
})();