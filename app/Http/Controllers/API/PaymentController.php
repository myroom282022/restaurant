<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Session;
use Stripe;
use Auth;
use App\Models\UserDetail;
use Validator;

class PaymentController extends BaseController
{
    public function paymentCreate(Request $request)
    {

      if (!Auth::check()) {
      return response()->json(['error' => 'Unauthenticated.'], 401);
      }
      $validator = Validator::make($request->all(), [
      'amount' => 'required',
      'number' => 'required',
      'exp_month' => 'required',
      'exp_year' => 'required',
      'cvc' => 'required',
      ]);

      if($validator->fails()){
      return $this->sendError('Validation Error.', $validator->errors());       
      }
      $user=Auth::user();

      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      $customer = Stripe\Customer::create(array(
      "address" => [
            "line1" => "Virani Chowk",
            "postal_code" => "360001",
            "city" => "Rajkot",
            "state" => "GJ",
            "country" => "IN",
        ],
      "email" => $user->email,
      "name" => $user->name,
      "phone" => $user->phone_number,
      "source" => $request->stripeToken
      ));
     $trnsation=  Stripe\Charge::create ([
      "amount" => 100 * 100,
      "currency" => "usd",
      "customer" => $customer->id,
      "description" => "Test payment .",
      "shipping" => [
      "name" => $user->name,
      "address" => [
        "line1" => "510 Townsend St",
        "postal_code" => "98140",
        "city" => "San Francisco",
        "state" => "CA",
        "country" => "US",
      ],
      ]
    ]); 
   $payments=[
    "translation_id"=>$trnsation->id,
    "amount" => $request->amount,
    "number" => $request->number,
    "exp_month" => $request->exp_month,
    "exp_year" => $request->exp_year,
    "cvc" => $request->cvc,
   ];
    $success=Payment::create($payment);
    return $this->sendResponse($success, 'payment creaded successfully.');

  }
  public function paymentList(){
    $success=Payment::where('user_id',auth()->user()->id)->get();
    return $this->sendResponse($success, 'payment list display.');

  }
}
