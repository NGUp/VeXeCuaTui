(function() {

    'use strict';

    var app = angular.module('search-operator', []);

    app.controller('searchManagerController', function() {
        this.searchID = function() {
            window.location = '/admin/operator?condition=MaHangXe&key=' + this.search_keyword;
        };

        this.searchName = function() {
            window.location = '/admin/operator?condition=TenHangXe&key=' + this.search_keyword;
        };
    });
})();