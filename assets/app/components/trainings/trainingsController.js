'use strict';

angular.module('j3appApp')

.controller('trainingsController',function($scope, loginFactory) {
    //get first the currently logged on user
    $scope.temp = document.cookie.split(';');
    if ($scope.temp != null) {
        $scope.user = '';

        for (var i = 0; i < $scope.temp.length; i++) {
            if ($scope.temp[i].indexOf("username") > -1) {
                $scope.user = $scope.temp[i].split('=');
            }
        }

        loginFactory.currentUser($.trim($scope.user[1])).then(function(response) {
            if (response.uid != null) {
                $scope.uid = response.uid;

                loginFactory.getUserType($.trim($scope.uid)).then(function(data) {
                    if (data.user_type != null) {
                        if (data.user_type == 'standard-user') {
                            $('#btn_add').hide();
                        }
                    }
                });
            }
        });
    }
});

