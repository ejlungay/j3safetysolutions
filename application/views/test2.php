<!DOCTYPE html >
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Arjunphp.com</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .thumb {
			width: 24px;
			height: 24px;
			float: none;
			position: relative;
			top: 7px;
		}

		form .progress {
			line-height: 15px;
		}
		}

		.progress {
			display: inline-block;
			width: 100px;
			border: 3px groove #CCC;
		}

		.progress div {
			font-size: smaller;
			background: orange;
			width: 0;
		}
    </style>
</head>
<body>
  
  <legend>All accounts</legend>
  <div class="container" ng-app="myapp">
  <div class="col-lg-12 col-md-12">
    <table  ng-controller="userController" class="table table-bordered table-condensed table-responsive">
      <thead>
        <tr>
          <th><center style="font-weight: bold;">USER ID</center></th>
          <th><center style="font-weight: bold;">USER NAME</center></th>
          <th><center style="font-weight: bold;">PASSWorD</center></th>
          <th><center style="font-weight: bold;">USER TYPE</center></th>
		   <th><center style="font-weight: bold;">Image path</center></th>
		   <th><center style="font-weight: bold;">Image view</center></th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="account in accounts">
            <td>{{account.username}}</td>
            <td>{{account.firstname}}</td>
            <td>{{account.password}}</td>
            <td>{{account.user_type}}</td>
            <td>{{account.image}}</td>
            <td><img width="100" height="100" ng-src="http://localhost/{{account.image}}"/></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.js"></script> 
<script src="https://angular-file-upload.appspot.com/js/ng-file-upload-shim.js"></script> 
<script src="https://angular-file-upload.appspot.com/js/ng-file-upload.js"></script> 
<script type="text/javascript">
	//inject angular file upload directives and services.
	var app = angular.module('myapp', []);
	app.controller('userController', function($scope, $http) {
		$scope.src = '';
		$scope.accounts = [];
		$http.get('src').success(function(data) {
			$scope.accounts = data;
			var temp = $scope.accounts.image;
			$scope.accounts.image = 'http://localhost/' + $temp;
		});
	});
</script>
</html>