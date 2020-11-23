<template>
<div>
<label for="prova"><h2>PROVA IL TUO COVO</h2></label>
<input type="search" id="map" name="prova" class="form-control" placeholder="Dove Vuoi Cercare?" />
</div>




</template>

<script>
    export default {
        data(){
            return{
            latitude: '',
            longitude: ''
            };
        },
        mounted() {
        var places = require('places.js');
        var self = this;
        (function() {
        var placesAutocomplete = places({
            appId: 'pl3L7TF7T3Q6',
            apiKey: '4b8aa1d10ced4e6a8b8c3fb1dc58072e',
            container: document.querySelector('#map')
        }).configure({
            type:'city'
        });

        var markers = [];

        placesAutocomplete.on('suggestions', handleOnSuggestions );
        placesAutocomplete.on('change', handleOnChange);
        function handleOnSuggestions(e) {
            markers = [];
            e.suggestions.forEach(addMarker);
        }

        function handleOnChange(e) {
        markers
        .forEach(function(marker, markerIndex) {
          if (markerIndex === e.suggestionIndex) {
            markers = [marker];
            self.longitude = marker._latlng.lng;
            self.latitude = marker._latlng.lat;

            var lat2 = '41.8948';
            var lng2 = '12.4853';
            var lat1 =  self.latitude;
            var lng1 =  self.longitude;
            console.log(lat1 + "lat");
            console.log(lng1 + "lng");

            function degreesToRadians(degrees){
                return degrees * Math.PI / 180;
            }

            var distanceInMeters = getDistanceBetweenPoints(lat1, lng1, lat2, lng2);
            console.log(distanceInMeters);
            function getDistanceBetweenPoints(lat1, lng1, lat2, lng2){

            let R = 6378137;
            let dLat = degreesToRadians(lat2 - lat1);
            let dLong = degreesToRadians(lng2 - lng1);
            let a = Math.sin(dLat / 2)
                    *
                    Math.sin(dLat / 2)
                    +
                    Math.cos(degreesToRadians(lat1))
                    *
                    Math.cos(degreesToRadians(lat1))
                    *
                    Math.sin(dLong / 2)
                    *
                    Math.sin(dLong / 2);

            let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            let distance = R * c;

            return distance;

            }


          }
          });
        }

        function addMarker(suggestion) {
            var marker = L.marker(suggestion.latlng);
            markers.push(marker);
        }

        })();

        },

    }
</script>
