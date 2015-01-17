angular.module("header", [])
    .controller("headerController", function($scope) {
        $scope.register = function() {
            var reg_name, reg_phone, reg_id, flag;

            flag = true;
            reg_id = new RegExp('[0-9]{9}');
            reg_name = new RegExp('^([a-zA-Z ]{0,}[^\u0000-\u007F]{0,})+$');
            reg_phone = new RegExp('^[0-9]{8,11}$');

            removeNotification('#header-register-id');
            removeNotification('#header-register-name');
            removeNotification('#header-register-email');
            removeNotification('#header-register-phone');
            removeNotification('#header-register-password');
            removeNotification('#header-register-confirm');

            if (reg_id.test($scope.user_id) == false || reg_id.exec($scope.user_id) !=  $scope.user_id) {
                showNotification('#header-register-id', 'CMND không hợp lệ');
                flag = false;
            }

            if (reg_name.test($scope.user_name) == false || reg_name.exec($scope.user_name)[0] !=  $scope.user_name) {
                showNotification('#header-register-name', 'Họ tên không hợp lệ');
                flag = false;
            }

            if (reg_phone.test($scope.user_phone) == false || reg_phone.exec($scope.user_phone)[0] !=  $scope.user_phone) {
                showNotification('#header-register-phone', 'Số điện thoại không hợp lệ');
                flag = false;
            }

            if ($scope.user_email == undefined || (/([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})/img).exec($scope.email) !=  $scope.email) {
                showNotification('#header-register-email', 'Email không hợp lệ');
                flag = false;
            }

            if ($scope.user_password == undefined || $scope.user_password.length < 6) {
                showNotification('#header-register-password', 'Mật khẩu phải ít nhất 6 ký tự');
                flag = false;
            }

            if ($scope.user_confirm != $scope.user_password) {
                showNotification('#header-register-confirm', 'Mật khẩu xác nhận không chính xác');
                flag = false;
            }

            if (flag) {
                $.ajax({
                    type: "POST",
                    url: "/syn/createcustomer",
                    data: {
                        "id": $scope.user_id,
                        "name" : $scope.user_name,
                        "phone" : $scope.user_phone,
                        "email" : $scope.user_email,
                        "password" : hash($scope.user_password)
                    }
                }).done(function(data) {
                    var pattern, reg_err, match, index;

                    pattern = /\[(.*?)\]/igm;
                    reg_err = new RegExp(pattern);

                    if (reg_err.test(data)) {
                        while (match = pattern.exec(data)) {
                            index = pattern.lastIndex;
                        }
                        $('#error-content').html(data.substring(index, data.length).trim());
                        $('#error-modal').modal();
                    } else {
                        window.localStorage.setItem("ID", $scope.user_id);
                        window.localStorage.setItem("Name", $scope.user_name);
                        window.localStorage.setItem("Email", $scope.user_email);
                        window.localStorage.setItem("Phone", $scope.user_phone);
                        $('.header-user')
                            .html('<span class="glyphicon glyphicon-user"></span> ' + window.localStorage.Name)
                            .removeAttr('data-toggle')
                            .removeAttr('data-target')
                            .addClass('header-menu');

                        location.reload();
                    }
                });
            }
        };

        $scope.login = function() {
            $.ajax({
                type: "POST",
                url: "/syn/logincustomer",
                data: {
                    "id": $scope.id,
                    "hash" : hash($scope.password)
                }
            }).done(function(data) {
                removeNotification('#btn-login');

                if (typeof(data) === 'object') {
                    if (data.length == 0) {
                        showNotification('#btn-login', 'Tên Đăng Nhập hoặc Mật Khẩu không đúng', 'bottom');
                    } else {
                        var obj = data[0];
                        window.localStorage.setItem("ID", obj.MaKH);
                        window.localStorage.setItem("Name", obj.HoTen);
                        window.localStorage.setItem("Email", obj.Email);
                        window.localStorage.setItem("Phone", obj.DienThoai);
                        location.reload();
                    }
                } else {
                    var pattern, reg_err, match, index;

                    pattern = /\[(.*?)\]/igm;
                    reg_err = new RegExp(pattern);

                    if (reg_err.test(data)) {
                        while (match = pattern.exec(data)) {
                            index = pattern.lastIndex;
                        }
                        $('#error-content').html(data.substring(index, data.length).trim());
                        $('#error-modal').modal();
                    }
                }
            });
        };

        var hash = function(password) {
            return md5(sha1(password) + '0d26906343c06781b068027f55a868c4');
        };

        $('#user-modal').on('hide.bs.modal', function (e) {
            removeNotification('#header-register-id');
            removeNotification('#header-register-name');
            removeNotification('#header-register-email');
            removeNotification('#header-register-phone');
            removeNotification('#header-register-password');
            removeNotification('#header-register-confirm');
            removeNotification('#btn-login');

            $scope.user_id = '';
            $scope.user_name = '';
            $scope.user_email = '';
            $scope.user_phone = '';
            $scope.user_password = '';
            $scope.user_confirm = '';
        });

        if (window.localStorage.ID !== undefined) {
            $('.header-user')
                .html('<span class="glyphicon glyphicon-user"></span> ' + window.localStorage.Name)
                .removeAttr('data-toggle')
                .removeAttr('data-target')
                .addClass('header-menu');
        }

        $(".header-menu").click(function() {
            $('.header-user-menu').toggle();
        });

        $("#header-menu-logout").click(function() {
            window.localStorage.removeItem("ID");
            window.localStorage.removeItem("Email");
            window.localStorage.removeItem("Name");
            window.localStorage.removeItem("Phone");
            location.reload();
        });

        $("#header-menu-payment").click(function() {
            event.preventDefault();

            var newForm = jQuery("<form>", {
                "action": "/payment",
                "method": "post"
            }).append(jQuery("<input>", {
                "name": "customer",
                "value": window.localStorage.ID,
                "type": "hidden"
            }));
            newForm.submit();
        });
    });