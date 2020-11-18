<template>
<input type="search" id="input-map" name="indirizzo" class="form-control" placeholder="Where are we going?" />

</template>

<script>
    export default {
        mounted() {
        var places = require('places.js');
        (function() {
        var placesAutocomplete = places({
            appId: 'pl3L7TF7T3Q6',
            apiKey: '4b8aa1d10ced4e6a8b8c3fb1dc58072e',
            container: document.querySelector('#input-map')
        }).configure({
            type:'address'
        });

        var markers = [];
        var indirizzo = {
            lat:'',
            lng:''
        };

        placesAutocomplete.on('suggestions', handleOnSuggestions );
        placesAutocomplete.on('change', handleOnChange);
            console.log(indirizzo);
        function handleOnSuggestions(e) {
            markers = [];
            e.suggestions.forEach(addMarker);
        }

        function handleOnChange(e) {
        markers
        .forEach(function(marker, markerIndex) {
          if (markerIndex === e.suggestionIndex) {
            markers = [marker];
            indirizzo.lng = marker._latlng.lng;
            indirizzo.lat = marker._latlng.lat;
          }
          });
        }

        function addMarker(suggestion) {
            var marker = L.marker(suggestion.latlng);
            markers.push(marker);
        }

        })();

                }
            }
</script>
