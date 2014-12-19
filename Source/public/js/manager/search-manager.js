(function() {

    'use strict';

    var app = angular.module('search-manager', []);

    app.controller('searchManagerController', function() {
        this.searchID = function() {
            c
        };

        this.searchName = function() {
            window.location = '/admin/manager?condition=HoTen&key=' + this.search_keyword;
        };

        this.searchUser = function() {
            window.location = '/admin/manager?condition=TenDangNhap&key=' + this.search_keyword;
        };

        this.searchOperator = function() {
            window.location = '/admin/manager?condition=HangXe&key=' + this.search_keyword;
        };
    });
})();