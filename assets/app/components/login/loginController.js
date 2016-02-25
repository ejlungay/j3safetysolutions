'use strict';

/**
 * @ngdoc function
 * @name j3appApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the j3appApp
 */
angular.module('j3appApp').controller('loginController', function () {
		this.awesomeThings = [
		  'HTML5 Boilerplate',
		  'AngularJS',
		  'Karma'
		];
		alert('yes');
});
//check is user is logged in; if so redirect him to dashboard
angular.module('j3appApp').controller('loginController', ['$scope', '$http', '$location', function($scope, $http, $location){ 
	$scope.temp = document.cookie.split(';');
	if ($scope.temp != null) {
		$scope.user = '';
		for (var i = 0; i < $scope.temp.length; i++) {
			if ($scope.temp[i].indexOf("username") > -1) {
				$scope.user = $scope.temp[i].split('=');
			}
		}
		$http.get('http://localhost/j3safetysolutions/index.php/isLoggedIn?username=' + $.trim($scope.user[1])).success(function(response) { 
				if (response.returnValue == 'TRUE') {
					$location.path("/home");
				}
		}).error(function(response){
				alert('An error occured. The server is not responding to the sent request. Please contact the system administrator. : ' + response);
		});
	}
}]);
//-------------------------------------------------------------------------------------------------
/*
*	Controller for logging in purposes
*/
angular.module('j3appApp').controller('signin', ['$scope', '$http', '$location', function($scope, $http, $location){ 
	$scope.signin = function() {
		if ($scope.uname != null && $scope.pword != null) {
			$http.get("http://localhost/j3safetysolutions/index.php/signin?username=" +  $scope.uname + "&password=" + $scope.pword).success(function(response) { 
				if (response.returnValue == 'FAILED') {
					alert(response.returnMessage);
				}
				else {
					document.cookie="username=" + response.username + "; path=/";
					window.location = "#/home";
				}
			}).error(function(response){
				alert('An error occured. The server is not responding to the sent request. Please contact the system administrator. Error detail: ' + response);
			});
		}
	}
}]);
//-------------------------------------------------------------------------------------------------

 
