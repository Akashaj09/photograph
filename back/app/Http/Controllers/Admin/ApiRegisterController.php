<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisterController;
use DB;

class ApiRegisterController extends Controller
{
    public function register(Request $request){
        $validatedData = $request->validate([
	        'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
	    ]);
	    
        
        $rand = rand(111111, 999999);
        $message = "Your account activation code is: $rand";
    	$data = array();
        $data["sub"] = "Activate your account";
    	$data["name"] = $request->name;
    	$data["email"] = $request->email;
    	$data["password"] = $request->password;
        new MailController($data,$message);
    	$obj = new RegisterController;
    	$obj->create($data);
        DB::table('activate')->insert([
                'email' => $request->email,
                'activate_code' => $rand 
            ]);
    	if($obj){
             
    		return response()->json(['success' => true]);
    	}else{
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }
    }
    public function activate(Request $request){
        $result = DB::table('activate')
                    ->select('activate_code')
                    ->join('users', 'users.email', '=', 'activate.email')
                    ->where('activate.email', $request->email)
                    ->where('users.flag', '!=', '1')
                    ->get();

        if(count($result) > 0){
            if($result[0]->activate_code == $request->code){
                $act = DB::table('users')->where('email', $request->email)->update([
                    'flag' => '1'
                ]);
                if($act){
                    return response()->json(['success' => true]);
                }
            }else{
                return response()->json(['success' => false, 'message' => 'Invalid code']);  
            }
        }else{
            return response()->json(['success' => false, 'message' => 'Account already activated']);   
        }
    }
}
