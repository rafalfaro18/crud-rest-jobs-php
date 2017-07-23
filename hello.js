Object.toparams = function ObjecttoParams(obj) {
    var p = [];
    for (var key in obj) {
        p.push(key + '=' + encodeURIComponent(obj[key]));
    }
    return p.join('&');
};

var app = angular.module("myApp", ["ngRoute"]);

app.factory("services", ['$http', function($http) {
    var obj = {};
    var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            };
    obj.getCustomers = function(){
        var dataObj={
        action : 'LEE',
        };
        return $http.post('./api.php', Object.toparams(dataObj), config);
    }

    obj.getCustomer = function(customerID){
        var dataObj={
        action : 'LEEUNO',
        id : customerID,
        };
        return $http.post('./api.php', Object.toparams(dataObj), config);
    }

    obj.delCustomers = function(newid){
        var dataObj={
        action: 'DEL',
        id : newid,
        };
        return $http.post('./api.php', Object.toparams(dataObj), config);
    }

    return obj;   
}]);

app.controller('listCtrl', function ($scope, services) {
    services.getCustomers().then(function(data){
        $scope.customers = data.data.response;
    });

});

app.controller('editCtrl', function ($scope, $rootScope, $location, $routeParams, services, customer) {
    
    var customerID = $routeParams.customerID;
       $rootScope.title = (customerID == "0") ? 'Add Customer' : 'Edit Customer';
        $scope.buttonText = (customerID == "0") ? 'Add New Customer' :  'Update Customer';
      var original = customer.data;
      original._id = customerID;
      $scope.customer = angular.copy(original);
      $scope.customer._id = customerID;

      $scope.isClean = function() {
        return angular.equals(original, $scope.customer);
      }

      $scope.deleteCustomer = function(customer) {
        $location.path('/');
        if(confirm("Are you sure to delete customer number: "+$scope.customer._id)==true)
        services.delCustomers($scope.customer._id);
      };
});



app.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "main.html"
    })
    .when("/candidates", {
        templateUrl : "candidates.html",
        controller: 'listCtrl'
    })
    .when("/edit-customer/:customerID", {
        templateUrl : "edit-candidate.html",
        controller: 'editCtrl',
        resolve: {
          customer: function(services, $route){
            var customerID = $route.current.params.customerID;
            return services.getCustomer(customerID);
          }
        }
    })
}]);

