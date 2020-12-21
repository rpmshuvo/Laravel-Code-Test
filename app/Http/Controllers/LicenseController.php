<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LicenseController extends Controller
{
    public function index(){
        return view('license');
    }
    public function licenseActiveForm(){
        return view('licenseActiveForm');
    }

    public function createLicense(Request $request){
        
        $user_id = $request->user_id;
        $license_period = $request->license_period;
        $current_time = Carbon::now()->addMonth($license_period)->toDateString();
        $user = User::where('id', $user_id)->first();
        $license_key = 'shuvo';
        // $license_key = $this->random_strings(3);
        if ($user) {
            $license_key .= '#'.$user->id;
            $license_key .= '#'.$current_time;
        }
        
        $en_license_key = base64_encode($license_key);

        // $dc_license_key = base64_decode($en_license_key);
        return response()->json(['license_key'=>$en_license_key]);
        // return response()->json(['license_key'=>$dc_license_key]);

    }

    // public function storeLicense(Request $request){
        
    //     $license_key = $request->license_key;

    //     $dc_license_key = base64_decode($license_key);
    //     $ex_license_key = explode("#", $dc_license_key);
        

    //     $user_id = $ex_license_key[1];

    //     $user = User::where('id', $user_id)->first();
    //     if ($user) {
    //         $user->license_key = $license_key;
    //         $user->save();
    //     }
    //     return response()->json(['success'=>'save successfully']);

    // }

    public function activeLicense(Request $request){
        
        $license_key = $request->license_key;

        $user = User::where('id', Auth::guard('user')->user()->id)->first();

        $dc_license_key = base64_decode($license_key);
        $ex_license_key = explode("#", $dc_license_key);
        
        $user_id = $ex_license_key[1];
        $expire_date = $ex_license_key[2];

        if ($user->id == $user_id) {

            $user->license_key = $license_key;
            $user->expire_date = $expire_date;
            $user->save();
            return response()->json(['success'=>'Congratulations!! Your License Has Been Activated. It will work till', 'expire_date'=> $expire_date]);
        }

    }

    public function getUserByAjax(Request $request){

        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();
        if ($user) {
            
            return response()->json($user);
        } else {
            return response()->json(['error' => 'user Not found']);
        }
        

    }

    public function random_strings($length_of_string)
    {

        // String of all alphanumeric character
        $str_result = '0123456789abcdefghijklmnopqrstuvwxyz0123456789';
        
        // Shufle the $str_result and returns substring
        // of specified length
        $id = substr(str_shuffle($str_result),
            0, $length_of_string);

        if(1 === preg_match('~[0-9]~', $id) && 1 === preg_match('~[a-z]~', $id)){
            return $id;
        } else {
            return substr(str_shuffle($str_result),
                0, $length_of_string);
        }
    }
}
