





<script id="entry-template" type="text/x-handlebars-template">


      <div class="col-md-4 mb-3 p-2">
          <div class="card mb-3">

          <img class="card-img-top" src="{{immagini}}" alt="Card image cap" width="auto" height="220px">
          <div class="card-body">



            <p class="card-text">{{descrizione}}</p>
            <p class="card-text">{{indirizzo}}</p>
            <p class="card-text"><small class="text-muted"></small>Sponsorizzato: {{data_fine_sponsor}}
            </p>
            <p class="card-text"><small class="text-muted"></small>optionals: {{optional}}
            </p>

            <p class="card-text"><small class="text-muted">Ultimo aggiornamento: {{ updated_at }} </small></p>

          </div>
        </div>
      </div>


    </script>
