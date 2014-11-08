var searchList = [];

function removeFromList(id) {
    //remove from UI
    var elem = document.getElementById(id);
    elem.parentNode.removeChild(elem);

    //remove from searchList
    var index = id.split("-")[1] - 1;
    console.log("index: " + index);

    if(index != -1) {
        searchList.splice(index, 1);
    }

    console.log("new searchList: " + searchList);
    updateResults();
}

function updateResults() {

    $('#outputcontent').html("");

    for(var i = 0; i < searchList.length; i++) {
        var thehtml = '<ul class="listItem" id="el-' + (i+1) + '"><strong>Breed:</strong> ' + searchList[i] + '<a style="float:right" href="#" onclick="removeFromList(&quot;el-' + (i+1) + '&quot;)">Remove</a></ul>';
        $('#outputcontent').append(thehtml);
    }
}

$(function(){
  var breeds = [
    { value: 'Shiba Inu', data: 'Shiba Inu' },
    { value: 'Shih Tzu', data: 'Shih Tzu' },
    { value: 'Collie', data: 'Collie' },
    { value: 'Corgi', data: 'Corgi' },
    { value: 'Husky', data: 'Husky' },
  ];
  
  // setup autocomplete function pulling from currencies[] array
  $('#autocomplete').autocomplete({
    lookup: breeds,
    onSelect: function (suggestion) {
        console.log("term: " + suggestion.value + ", " + suggestion.data);


      if(searchList.length >= 3) {
        alert("You can only add 3 breeds :(");
      } else if (!searchList.contains(suggestion.value)) {
        searchList.push(suggestion.value);
        searchList.sort();
      }

      updateResults();

      console.log("searchList: " + searchList);
    }
  });
});


// handles the click event, sends the query
function getQuery() {
    var stringlist = searchList.toString();
    console.log("searchList...getting query: " + stringlist);

    $.ajax({
      url: "phptest.php",
      type: "POST",
      data: { breeds: stringlist }, //optional
      success: function(result) {
          //do something after you receive the result
          console.log(result);
          $('#outputresults').html(result);

          //clear the list of breeds searched for
          //searchList = [];
          //updateResults();
      }
    })
}

Array.prototype.contains = function ( obj ) {
   for (i in this) {
       if (this[i] === obj) return true;
   }
   return false;
}