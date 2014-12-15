(function() {
    'use strict';

    var app = angular.module('header', []);

    app.controller('headerController', function() {
        this.name = name;

        this.showDropdownMenu = function() {
            angular.element('#header-dropdown-menu').toggle();
        };

        this.setting = function() {
            window.location.href = '/admin/setting';
        };

        this.exit = function() {
            window.location.href = '/admin/logout';
        };
    });
})();