(function() {

    'use strict';

    var app = angular.module('login', []);

    app.controller('LoginController', function($scope) {
        var hash = function(password) {
            return md5(sha1(password) + '0d26906343c06781b068027f55a868c4');
        };

        $scope.login = function() {
            $.ajax({
                type: "POST",
                url: "/syn/login",
                data: {
                    "admin_login_user": $scope.admin_login_user,
                    "admin_login_hash": hash($scope.admin_login_password)
                }
            }).done(function(message) {
                if (message.length > 0) {
                    $scope.message_error = message;
                    $('#login-modal').modal();
                } else {
                    window.location.href = "/admin";
                }
            });
        };
    });

    app.directive('ngEnter', function() {
        return function(scope, element, attribute) {
            element.bind('keydown keypress', function(event) {
                if (event.which == 13) {
                    scope.$apply(function() {
                        scope.$eval(attribute.ngEnter);
                    });

                    event.preventDefault();
                }
            });
        };
    });
})();