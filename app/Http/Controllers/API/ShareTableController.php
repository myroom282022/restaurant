<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShareTable;
use Auth;
use Validator;

class ShareTableController extends BaseController
{
    public function shareTableCreate(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $validator = Validator::make($request->all(), [
            'share_with_other' => 'required',
            'club_name' => 'required',
            'performer' => 'required',
            'share_table_date' => 'required',
            'drink_preferences' => 'required',
            'desired_company' => 'required',
            'currency' => 'required',
            'additional_info' => 'required',
            'age_limite' => 'required',
            'share_table_image' => 'required',
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $users= Auth::user();

        $shareTable['user_id']=$users->id;
        $shareTable['share_with_other']=$request->share_with_other;
        $shareTable['performer']=$request->performer;
        $shareTable['share_table_date']=$request->share_table_date;
        $shareTable['club_name']=$request->club_name;
        $shareTable['drink_preferences']=$request->drink_preferences;
        $shareTable['desired_company']=$request->desired_company;
        $shareTable['currency']=$request->currency;
        $shareTable['additional_info']=$request->additional_info;
        $shareTable['age_limite']=$request->age_limite;
        $shareTable['covide19_check_pvr_test']=$request->covide19_check_pvr_test;
        $shareTable['covide19_check_vaccination_prof']=$request->covide19_check_vaccination_prof;
        
        if ($image = $request->file('share_table_image')) {
            $destinationPath = 'users/tableImage';
            $profileImage = rand(000,999).time(). "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $shareTable['share_table_image'] = "$profileImage";
        }
        $success=ShareTable::create($shareTable);
        return $this->sendResponse($success, 'shareTable update successfully.');
    }

    public function getAll(){
        $success=  ShareTable::get();
        return $this->sendResponse($success, 'shareTable update successfully.');
    }

    public function getAllOneTable($id){
        $success=  ShareTable::find($id);
        return $this->sendResponse($success, 'shareTable update successfully.');
    }
}
