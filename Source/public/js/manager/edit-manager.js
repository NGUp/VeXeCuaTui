(function() {

    'use strict';

    var app = angular.module('administrator-edit-manager', ['header']);

    app.controller('editManagerController', function() {
        $('.combobox').combobox();
        $('.combobox').addClass('form-control');

        var options = angular.element('#manager_operator').find('option');
        var hash = new Object();

        for (var index = 0; index < options.length; index++) {
            eval('hash["' + options[index].value.trim() + '"] = "' + options[index].innerText + '";');
        }

        $('.combobox').val(hash[$('.combobox-container').children(0).val(operator).val()]).val()

        if (permission == 1) {
            this.manager_is_admin = true;
            this.show = false;
        } else {
            this.show = true;
            this.manager_is_admin = false;
        }

        this.toggleMenu = function() {
            this.show = !this.show;
            removeNotification('.combobox-container');
        };

        this.back = function() {
            window.location = '/admin/manager';
        }

        this.submit = function() {
            var reg_name, reg_user, flag;

            flag = true;
            reg_name = new RegExp('^([a-zA-Z ]{0,}[^\u0000-\u007F]{0,})+$');
            reg_user = new RegExp('[a-zA-Z_ ]+');

            removeNotification('#edit-manager-name');
            removeNotification('#edit-manager-user');
            removeNotification('#edit-manager-pass');
            removeNotification('.combobox-container');

            if (reg_name.test(this.manager_name) == false || reg_name.exec(this.manager_name)[0] !=  this.manager_name) {
                showNotification('#edit-manager-name', 'Họ tên không hợp lệ');
                flag = false;
            }

            if (reg_user.test(this.manager_user) == false || reg_user.exec(this.manager_user)[0] !=  this.manager_user) {
                showNotification('#edit-manager-user', 'Tên đăng nhập không hợp lệ');
                flag = false;
            }

            if (this.manager_pass == undefined || this.manager_pass == '' || this.manager_pass.length < 6) {
                showNotification('#edit-manager-pass', 'Mật khẩu ít nhất là 6 kí tự');
                flag = false;
            }

            if (this.manager_is_admin == false && angular.element('.combobox-container').children(0).val() == '') {
                showNotification('.combobox-container', 'Vui lòng chọn hãng xe');
                flag = false;
            }

            if (flag) {
                this.manager_pass = md5(sha1(this.manager_pass) + '0d26906343c06781b068027f55a868c4');
                angular.element('#btn-submit').prop('type', 'submit');
            }
        };
    });
})();