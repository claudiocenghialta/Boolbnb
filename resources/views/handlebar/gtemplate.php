





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
              <p class="card-text"><small class="text-muted">Ultimo aggiornamento: {{ updated_at }}</small></p>
          </div>
      </div>


    </script>
