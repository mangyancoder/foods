<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<body>

<div ng-app="myApp" ng-controller="customersCtrl">

<table>
  <tr ng-repeat="x in names">
    <td>{{ x.package_name }}</td>
    <td>{{ x.package_description }}</td>
    
  </tr>
</table>

</div>

<script>
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
    $http.get("<?=base_url('Home/sample')?>")
    .then(function (response) {$scope.names = response.data.names;});
});
</script>

</body>
</html>
