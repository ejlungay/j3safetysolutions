'use strict';

angular.module('j3appApp')
    .controller('MainCtrl', function($scope, $http, $location, loginFactory) {
        $scope.temp = document.cookie.split(';');
        if ($scope.temp != null) {
            $scope.user = '';
            for (var i = 0; i < $scope.temp.length; i++) {
                if ($scope.temp[i].indexOf("username") > -1) {
                    $scope.user = $scope.temp[i].split('=');
                }
            }

            loginFactory.isLoggedIn($.trim($scope.user[1])).then(function(response) {
                if (response.returnValue == 'FALSE') {
                    $location.path("/login");
                }
            });

            
        }
    });
