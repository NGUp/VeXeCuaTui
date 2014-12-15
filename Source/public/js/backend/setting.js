(function() {
    'use strict';

    var app = angular.module("backend-setting", ["header", "mod-sidebar"]);

    app.controller("settingController", function() {

        this.id = id;

        this.back = function () {
            window.location.href = '/admin';
        };

        this.submit = function() {
            var flag = true;

            removeNotification('#setting-pass-old');
            removeNotification('#setting-pass-new');
            removeNotification('#setting-pass-confirm');

            if (this.pass_old == undefined || this.pass_old.length == 0) {
                showNotification('#setting-pass-old', 'Mật khẩu không hợp lệ');
                flag = false;
            }

            if (this.pass_new == undefined || this.pass_new.length == 0) {
                showNotification('#setting-pass-new', 'Mật khẩu mới không hợp lệ');
                flag = false;
            }

            if (this.pass_confirm == undefined || this.pass_confirm.length == 0 || this.pass_confirm != this.pass_new) {
                showNotification('#setting-pass-confirm', 'Mật khẩu xác nhận không hợp lệ');
                flag = false;
            }

            if (flag) {
                $('#btn-submit').prop('type', 'submit');
            }
        };
    });
})();