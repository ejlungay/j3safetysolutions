'use strict';

angular.module('j3appApp')
    .factory('loginFactory', function($http, API_URL, toastr) {
        return {
            isLoggedIn: function(data) {
                return $http({
                    url: API_URL + '/isLoggedIn?username=' + data,
                    method: 'GET'
                }).then(function(response) {
                    return res.data;
                }).then(function(response) {
                    toastr.error('An error occured. The server is not responding to the sent request. Please contact the system administrator. : ' + response, 'ERROR');
                });
            },
            currentUser: function(data) {
                return $http({
                    url: API_URL + '/current_user?username=' + data,
                    method: 'GET'
                }).then(function(response) {
                    return res.data;
                }).then(function(response) {
                    toastr.error('An error occured. The server is not responding to the sent request. Please contact the system administrator. : ' + response, 'ERROR');
                });
            },
            getUserType: function(uid) {
                return $http({
                    url: API_URL + '/get_user_type?uid=' + uid,
                    method: 'GET'
                }).then(function(response) {
                    return res.data;
                }).then(function(response) {
                    toastr.error('An error occured. The server is not responding to the sent request. Please contact the system administrator. : ' + response, 'ERROR');
                });
            }
        };
    });
