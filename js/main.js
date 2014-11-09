/**
 * Created by donpage on 11/8/14.
 */
angular.module("pupApp", [])


    .controller("homeController", function ($scope, siteService) {
        $scope.testing = 'GOT TEST';
        siteService.doAnimations();
    })
    .controller("searchQ", function($scope, siteService){
        $scope.addTag = function(input){
            siteService.addingTag(input);

        };
    })
    .controller('tagController', function($scope, siteService){
        $scope.tagArray = siteService.getTagArray();

        $scope.deleteTag = function(idx){
            console.log(idx);
            siteService.deletingTag(idx);
        }
    })

    .controller('autoController', function($scope, siteService){
        $scope.dogNameArray = siteService.getDogNameArray();

        $scope.newDog = function(dogName){
            siteService.addNewDog(dogName);
            console.log($scope.searchInput, 'SEARCH');
            $('#searchQ').val('')
                .trigger('input')
                .focus();


        }
    })