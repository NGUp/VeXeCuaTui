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
                var hash = function(password) {
                    return md5(sha1(password) + '0d26906343c06781b068027f55a868c4');
                };

                $.ajax({
                    type: "POST",
                    url: "/syn/editmanager",
                    data: {
                        manager_id: id,
                        manager_old_password: hash(this.pass_old),
                        manager_new_password: hash(this.pass_new),
                        manager_confirm_password: hash(this.pass_confirm)
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
                        $('#edit-modal').modal();
                    } else {
                        window.location.href = '/admin/manager';
                    }
                });
            }
        };
    });
})();