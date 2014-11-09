/**
 * Created by donpage on 11/8/14.
 */
angular.module("pupApp", ["ngRoute"])
    .config(function ($routeProvider) {
        $routeProvider
            .when("/", {
                controller: "homeController",
                templateUrl: "parts/home.html"
            })
            .otherwise({
                redirectTo: "/"
            })

    })

    .controller("homeController", function ($scope, $routeParams, siteService) {
        $scope.testing = 'GOT TEST';
    })
    .controller("searchQ", function($scope,$routeParams, siteService){
        $scope.addTag = function(input){
            siteService.addingTag(input);
        };
    })
    .controller('tagController', function($scope, $routeParams, siteService){
        $scope.tagArray = siteService.getTagArray();

        $scope.deleteTag = function(idx){
            console.log(idx);
            siteService.deletingTag(idx);
        }
    })

    .controller('autoController', function($scope, $routeParams, siteService){
        $scope.dogNameArray = siteService.getDogNameArray();

        $scope.newDog = function(dogName){
            siteService.addNewDog(dogName);

        }
    })

