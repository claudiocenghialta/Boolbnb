# Replica delle funzionalità di AirBnB
Per realizzare questo sito abbiamo utilizzato:
    - Laravel
    - PHP
    - Javascript
    - Vue.js
    - HTML
    - CSS
    - Bootstrap
    - Chart.js
    - Braintree (gestione pagamenti)
    - Algolia (ricerca per località e mappe interattive)

## Principali funzionalità:

   ###  - Per utente che visualizza gli appartamenti:
        - ricerca degli appartamenti per città (tramite barra di ricerca Algolia)
        - filtrare risultati di ricerca in base a 
            - distanza in km dalla località
            - optionals e servizi inclusi negli appartamenti (es. WiFi, piscina, sauna, ecc...)
            - caratteristiche dell'appartamento (es. numero stanze, numero letti, numero bagni, metri quadrati, ecc...)
        - visualizzazione della pagina di dettagli dell'appartamento in cui visualizzare:
            - slideshow immagini
            - descrizione, optionals, servizi e caratteristiche dell'appartamento
            - visualizzazione mappa interattiva (servizio utilizzato -> Algolia)
            - possibilità di registrarsi al sito e contattare con un messaggio il proprietario dell'appartamento
        
   ###  - Per proprietario degli appartamenti:
        - gestione dei propri appartamenti con possibilità di rendere attivo/disattivo il singolo appartamento
        - creazione, modifica e cancellazione di ogni appartamento
        - visualizzazione delle statistiche (utilizzata libreria Chat.js) per ogni appartamento con:
            - numero di volte in cui l'appartamento è stato visualizzato da un possibile cliente suddivise per mese
            - numero di messaggi ricevuti suddivisi per mese
        - gestione inbox dei messaggi ricevuti ed inviati
        - possibilità di sponsorizzare l'appartamento acquistando uno o più pacchetti tra quelli disponibili (integrazione con sistema di pagamento Braintree)
            - gli appartamenti sponsorizzati vengono mostrati in evidenza nella homepage del sito, e vengono mostrati per primi nei risultati delle ricerche effettuate dagli utenti
        - Possibilità di personalizzare il proprio profilo utente con avatar e informazioni aggiuntive, oltre possibilità di cancellarsi con conseguente cancellazione dei propri dati utente, dei suoi appartamenti ed eliminazione di tutte le immagini relative dallo storage.
            
