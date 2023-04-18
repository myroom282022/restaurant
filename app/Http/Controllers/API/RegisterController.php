<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use Hash;
use App\Models\UserDetail;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $input = $request->all();
        $input['password'] =Hash::make($input['password']);
        $input['role'] ='user';
        $success = User::create($input);
        $success['token'] =  $success->createToken('MyApp')->accessToken;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
     
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
    public function getUserDetails($id,Request $request){
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $success=User::where('id',$id)->first();
        return $this->sendResponse($success, 'User Details successfully.');

    }
    public function getAllUserDetails(Request $request){
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $success=User::All();
        return $this->sendResponse($success, 'get all User Details successfully.');

    }


    public function profile(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $validator = Validator::make($request->all(), [
            'birthday' => 'required',
            'gender' => 'required',
            'drink' => 'required',
            'bio' => 'required',
            'job_title' => 'required',
            'company_name' => 'required',
            'facebook_id' => 'required',
            'instagram' => 'required',
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
         $users= Auth::user();

         $profile['user_id']=$users->id;
        $profile['name']=$users->name;
        $profile['gender']=$request->birthday;
        $profile['gender']=$request->gender;

        $profile['drink']=$request->drink;
        $profile['bio']=$request->bio;
        $profile['job_title']=$request->job_title;
        $profile['company_name']=$request->company_name;
        $profile['facebook_id']=$request->facebook_id;
        $profile['instagram']=$request->instagram;
       
        
        if ($image = $request->file('profile_image')) {
            $destinationPath = 'users/profile';
            $profileImage = rand(000,999).time(). "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $profile['profile_image'] = "$profileImage";
        }

      
        $userData= UserDetail::where('user_id',$users->id)->first();
       if($userData){
        UserDetail::where('id',$userData->id)->update($profile);
        $success=UserDetail::where('user_id',$users->id)->first();
       }else{
        $success=UserDetail::create($profile);
       }
        return $this->sendResponse($success, 'profile update successfully.');
    }
    // use logout
    public function logout(){   
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(['success' =>'logout_success'],200); 
        }else{
            return response()->json(['error' =>'api.something_went_wrong'], 500);
        }
    }
}
