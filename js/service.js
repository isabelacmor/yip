/**
 * Created by donpage on 11/8/14.
 */

angular.module("pupApp")
    .service("siteService", function(){

        var tagArray = [

        ];

        var dogNameArray = [
                "Affenpinscher",
                "Afghan Hound",
                "Airedale Terrier",
                "Akita",
                "Alaskan Malamute",
                "American English Coonhound",
                "American Eskimo Dog",
                "American Foxhound",
                "American Staffordshire Terrier",
                "American Water Spaniel",
                "Anatolian Shepherd Dog",
                "Australian Cattle Dog",
                "Australian Shepherd",
                "Australian Terrier",
                "Basenji",
                "Basset Hound",
                "Beagle",
                "Bearded Collie",
                "Beauceron",
                "Bedlington Terrier",
                "Belgian Malinois",
                "Belgian Sheepdog",
                "Belgian Tervuren",
                "Bernese Mountain Dog",
                "Bichon Frise",
                "Black Russian Terrier",
                "Black and Tan Coonhound",
                "Bloodhound",
                "Bluetick Coonhound",
                "Border Collie",
                "Border Terrier",
                "Borzoi",
                "Boston Terrier",
                "Bouvier des Flandres",
                "Boxer",
                "Boykin Spaniel",
                "Briard",
                "Brittany",
                "Brussels Griffon",
                "Bull Terrier",
                "Bulldog",
                "Bullmastiff",
                "Cairn Terrier",
                "Canaan Dog",
                "Cane Corso",
                "Cavalier King Charles Spaniel",
                "Cesky Terrier",
                "Chesapeake Bay Retriever",
                "Chihuahua",
                "Chinese Crested",
                "Chinese Shar-Pei",
                "Chinook",
                "Chow Chow",
                "Clumber Spaniel",
                "Cocker Spaniel",
                "Collie",
                "Corgi",
                "Coton de Tulear",
                "Curly-Coated Retriever",
                "Dachshund",
                "Dalmatian",
                "Dandie Dinmont Terrier",
                "Doberman Pinscher",
                "Dogue de Bordeaux",
                "English Cocker Spaniel",
                "English Foxhound",
                "English Setter",
                "English Springer Spaniel",
                "English Toy Spaniel",
                "Entlebucher Mountain Dog",
                "Field Spaniel",
                "Finnish Lapphund",
                "Finnish Spitz",
                "Flat-Coated Retriever",
                "French Bulldog",
                "German Pinscher",
                "German Shepherd Dog",
                "German Shorthaired Pointer",
                "German Wirehaired Pointer",
                "Giant Schnauzer",
                "Glen of Imaal Terrier",
                "Golden Retriever",
                "Gordon Setter",
                "Great Dane",
                "Great Pyrenees",
                "Greater Swiss Mountain Dog",
                "Greyhound",
                "Harrier",
                "Havanese",
                "Ibizan Hound",
                "Icelandic Sheepdog",
                "Irish Red and White Setter",
                "Irish Setter",
                "Irish Terrier",
                "Irish Water Spaniel",
                "Irish Wolfhound",
                "Italian Greyhound",
                "Japanese Chin",
                "Keeshond",
                "Kerry Blue Terrier",
                "Komondor",
                "Kuvasz",
                "Labrador Retriever",
                "Lakeland Terrier",
                "Leonberger",
                "Lhasa Apso",
                "Lowchen",
                "Maltese",
                "Manchester Terrier",
                "Mastiff",
                "Miniature Bull Terrier",
                "Miniature Pinscher",
                "Miniature Schnauzer",
                "Neapolitan Mastiff",
                "Newfoundland",
                "Norfolk Terrier",
                "Norwegian Buhund",
                "Norwegian Elkhound",
                "Norwegian Lundehund",
                "Norwich Terrier",
                "Nova Scotia Duck Tolling Retriever",
                "Old English Sheepdog",
                "Otterhound",
                "Papillon",
                "Parson Russell Terrier",
                "Pekingese",
                "Petit Basset Griffon Vendeen",
                "Pharaoh Hound",
                "Plott",
                "Pointer",
                "Polish Lowland Sheepdog",
                "Pomeranian",
                "Poodle",
                "Portuguese Podengo Pequeno",
                "Portuguese Water Dog",
                "Pug",
                "Puli",
                "Pyrenean Shepherd",
                "Rat Terrier",
                "Redbone Coonhound",
                "Rhodesian Ridgeback",
                "Rottweiler",
                "Russell Terrier",
                "Saluki",
                "Samoyed",
                "Schipperke",
                "Scottish Deerhound",
                "Scottish Terrier",
                "Sealyham Terrier",
                "Shetland Sheepdog",
                "Shiba Inu",
                "Shih Tzu",
                "Siberian Husky",
                "Silky Terrier",
                "Skye Terrier",
                "Smooth Fox Terrier",
                "Soft Coated Wheaten Terrier",
                "Spinone Italiano",
                "St. Bernard",
                "Staffordshire Bull Terrier",
                "Standard Schnauzer",
                "Sussex Spaniel",
                "Swedish Vallhund",
                "Tibetan Mastiff",
                "Tibetan Spaniel",
                "Tibetan Terrier",
                "Toy Fox Terrier",
                "Treeing Walker Coonhound",
                "Vizsla",
                "Weimaraner",
                "Welsh Springer Spaniel",
                "Welsh Terrier",
                "West Highland White Terrier",
                "Whippet",
                "Wire Fox Terrier",
                "Wirehaired Pointing Griffon",
                "Wirehaired Vizsla",
                "Xoloitzcuintli",
                "Yorkshire Terrier"
        ];


        this.getTagArray = function(){
            console.log(tagArray);
            return tagArray;
        };

        this.addingTag = function(input){
            console.log('adding:', input);
            tagArray.push({name: input});
        };

        this.deletingTag = function(idx){
            tagArray.splice(idx, 1);
        };

        this.getDogNameArray = function(){
            return dogNameArray;
        };

        this.addNewDog = function(dogName){
            if(tagArray.length >= 3){
                return;
            }
            for(var i = 0; i < tagArray.length; i++){
//                console.log(tagArray[i].name);
                if (dogName == tagArray[i].name){
                    console.log('this dog is already made');
                    return;
                }

            }
            console.log(dogName);
            tagArray.push({name: dogName})
        }


        // handles the click event, sends the query
        /*function getQuery() {
            var stringlist = tagArray.toString();
            console.log("searchList...getting query: " + stringlist);

            $.ajax({
              url: "../php/phptest.php",
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

        // handles the click event, uploads image
        $(document).ready ( function () {
          $( '#imageForm' ).submit( function( e ) {
          e.preventDefault();

          var stringlist = tagArray.toString();
          console.log("searchList...getting query: " + stringlist);

          // Create a FormData instance 
          var formData = new FormData( $( '#imageForm' )[0] );
          // Add the file 
          formData.append("breeds", stringlist);
            
            $.ajax( {
              url: '../php/upload.php',
              type: 'POST',
              data: formData,
              processData: false,
              contentType: false,
              success: function (data) {
                console.log(data);
                alert( "Image uploaded successfully. Click OK to go home." );
                window.location.replace("http://www.puppy.scriptevolution.com/index2.html");
              }
            });
          });
        });*/



    });