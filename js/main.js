/**
 * Created by donpage on 11/8/14.
 */
angular.module("pupApp", [])


    .controller("homeController", function ($scope, siteService) {
        $scope.testing = 'GOT TEST';
        siteService.doAnimations();
    })
    .controller("searchQ", function ($scope, siteService) {
        var currentDropDownPos = 0;
        $('#result' + (currentDropDownPos)).removeClass('selected');


        $scope.addTag = function (input) {
            siteService.addingTag(input);
        };

        $scope.enterSubmit = function () {

        };

        $scope.key = function ($event) {
            var resultsL = $('div.results').length -1;
            console.log(resultsL);

            if ($event.keyCode == 38) { //arrow key up
                $event.preventDefault();
                console.log("up arrow");
                $('#result' + (currentDropDownPos)).removeClass('selected');
                currentDropDownPos--;
                if (currentDropDownPos < 0){
                    currentDropDownPos = resultsL;
                }
                $('#result' + (currentDropDownPos)).addClass('selected');
            }
            else if ($event.keyCode == 40) { //arrow key down
                $event.preventDefault();
                console.log("down arrow");
                $('#result' + (currentDropDownPos)).removeClass('selected');
                currentDropDownPos++;
                if (currentDropDownPos > resultsL){
                    currentDropDownPos = 0;
                }
                $('#result' + (currentDropDownPos)).addClass('selected');

            }
            else if ($event.keyCode == 13){ //enter key
                var theResult = document.querySelector('#result'+(currentDropDownPos)).innerHTML;
                //each result from the search feature is track by their index, so whatever is first in this index will be submitted.
                console.log('currently adding',theResult);
                siteService.addNewDog(theResult);
            } else {
                $('#result' + (currentDropDownPos)).removeClass('selected');
                console.log('not up or down key resetting');
                currentDropDownPos = 0;
                $('#result' + (currentDropDownPos)).addClass('selected');
            }

        };


    })
    .controller('tagController', function ($scope, siteService) {
        $scope.tagArray = siteService.getTagArray();

        $scope.deleteTag = function (idx) {
            console.log(idx);
            siteService.deletingTag(idx);
        }
    })

    .controller('autoController', function ($scope, siteService) {
        $scope.dogNameArray = siteService.getDogNameArray();

        $scope.newDog = function (dogName) {
            siteService.addNewDog(dogName);
            console.log($scope.searchInput, 'SEARCH');
            $('#searchQ').val('')
                .trigger('input')
                .focus();


        }
    })