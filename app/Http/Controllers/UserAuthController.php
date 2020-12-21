<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function registrationForm(){
        return view('user.registration');
    }

    public function registration(Request $request){
        
        // return $request->all();
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'organization' => 'required',
            'city' => 'required',
            'street' => 'required',
            'mobile_number' => 'required|unique:users,mobile_number',
            'email' => 'required|email:rfc,dns,strict|unique:users,email',
            'password' => 'required|min:6|max:12',
            'confirm_password' => 'required|min:6|max:12'
        );
        $validator = Validator::make(\request()->all(), $rules);

        // process the creation
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(\request()->all());
        } else {
            // store
                if ($request->password == $request->confirm_password) {
                    # code...
                    $user = new User;
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->organization = $request->organization;
                    $user->city = $request->city;
                    $user->street = $request->street;
                    $user->mobile_number = $request->mobile_number;
                    $user->email = $request->email;
                    $user->password = bcrypt($request->password);
                    $user->save();
    
                    // return $user;
                    // toastr()->success('Signed up successfully. Please check your email to activate the account.');
                    // redirect
                    return redirect()->route('user.loginForm');
                }else {
                    return redirect()->back()
                    ->withErrors(['confirm_password'=>"password and confirm password was not match"])
                    ->withInput(\request()->all());
                }

           
        }

    }

    public function loginForm(){
        return view('user.login');
    }

    public function login( Request $request){

        // return $request->all();

        $this->validate($request, [
            'mobile_number' => 'required',
            'password' => 'required'
        ]);

        $credentialsType = ['mobile_number' => $request->mobile_number, 'password' => $request->password];

        if (Auth::guard('user')->attempt($credentialsType)) {

            return redirect()->route('user.dashboard');
        }else {

            return "Invalid credentials!";

            return redirect()->route('user.loginForm')->withInput();
        }
    }


    public function logout(){
        Auth::guard('user')->logout();
        return redirect()->route('user.loginForm');
    }
    
}
