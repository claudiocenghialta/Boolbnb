





<script id="entry-template" type="text/x-handlebars-template">


      <div class="card card-search mb-3">


          <img class="card-img-top" src="{{immagini}}" alt="Card image cap" width="auto" height="180px">
          <div class="card-body">
              <h5 class="card-title"><a href="apartments/{{id}}">{{{titolo}}}</a></h5>
              <div class="optional-div mb-2">
                     {{{optional}}}
              </div>
              <div class="decrizione-div">
                <p class="card-text testo-descrizione">{{descrizione}}</p>
              </div>
              <small class="card-text"><i class="fas fa-map-marker-alt text-primary"></i> {{ indirizzo }}</small>

          </div>
      </div>


    </script>
