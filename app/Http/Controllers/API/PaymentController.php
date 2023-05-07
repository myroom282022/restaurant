<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\UserDetail;
use Validator;
use Stripe\Charge;
use Stripe\Token;
use Stripe\Customer;
use Stripe;
use App\Models\Payment;

class PaymentController extends BaseController
{
    public function index(){
      $data= Payment::latest()->paginate(10);
      return view('admin.payments.index',compact('data'));
    }

    public function paymentCreate(Request $request)
    {
      if (!Auth::check()) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
      }
      $validator = Validator::make($request->all(), [
        'amount' => 'required',
        'card_number' => 'required',
        'exp_month' => 'required',
        'exp_year' => 'required',
        'cvc' => 'required',
      ]);
      if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
      }
      try {

        Stripe\Stripe::setApiKey(env('STRIPE_KEY'));
        $stripeToken = Token::create([
          'card' => [
              'number' => $request->input('card_number'),
              'exp_month' => $request->input('exp_month'),
              'exp_year' => $request->input('exp_year'),
              'cvc' => $request->input('cvc')
            ]
        ]);
      
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $trnsation = Stripe\Charge::create ([
            "amount" => $request->amount * 100,
            "currency" => "usd",
            "source" => $stripeToken->id,
            "description" => "Test payment." ,

            "shipping" => [
              
              "address" => [
                "line1" => "510 Townsend St",
                "postal_code" => "98140",
                "city" => "San Francisco",
                "state" => "CA",
                "country" => "US",
              ],
              "name" => auth()->user()->name,
              // "email" => auth()->user()->email,
              // "phone" => auth()->user()->phone_number,
            ]
        ]);

        $payments=[
          "user_id" =>auth()->user()->id,
          "translation_id"=>$trnsation->id,
          "amount" => $trnsation->amount/100,
          "status" => $trnsation->status,
          "currency" => $trnsation->currency,
          "payment_type" =>$trnsation->payment_method_details->type,
          "card_number" =>$trnsation->source->last4,
          'brand'=>$trnsation->source->brand,
          "receipt_url" =>$trnsation->receipt_url,
        ];
        $success=Payment::create($payments);
                  
      } catch (\Stripe\Exception\CardException $e) {
          return response()->json(['error' => $e->getMessage()]);
      } catch (\Stripe\Exception\RateLimitException $e) {
          return response()->json(['error' => $e->getMessage()]);
      } catch (\Stripe\Exception\InvalidRequestException $e) {
          return response()->json(['error' => $e->getMessage()]);
      } catch (\Stripe\Exception\AuthenticationException $e) {
          return response()->json(['error' => $e->getMessage()]);
      } catch (\Stripe\Exception\ApiConnectionException $e) {
          return response()->json(['error' => $e->getMessage()]);
      } catch (\Stripe\Exception\ApiErrorException $e) {
          return response()->json(['error' => $e->getMessage()]);
      }
      return $this->sendResponse($success, 'payment creaded successfully.');
    }

    public function getPaymentUserList(){
      if (!Auth::check()) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
      }
      $success=Payment::where('user_id',auth()->user()->id)->get();
      return $this->sendResponse($success, 'user payment list display.');
    }
    public function getPaymentList(){
      if (!Auth::check()) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
      }
      $success=Payment::all();
      return $this->sendResponse($success, 'all payment list display.');
    }
}
