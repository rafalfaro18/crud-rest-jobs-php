var x;
Object.toparams = function ObjecttoParams(obj) {
    var p = [];
    for (var key in obj) {
        p.push(key + '=' + encodeURIComponent(obj[key]));
    }
    return p.join('&');
};

angular.module('demo', [])
.controller('Hello', function($scope, $http) {
    var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            };
    var dataObj={
    	action : 'LEE',
    	nombre: 'Rafa',

    };
    $http.post('./api.php', Object.toparams(dataObj), config)
        .then(function(response) {
            $scope.dptos = response.data;
            //x=response;
            console.log(response);
        });

});