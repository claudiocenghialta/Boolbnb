<template>
<div>


<input type="search" id="inputMap" name="indirizzo" class="form-control"  placeholder="Dove Vuoi Cercare?" />
<input type="hidden" id="lat" :value="latitude" name="lat" class="form-control" placeholder="Dove Vuoi Cercare?" />
<input type="hidden" id="lng" :value="longitude" name="lng" class="form-control" placeholder="Dove Vuoi Cercare?" />
<input type="hidden" id="controllerLat" :value="latitude"  class="form-control" placeholder="" />
<input type="hidden" id="controllerLng" :value="longitude"  class="form-control" placeholder="" />

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
            container: document.querySelector('#inputMap')
        }).configure({
            type:'city'
        });
        var markers = [];

        if(self.$refs.controllerLat !== ''){
            if(self.$refs.controllerLat == self.$refs.lat){
                self.latitude = self.$refs.controllerLat;
            }else{
                boh();
            }
        } else {
             boh();
        }

        placesAutocomplete.on('suggestions', handleOnSuggestions );
        placesAutocomplete.on('change', handleOnChange);

        function boh() {
            self.latitude = self.$refs.controllerLat.val();

            self.longitude = self.$refs.controllerLng.val();
        }

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
