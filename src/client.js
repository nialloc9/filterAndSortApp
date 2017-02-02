var app = angular.module('app', ['ngRoute']);

/*Application config routes.*/
app.config(function($routeProvider){
  $routeProvider.when('/', {
    templateUrl: 'templates/landingPage.html'
  }).otherwise({
    redirectTo: '/'
  });
});

app.controller('landingPageCtrl', ['$scope', '$http', function($scope, $http){

    //set filter scope values
    $scope.filterType = '';
    $scope.filterValue = '';

    /**
     * fetches hotel data from backend
     * uses angular $http serveice to request the data
     */
    $scope.fetchHotelData = function(){
        $http({
            url: './server/controller/getHotelData.controller.php',
            method: "GET",
            params: {task: "FETCH_HOTEL_DATA", filterType: $scope.filterType, filterValue: $scope.filterValue}
        }).then(function successCallback(response){
            $scope.establishments = response.data;
        }, function errorCallback(response){
            //console.log(response)
        });
    };

    //set sorting scope values
    $scope.establishmentSortBy = 'UserRating';
    $scope.establishmentSortByIsReverse = false;
    $scope.establishmentSortByBtnName = 'Descending';

    //reverse sort scope values
    $scope.reverseButtunClick = function(){
        $scope.establishmentSortByIsReverse = !$scope.establishmentSortByIsReverse;
        $scope.establishmentSortByBtnName = ($scope.establishmentSortByIsReverse)?'Ascending':'Descending';
    };

}]);

/**objectOrderBy - Custom filter to sort objects by object property.
 * First checks if data passed is an object. If it's not it returns it back.
 * If it is an object creates a new array with the values from the object.
 * After it makes use of the Array .sort method to arrange the new array in the order.
 * A comparison function is used to compare the attributes.
 * During comparision the attr is parsed as a float and based on whether the order is true or false it decides how to compare.
 * Array is returned in new sorted format.
 */

app.filter('objectOrderBy', function(){
    return function(data, attr, order){
        if(!angular.isObject(data)){ return data } //checks if data is an object

        var dataArray = [];

        for(var key in data){
            dataArray.push(data[key])
        }

        dataArray.sort(function(a, b){ //comparision function
            a = parseFloat(a[attr]);
            b = parseFloat(b[attr]);
            return (order)?b - a:a - b;
        })


        return dataArray;
    }
});