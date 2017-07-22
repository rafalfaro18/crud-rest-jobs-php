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
    var dataObj={
        action : 'LEE',
        nombre: 'Rafa',

    };
    obj.getCustomers = function(){
        return $http.post('./api.php', Object.toparams(dataObj), config);
    }
    return obj;   
}]);

app.controller('listCtrl', function ($scope, services) {
    services.getCustomers().then(function(data){
        $scope.customers = data.data.response;
    });
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
}]);

