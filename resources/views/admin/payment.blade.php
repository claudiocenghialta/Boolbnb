@extends('layouts.app')
@section('content')
  {{-- prova payment FUNZIONAAAAAAAAAAAAA piango --}}
  @if (session('success_message'))
  <div class="alert alert-success">
    {{ session('success_message')}}
  </div>
  @endif
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
<div class="container">
  <form method="post" id="payment-form" action="{{ route('paga') }}">
    @csrf
    @method("POST")
      <section>
          <label for="amount">
              <span class="input-label">Amount</span>
              <div class="input-wrapper amount-wrapper">
                  <input id="amount" name="amount" type="tel" min="1" placeholder="amount" value="{{$data['costo']}}" disabled>
                  <input type="hidden" name="apartment_id" value="{{$data['apartment_id']}}">
                  <input type="hidden" name="costo" value="{{$data['costo']}}">
                  <input type="hidden" name="sponsor_id" value="{{$data['sponsor_id']}}">
              </div>
          </label>

          <div class="bt-drop-in-wrapper">
              <div id="bt-dropin"></div>
          </div>
      </section>

      <input id="nonce" name="payment_method_nonce" type="hidden" />
      <button class="button" type="submit"><span>Test Transaction</span></button>
  </form>
</div>

  <script src="https://js.braintreegateway.com/web/dropin/1.25.0/js/dropin.min.js"></script>
   <script>
       var form = document.querySelector('#payment-form');
       var client_token = "{{ $token }}";

       braintree.dropin.create({
         authorization: client_token,
         selector: '#bt-dropin',
         paypal: {
           flow: 'vault'
         }
       }, function (createErr, instance) {
         if (createErr) {
           console.log('Create Error', createErr);
           return;
         }
         form.addEventListener('submit', function (event) {
           event.preventDefault();

           instance.requestPaymentMethod(function (err, payload) {
             if (err) {
               console.log('Request Payment Method Error', err);
               return;
             }

             // Add the nonce to the form and submit
             document.querySelector('#nonce').value = payload.nonce;
             form.submit();
           });
         });
       });
   </script>
@endsection
