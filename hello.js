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
    };

    obj.getCustomer = function(customerID){
        var dataObj={
        action : 'LEEUNO',
        id : customerID,
        };
        return $http.post('./api.php', Object.toparams(dataObj), config);
    };

    obj.delCustomers = function(newid){
        var dataObj={
        action: 'DEL',
        id : newid,
        };
        return $http.post('./api.php', Object.toparams(dataObj), config);
    };

    obj.insertCustomer = function (newnombre, newapellido) {
        var dataObj={
        action: 'ADD',
        nombre : newnombre,
        apellido: newapellido,
        };
        return $http.post('./api.php', Object.toparams(dataObj), config).then(function (results) {
            return results;
        });
    };

    obj.updateCustomer = function (newid,newnombre, newapellido) {
        var dataObj={
        action: 'UPD',
        id: newid,
        apellido: newapellido,
        nombre : newnombre,
        };
        return $http.post('./api.php', Object.toparams(dataObj), config).then(function (status) {
            return status.data;
        });
    };

    ///////////////////////////

    obj.getJobs = function(){
        var dataObj={
        action : 'LEEPOS',
        };
        return $http.post('./api.php', Object.toparams(dataObj), config);
    };

    obj.getJob = function(customerID){
        var dataObj={
        action : 'LEEUNOPOS',
        id : customerID,
        };
        return $http.post('./api.php', Object.toparams(dataObj), config);
    };

    obj.delJobs = function(newid){
        var dataObj={
        action: 'DELPOS',
        id : newid,
        };
        return $http.post('./api.php', Object.toparams(dataObj), config);
    };

    obj.insertJob = function (newnombre, newdescripcion) {
        var dataObj={
        action: 'ADDPOS',
        nombre : newnombre,
        descripcion: newdescripcion,
        };
        return $http.post('./api.php', Object.toparams(dataObj), config).then(function (results) {
            return results;
        });
    };

    obj.updateJob = function (newid,newnombre, newdescripcion) {
        var dataObj={
        action: 'UPDPOS',
        id: newid,
        descripcion: newdescripcion,
        nombre : newnombre,
        };
        return $http.post('./api.php', Object.toparams(dataObj), config).then(function (status) {
            return status.data;
        });
    };

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
      if(customerID!="0"){
          var original = customer.data.response;
          original._id = customerID;
          $scope.customer = angular.copy(original);
          $scope.customer._id = customerID;
      }else{
         $scope.customer=null;
      }

      $scope.isClean = function() {
        return angular.equals(original, $scope.customer);
      }

      $scope.deleteCustomer = function(customer) {
        $location.path('/');
        if(confirm("Are you sure to delete customer number: "+$scope.customer._id)==true)
        services.delCustomers($scope.customer._id);
      };

      $scope.saveCustomer = function(customer) {
        $location.path('/');
        if (customerID != "0") {
            services.updateCustomer(customer._id, customer.name, customer.lastname);
        }
        else {
            services.insertCustomer(customer.name, customer.lastname);
        }
    };
});

///////////////////////////

app.controller('listCtrlPos', function ($scope, services) {
    services.getJobs().then(function(data){
        $scope.customers = data.data.response;
    });
});

app.controller('editCtrlPos', function ($scope, $rootScope, $location, $routeParams, services, customer) {
    
    var customerID = $routeParams.customerID;
       $rootScope.title = (customerID == "0") ? 'Add Position' : 'Edit Position';
        $scope.buttonText = (customerID == "0") ? 'Add New Position' :  'Update Position';
      if(customerID!="0"){
          var original = customer.data.response;
          original._id = customerID;
          $scope.customer = angular.copy(original);
          $scope.customer._id = customerID;
      }else{
         $scope.customer=null;
      }

      $scope.isClean = function() {
        return angular.equals(original, $scope.customer);
      }

      $scope.deleteJob = function(customer) {
        $location.path('/');
        if(confirm("Are you sure to delete job number: "+$scope.customer._id)==true)
        services.delJobs($scope.customer._id);
      };

      $scope.saveJob = function(customer) {
        $location.path('/');
        if (customerID != "0") {
            services.updateJob(customer._id, customer.name, customer.description);
        }
        else {
            services.insertJob(customer.name, customer.description);
        }
    };
});

app.config(['$routeProvider', function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "main.html"
    })
    .when("/candidates", {
        title: 'Candidates',
        templateUrl : "candidates.html",
        controller: 'listCtrl'
    })
    .when("/edit-customer/:customerID", {
         title: 'Edit Candidates',
        templateUrl : "edit-candidate.html",
        controller: 'editCtrl',
        resolve: {
          customer: function(services, $route){
            var customerID = $route.current.params.customerID;
            return services.getCustomer(customerID);
          }
        }
    })
    .when("/jobs", {
        title: 'Jobs',
        templateUrl : "jobs.html",
        controller: 'listCtrlPos'
    })
    .when("/edit-job/:customerID", {
         title: 'Edit Jobs',
        templateUrl : "edit-jobs.html",
        controller: 'editCtrlPos',
        resolve: {
          customer: function(services, $route){
            var customerID = $route.current.params.customerID;
            return services.getJob(customerID);
          }
        }
    })
}]);

