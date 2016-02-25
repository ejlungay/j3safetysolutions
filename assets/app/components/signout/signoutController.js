'use strict';

/**
 * @ngdoc function
 * @name j3appApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the j3appApp
 */
angular.module('j3appApp')
  .controller('signOutController', function () {
    this.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma',
	  'ui.bootstrap'
    ];
  });

  /*
*	Controller for logging out purposes
*/
angular.module('j3appApp').controller('signOutController', ['$scope', '$http', '$location', function($scope, $http, $location){ 
	$scope.temp = document.cookie.split(';');
	if ($scope.temp != null) {
		$scope.user = '';
		for (var i = 0; i < $scope.temp.length; i++) {
			if ($scope.temp[i].indexOf("username") > -1) {
				$scope.user = $scope.temp[i].split('=');
			}
		}
		$http.get("http://localhost/j3safetysolutions/index.php/destroy_user?username=" + $scope.user[1]).success(function(response) { 
			$location.path("/login");
		}).error(function(response){
			alert('An error occured. The server is not responding to the sent request. Please contact the system administrator.');
		});
	}
}]);
//-------------------------------------------------------------------------------------------------

 