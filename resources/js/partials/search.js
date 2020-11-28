var $ = require('jquery');
const Handlebars = require("handlebars");
$(document).ready(function(){

$("#cerca").on('click', function() {
    ricerca();
} )

$("input").on('keydown', function() {
    if ( event.which == 13 || event.keycode == 13){
    ricerca();
    }
} )



});


function ricerca(){
    $(".elenco").empty();
    var clat = $('#c-lat').val();
    var clng = $('#c-lng').val();
    if ($('#inputMap').val() == '') {
        $('#controllerLat').val(clat);
        $('#controllerLng').val(clng);
    }else {
        var clat = $('#lat').val();
        var clng = $('#lng').val();
    };

    var optionalsArray = [];

    $("input[name='optionals[]']:checked").each(function (){
        optionalsArray.push($(this).val());
    });
        optionals = optionalsArray.join(); // l'array con gli id dei servizi viene mandato in forma di stringa. nel backend verrà ritradotto in un array

    var distanza = $('#radius').val();
    if (distanza < 1) {
        distanza = '20';
    }

    $.ajax(
        {
            url: "http://localhost:8000/api/search",
            method: "GET",
            data:{
                numero_stanze: $('#numero_stanze').val(),
                numero_letti: $('#numero_letti').val(),
                numero_bagni: $('#numero_bagni').val(),
                optionals: optionals,
                raggioKm: distanza,
                lat: clat,
                lng: clng,
            },

            success: function(risposta) {
                var source = $('#entry-template').html();

                var template = Handlebars.compile(source);

                $.each(risposta,function(i,apartment) {
                    var data = new Date(Date.parse(apartment.updated_at));

                    if (apartment.immagini[0] == null) {
                        var img = 'placeholders/placeholder-apartment.jpg';
                    } else {
                        if (apartment.immagini[0].substr(0,4)=='http') {
                            var img = apartment.immagini[0];
                        } else {
                            var img = 'storage/'+ apartment.immagini[0];
                        }
                    }

                    var op = '';

                    var opt = '<div class="b"><i class="fas fa-check text-info"></i> <span class="optional">';
                    for (var y = 0; y < apartment.optionals.length; y++) {
                       op += opt + apartment.optionals[y] + "</span></div>";
                   }

                    var context = {
                        titolo: apartment.titolo,
                        immagini: img,
                        descrizione: apartment.descrizione,
                        indirizzo: apartment.indirizzo,
                        updated_at: data.toLocaleString(),
                        // optional: printOptional(apartment.optionals)
                        optional: op,
                        id: apartment.id
                   }
                    var html = template(context);
                    $('.elenco').append(html);
                });
            },
            error: function () {
            alert("E' avvenuto un errore");
            }
        }

    );
}
