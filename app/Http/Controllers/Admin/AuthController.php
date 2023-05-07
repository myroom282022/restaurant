<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use Hash;
use Auth;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function login()
    {
        return view('admin.auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function register()
    {
        return view('admin.auth.register');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function storeLogin(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Please enter email.',
            'password.required' => 'Please enter password.',
            'password.min' => 'Please enter min 6 latter.',
            
        ]);
   
          $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
        return redirect("admin/login")->withSuccess('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
   
    
    public function storeRegister(Request $request)
    {
        $validatedData = $request->validate([
                'name' => 'required',
                'password' => 'required|min:6',
                'email' => 'required|email|unique:users',
                'phone_number' => 'required|digits:10',
            ], [
                'name.required' => 'Please enter name.',
                'password.required' => 'Please enter password.',
                'password.min' => 'Please enter min 6 latter.',
                'email.required' => 'Please enter email.',
                'email.unique' => 'This email is alreday Exits.',
                'phone_number.required' => 'Please enter phone number.',
                'phone_number.digits' => 'Please enter only 10 digits.'

            ]);
      
        $validatedData['password'] =Hash::make($request->password);
        $validatedData['role'] ='user';
        $user = User::create($validatedData);
        return redirect("admin/login")->withSuccess('User created successfully');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('admin/login');
    }
}
