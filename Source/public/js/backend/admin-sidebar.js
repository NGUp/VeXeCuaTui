(function() {
    var app = angular.module("admin-sidebar", []);

    app.controller("sidebarController", function() {
        this.editOperators = function() {
            window.location.href = "/admin/operator";
        };

        this.editModerators = function() {
            window.location.href = "/admin/manager";
        };

        this.editRegulation = function() {
            window.location.href = "/admin/regulation";
        };
    });
})();