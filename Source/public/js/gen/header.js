angular.module("header", [])
    .controller("headerController", function($scope) {
        $scope.payment = function() {
            //window.localStorage.setItem("UserID", $scope.user_id);

        };

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
                        $('#user-modal').modal('hide');
                        window.localStorage.setItem("ID", $scope.user_id);
                        window.localStorage.setItem("Name", $scope.user_name);
                        window.localStorage.setItem("Email", $scope.user_email);
                        window.localStorage.setItem("Phone", $scope.user_phone);
                        $('.header-user').html('<span class="glyphicon glyphicon-bell"></span> Thanh toán');
                    }
                });
            }
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

            $scope.user_id = '';
            $scope.user_name = '';
            $scope.user_email = '';
            $scope.user_phone = '';
            $scope.user_password = '';
            $scope.user_confirm = '';
        });

        if (window.localStorage.ID !== undefined) {
            $('.header-user')
                .html('<span class="glyphicon glyphicon-bell"></span> Thanh toán')
                .removeAttr('data-toggle')
                .removeAttr('data-target');
        }
    });