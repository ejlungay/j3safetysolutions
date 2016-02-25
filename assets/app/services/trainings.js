'use strict';

angular.module('j3appApp')
    .factory('trainingFactory', function($http, API_URL, toastr) {
        return {
            getAllTrainings: function(data) {
                return $http({
                    url: API_URL + '/isLoggedIn?username=' + data,
                    method: 'GET'
                }).then(function(response) {
                    return res.data;
                }).then(function(response) {
                    toastr.error('An error occured. The server is not responding to the sent request. Please contact the system administrator. : ' + response, 'ERROR');
                });
            }
        };
    });
