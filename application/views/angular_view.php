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
<body ng-app="fileUpload" ng-controller="MyCtrl">
  <form name="myForm">
    <fieldset>
      <legend>Upload on form submit</legend>
      Username:
      <input type="text" name="userName" ng-model="username"  required>
      <i ng-show="myForm.userName.$error.required">*required</i>
	  <br>Password:
      <input type="text" name="passWord" ng-model="password"  required>
      <i ng-show="myForm.userName.$error.required">*required</i>
	  <br>First name:
      <input type="text" name="firstName" ng-model="firstname"  required>
      <i ng-show="myForm.userName.$error.required">*required</i>
	  <br>Middle name:
      <input type="text" name="middleName" ng-model="middlename"  required>
      <i ng-show="myForm.userName.$error.required">*required</i>
	  <br>Last name:
      <input type="text" name="lastName" ng-model="lastname"  required>
      <i ng-show="myForm.userName.$error.required">*required</i>
      <br>Photo:
      <input type="file" ngf-select ng-model="picFile" name="file"    
             accept="image/*" ngf-max-size="2MB" required
             ngf-model-invalid="errorFiles">
      <i ng-show="myForm.file.$error.required">*required</i><br>
      <i ng-show="myForm.file.$error.maxSize">File too large 
          {{errorFiles[0].size / 1000000|number:1}}MB: max 2M</i>
      <img ng-show="myForm.file.$valid" ngf-thumbnail="picFile" class="thumb"> <button ng-click="picFile = null" ng-show="picFile">Remove</button>
      <br>
      <button ng-disabled="!myForm.$valid" 
              ng-click="uploadPic(picFile)">Submit</button>
      <span class="progress" ng-show="picFile.progress >= 0">
        <div style="width:{{picFile.progress}}%" 
            ng-bind="picFile.progress + '%'"></div>
      </span>
      <span ng-show="picFile.result">Upload Successful</span>
      <span class="err" ng-show="errorMsg">{{errorMsg}}</span>
    </fieldset>
    <br>
  </form>
  <legend>All accounts</legend>
  <div class="container">
  <div class="col-lg-12 col-md-12">
    <table ng-controller="userController" class="table table-bordered table-condensed table-responsive">
      <thead>
        <tr>
          <th><center style="font-weight: bold;">USER ID</center></th>
          <th><center style="font-weight: bold;">USER NAME</center></th>
          <th><center style="font-weight: bold;">PASSWorD</center></th>
          <th><center style="font-weight: bold;">USER TYPE</center></th  >
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="account in accounts">
            <td>{{account.username}}</td>
            <td>{{training.firstname}}</td>
            <td>{{training.PASS_WORD}}</td>
            <td>{{training.USER_TYPE}}</td>
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
var app = angular.module('fileUpload', ['ngFileUpload']);

app.controller('MyCtrl', ['$scope', 'Upload', '$timeout', function ($scope, Upload, $timeout) {
	$scope.uploadPic = function(file) {
    file.upload = Upload.upload({
      url: 'signup',
      data: {file: file, username: $scope.username, password: $scope.password, firstname: $scope.firstname, middlename: $scope.middlename, lastname: $scope.lastname},
    }).success( function(data) {
		alert(data.username);
	});
	

    file.upload.then(function (response) {
      $timeout(function () {
        file.result = response.data;
      });
    }, function (response) {
      if (response.status > 0)
        $scope.errorMsg = response.status + ': ' + response.data;
    }, function (evt) {
      // Math.min is to fix IE which reports 200% sometimes
      file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
    });
    }
	function userController($scope,$http) {
       $scope.accounts = [];
       $http.get("src").success(function(data) { 
          $scope.accounts = data;
       }).error(function(data){
           alert(data);
       });
   }
}]);


</script>
</html>