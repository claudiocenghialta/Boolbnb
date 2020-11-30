<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Sponsor;
use App\SponsorApartment;
use Braintree\Gateway;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

  public function index(Request $request) {

    $data = $request->all();
    // dd($data);
    $gateway = new Gateway([
      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')
  ]);

  $token = $gateway->ClientToken()->generate();
  // dd($token);
    return view('admin.payment',compact('data'), [
      'token' => $token
    ]);
  }

  public function paga(Request $request) {
    $data = $request->all();
      $gateway = new Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

      // $amount = $request->costo;
      $amount = Sponsor::where('id',$data['sponsor_id'])->pluck('costo')->first();
      // dd($amount);
      $nonce = $request->payment_method_nonce;

      $result = $gateway->transaction()->sale([
          'amount' => $amount,
          'paymentMethodNonce' => $nonce,
          'options' => [
              'submitForSettlement' => true
          ]
      ]);



      if ($result->success) {
          $transaction = $result->transaction;
          // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
          // return back()->with('success_message', 'Transaction succesSful. The ID is'. $transaction->id);
          $ora = Carbon::now();
          $ultimaDataFine = Carbon::parse(SponsorApartment::where('apartment_id',$request->apartment_id)->pluck('data_fine')->sortDesc()->first());
          if($ultimaDataFine->greaterThan($ora)){
              $request['data_inizio'] = $ultimaDataFine;
          } else {
              $request['data_inizio'] = $ora;
          };
          // aggiungo durata alla data inizio e calcolo data fine
          $durata = Sponsor::where('id',$request->sponsor_id)->pluck('durata')->first();
          $request['data_fine'] = Carbon::parse($request['data_inizio'])->addHours($durata);
          // scrivo dati su database e restituisco JSON di risposta
          $sponsorApartment = SponsorApartment::create($request->all());
          return redirect()->route('apartments.show', $data['apartment_id'])->with('success_message', 'Pagamento effettuato. Transazione n. '. $transaction->id);
      } else {
          $errorString = "";

          foreach($result->errors->deepAll() as $error) {
              $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
          }

          // $_SESSION["errors"] = $errorString;
          // header("Location: " . $baseUrl . "index.php");
          return back()->withErrors('An error occured with message '. $result->message);
      }

  }
}
