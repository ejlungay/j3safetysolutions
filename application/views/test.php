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
        tr:hover td {
          color: yellow;
          background: gray;
        }
    </style>
</head>
<body ng-app>
<!-- ng-app : which tells the Angular framework to parse data from this div -->
<div class="container">
  <h1>Trainings</h1>
  <div class="col-lg-12 col-md-12">
    <table ng-controller="userController" class="table table-bordered table-condensed table-responsive">
      <thead>
        <tr>
          <th><center style="font-weight: bold;">USER ID</center></th>
          <th><center style="font-weight: bold;">USER NAME</center></th>
          <th><center style="font-weight: bold;">PASSWorD</center></th>
          <th><center style="font-weight: bold;">Image</center></th  >
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="training in trainings">
            <td>{{training.username}}</td>
            <td>{{training.firstname}}</td>
            <td>{{training.image}}</td>
            <td><img ng-src="data:image/JPEG;base64,{{image}}"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="container">
  <h1>Upload Test</h1>
  <div class="col-lg-12 col-md-12">

      <input type='file' accept="image/*" name='file' id='file'/>
  </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.min.js"></script> 
<script type="text/javascript">
   function userController($scope,$http) {
       $scope.trainings = [];
       $http.get("src").success(function(data) { 
          $scope.trainings = data;
       }).error(function(data){
           alert(data);
       });
   }
</script>
</html>