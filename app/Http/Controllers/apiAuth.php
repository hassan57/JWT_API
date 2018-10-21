<?php


namespace App\Http\Controllers;
use App\country;
use App\User;
use Illuminate\Http\Request;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
use Illuminate\Support\Facades\Auth;

class apiAuth extends Controller
{
    public function country(){
    	$country =  country::all();
        return response::json(compact('country'));
    }
    
    public function register(Request $request){
    	$validator = Validator::make($request->all() , [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'password'=> 'required'
    	]); 
	     if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $user = new User(); 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $token = JWTAuth::fromUser($user);

        return Response::json(compact('token' , 'user'));

    }

    public function login(Request $request){
    	$validator = Validator::make($request->all() , [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
    	]); 
	     if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $credentials = $request->only('email', 'password');
        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json(['error' => 'invalid Username or Password'], 401);
        }
        $user = Auth::user();
        
        return Response::json(compact('token' , 'user'));
    }
}
