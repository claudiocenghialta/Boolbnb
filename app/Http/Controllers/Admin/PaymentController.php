<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Braintree\Gateway;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

  public function index() {
    $gateway = new Gateway([
      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')
  ]);

  $token = $gateway->ClientToken()->generate();
  // dd($token);
    return view('admin.payment', [
      'token' => $token
    ]);
  }

  public function paga(Request $request) {
      $gateway = new Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

      $amount = $request->amount;
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
          return back()->with('success_message', 'Transaction succesSful. The ID is'. $transaction->id);
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
