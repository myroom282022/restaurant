<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
       $data= User::latest()->paginate(10);
        return view('admin.users.index',compact('data'));
    }
    
}
