<template>
    <div class="container">
        <div id="mapid"></div>

    </div>

</template>
<style>
  #mapid {height: 300px};
</style>
<script>
    export default {
        mounted() {
         var mymap = L.map('mapid').setView([0, 0], 8);
         L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
             attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
             maxZoom: 18,
             id: 'mapbox/streets-v11',
             tileSize: 512,
             zoomOffset: -1,
             accessToken: 'pk.eyJ1IjoibWFnaWNvaXZhbiIsImEiOiJja2hua3Bqa2Qwcnp0MnZteHhubWUwaDJ2In0.INnPethjepk0oDptkcMG_A'
         }).addTo(mymap);
         var marker = L.marker([51.5, -0.09]).addTo(mymap);

         //API x lat lng by db

        }
    }
</script>
