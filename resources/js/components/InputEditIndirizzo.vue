<template>
<div>
<input type="text" id="input-map" name="indirizzo" class="form-control"/>

<div>
<input type="hidden"  name="lat" class="form-control" :value="latitude" />
<input type="hidden"  name="lng" class="form-control" :value="longitude" />

</div>
</div>




</template>

<script>
    export default {
    props:['ind'],
        data(){
            return{
            latitude: '',
            longitude: '',

            };
        },
        mounted() {
        console.log(ind);
        var places = require('places.js');
        var self = this;
        (function() {
        var placesAutocomplete = places({
            appId: 'pl3L7TF7T3Q6',
            apiKey: '4b8aa1d10ced4e6a8b8c3fb1dc58072e',
            container: document.querySelector('#input-map')
        }).configure({
            type:'address'
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
