(function() {

    'use strict';

    var app = angular.module('login', []);

    app.controller('LoginController', function($scope) {
        this.hash = function(password) {
            return md5(sha1(password) + '0d26906343c06781b068027f55a868c4');
        };

        this.login = function() {
            $scope.admin_login_hash = this.hash($scope.admin_login_password);
        };
    });
})();