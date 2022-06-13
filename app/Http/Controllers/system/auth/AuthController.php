<?php

namespace App\Http\Controllers\system\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator,Redirect,Response;
use App\Models\UsersModel;
use Session;
use View;


class AuthController extends Controller
{
    //Login Process
    public function loginAuthentication(Request $request){

        $UsersModel = new UsersModel();
      

        $username= $request->get('username');
        $password= $request->get('password');

        //Input validations
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:5|max:50',
            'password' => 'required|min:5|max:50',
        ],
        [
            'username.required' => 'Username is required',
            'username.min' => 'Username must be at least 5 characters',
            'username.max' => 'Username cannot exceed 50 characters',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 5 characters',
            'password.max' => 'Password cannot exceed 50 characters',
            
        ]);

        if ($validator->fails()) { //If validation fails
            //Failure response message
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{//If validation succeeds

            $credentials = request(['username', 'password']);
        
            if (! $token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Please check your username and password.'], 401);
            }

            return $this->respondWithToken($token);

        }

    }


    //Logout system
    public function logout(Request $request) {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    //Register 
    public function signup(){
        return view('system/auth/signup');
    }

    public function myself(){
        
        $response = auth()->user();

        return response()->json($response, 200);
    }

    //Login process
    public function signupProcess(Request $request){

        $UsersModel = new UsersModel();
        $session = session();

        $first_name= $request->get('first_name');
        $last_name= $request->get('last_name');
        $username= $request->get('username');
        $password= $request->get('password');
        $password_confirmation= $request->get('password_confirmation');

        $passwordMD5= bcrypt($password);//Convert to MD5

        //Input validations
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'username' => 'required|min:5|max:50',
            'password' => 'required|confirmed|min:5|max:50',
            
        ],
        [
            'first_name.required' => 'First name is required',
            'first_name.min' => 'Fist name must be at least 2 characters',
            'first_name.max' => 'First name cannot exceed 50 characters',
            'last_name.required' => 'Last name is required',
            'last_name.min' => 'Last name must be at least 2 characters',
            'last_name.max' => 'Last name cannot exceed 50 characters',
            'username.required' => 'Username is required',
            'username.min' => 'Username must be at least 5 characters',
            'username.max' => 'Username cannot exceed 50 characters',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password did not match with confirm password field',
            'password.min' => 'Password must be at least 5 characters',
            'password.max' => 'Password cannot exceed 50 characters',
            
        ]);

        if ($validator->fails()) { //If validation fails
            //Failure response message
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{//If validation succeeds

            //Assign all data to model
            $UsersModel->first_name = $first_name;
            $UsersModel->last_name = $last_name;
            $UsersModel->user_type = "USER";
            $UsersModel->username = $username;
            $UsersModel->password = bcrypt($password);
            $UsersModel->confirmation_code = $password;
            $UsersModel->status = "0";
            $UsersModel->added_by = "0";
            $UsersModel->added_date = date("Y-m-d H:i:s");

            $added=$UsersModel->save();

            if($added){
                //Success response message
                $response = array(
                    'status' => true,
                    'message' => "User registered successfully."
                );
            }else{
                //Failure response message
                $response = array(
                    'status' => false,
                    'message' => "Something went wrong."
                );
            }

            return response()->json($response, 200);
            
        }

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
